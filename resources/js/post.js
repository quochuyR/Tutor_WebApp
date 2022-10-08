(function() {
    jQuery(document).ready(function($) {
        $.extend({
            getUrlVars: function() {
                var vars = [],
                    hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for (var i = 0; i < hashes.length; i++) {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            },
            getUrlVar: function(name) {
                return $.getUrlVars()[name];
            }
        });


        function strimURL() {
            const urlPage = [];
            if (window.location.href.split("?").length > 1) {
                urlPage.push(window.location.href.split("/"));
                return urlPage[0][urlPage[0].length - 1].split("?");
            }
            return false;
        }

        function time_ago(time) {

            switch (typeof time) {
                case 'number':
                    break;
                case 'string':
                    time = +new Date(time);
                    break;
                case 'object':
                    if (time.constructor === Date) time = time.getTime();
                    break;
                default:
                    time = +new Date();
            }
            var time_formats = [
                [60, 'giây', 1], // 60
                [120, '1 phút trước', '1 phút trước từ giờ'], // 60*2
                [3600, 'phút', 60], // 60*60, 60
                [7200, '1 giờ trước', '1 giờ trước từ giờ'], // 60*60*2
                [86400, 'giờ', 3600], // 60*60*24, 60*60
                [172800, 'Ngày hôm qua', 'ngày mai'], // 60*60*24*2
                [604800, 'ngày', 86400], // 60*60*24*7, 60*60*24
                [1209600, 'Tuần trước', 'Tuần tới'], // 60*60*24*7*4*2
                [2419200, 'Tuần', 604800], // 60*60*24*7*4, 60*60*24*7
                [4838400, 'Tháng trước', 'Tháng tới'], // 60*60*24*7*4*2
                [29030400, 'tháng', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
                [58060800, 'Năm ngoái', 'Năm sau'], // 60*60*24*7*4*12*2
                [2903040000, 'năm', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
                [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
                [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
            ];
            var seconds = (+new Date() - time) / 1000,
                token = 'trước',
                list_choice = 1;

            if (seconds == 0) {
                return 'Vừa xong'
            }
            if (seconds < 0) {
                seconds = Math.abs(seconds);
                token = 'từ giờ';
                list_choice = 2;
            }
            var i = 0,
                format;
            while (format = time_formats[i++])
                if (seconds < format[0]) {
                    if (typeof format[2] == 'string')
                        return format[list_choice];
                    else
                        return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
                }
            return time;
        }

        if (strimURL()) {
            const arrUrl = strimURL();
            if (arrUrl[0] == "post") {
                const title_url = arrUrl[1];
                if (title_url != "") {
                    $.ajax({
                        url: "../api/news/getpost",
                        type: "post",
                        data: {
                            title_url
                        },
                        success: function(data) {
                            // console.log(data, "data 2");
                            // data = JSON.parse(data);

                            if (data == null) {
                                window.location = "../pages/errors/404";
                            } else {
                                $(document).attr("title", data.title);
                                $('.post-header .image').css('background-image', 'url(../public/images/blogpost/' + data.nameimage + ')');
                                $("#post-header h1").html(data.title);
                                $('#post-body-content').html(data.content);
                                $('#post-body-content img').addClass('img-fluid');
                                $('#post-body-author-time').html(time_ago(data.time));
                            }
                        }
                    });
                } else {
                    // window.location = "../pages/errors/404";
                    // console.log('title_url: ', title_url);
                }

                const url = window.location.href.split("pages/")[0];
                $.ajax({
                    url: "../api/news/getPostByTime",
                    type: "post",
                    success: function(data_PostNews) {
                        if (data_PostNews) {
                            // console.log(data_PostNews, 'datasdfs')
                            let Html = "";
                            $.each(data_PostNews, function(index, value) {
                                if (index == 5) {
                                    return false;
                                }
                                if (value['title_url'] != title_url)
                                    Html += `<div class="post-new col-12 col-md-10">
                                            <a href="post?${value['title_url']}">
                                                <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                            </a>
                                            <a href="post?${value['title_url']}">
                                                <h5 class="limit-text-news">${value['title']}</h5>
                                            </a>
                                            <p><small>${time_ago(value['time'])}</small></p>
                                        </div>`;
                            })
                            let hot_newsDom = $('#lienquan-post');
                            hot_newsDom.html(Html);
                        }
                    }
                });

            }
        }
    });


})();