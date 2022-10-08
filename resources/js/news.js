(function() {
    jQuery(document).ready(function($) {
        'use strict';

        // const url = new URL('../cats', 'http://www.example.com/dogs')
        // URL object js


        function strimURLN() {
            const urlPage = [];
            urlPage.push(window.location.href.split("/"));
            if (urlPage[0][urlPage[0].length - 1] == "news")
                return true;
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

        if (strimURLN()) {
            const url = window.location.href.split("pages/news")[0];
            // console.log(url, 'url');
            const position_show = ['feature_news', 'feature_1', 'theme_Category', 'hot_news_1', 'hot_news_2'];
            // console.log(position_show, "position");
            $.ajax({
                url: "../api/news/selectCategoiesByPosition",
                type: "post",
                data: {
                    position: position_show[0]
                },
                success: function(data) {
                    if (data) {
                        $.ajax({
                            url: "../api/news/getPostByCategories",
                            type: "post",
                            data: {
                                kindname: data[0]['kindname'],
                            },
                            success: function(data_PostNews) {
                                if (data_PostNews) {
                                    // console.log(data_PostNews, 'datasdfs')
                                    let feature_newsDom = $('#feature_news');
                                    let Html = `<div class="Bm_I">
                                    <a href="${url}pages/post?${data_PostNews[0]['title_url']}">
                                        <img src="${url}public/images/blogpost/${data_PostNews[0]['nameimage']}" alt="${data_PostNews[0]['title_url']}">
                                    </a>
                                    </div>
                                    <div class="Bm_Ab">
                                        <a href="${url}pages/post?${data_PostNews[0]['title_url']}">
                                            <h2>${data_PostNews[0]['title']}</h2>
                                        </a>
                                    </div>`;
                                    feature_newsDom.html(Html);

                                }
                            }
                        });
                    }

                }
            });
            // feature_1
            $.ajax({
                url: "../api/news/selectCategoiesByPosition",
                type: "post",
                data: {
                    position: position_show[1]
                },
                success: function(data) {
                    if (data) {
                        $.ajax({
                            url: "../api/news/getPostByCategories",
                            type: "post",
                            data: {
                                kindname: data[0]['kindname'],
                            },
                            success: function(data_PostNews) {
                                if (data_PostNews) {
                                    let block_feature_1 = $("#block_feature_1");
                                    block_feature_1.html(`<div class="col-12  col-md-12 row" id="feature_1"></div>`)
                                        // console.log(data_PostNews, 'datasdfs')
                                    let feature_1Dom = $('#feature_1');
                                    let Html = "";
                                    const count_post = data[0]['NUMBER'] >= 4 ? (data[0]['NUMBER'] - (data[0]['NUMBER'] % 4)) : 4;

                                    $.each(data_PostNews, function(index, value) {
                                        if (index == count_post) {
                                            return false;
                                        }
                                        Html += `<div class="col-6 col-md-3 Bm_Sub">
                                            <div class="Bm_I_Sub">
                                                <a href="${url}pages/post?${value['title_url']}">
                                                    <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                                </a>
                                            </div>
                                            <div class="Bm_Ab_Sub">
                                                <a href="${url}pages/post?${value['title_url']}">
                                                    <p class="limit-text-news">${value['title']}</p>
                                                </a>
                                            </div>
                                        </div>`;
                                    })
                                    feature_1Dom.html(Html);
                                }
                            }
                        });
                    }
                }
            });
            // theme_Category_
            $.ajax({
                url: "../api/news/selectCategoiesByPosition",
                type: "post",
                data: {
                    // position: position_show[2]
                    position: position_show[2]
                },
                success: function(data) {
                    if (data) {
                        $.each(data, function(index, element) {
                            $.ajax({
                                url: "../api/news/getPostByCategories",
                                type: "post",
                                data: {
                                    kindname: element['kindname'],
                                },
                                success: function(data_PostNews) {
                                    if (data_PostNews) {
                                        let theme_news = $('#theme_news');

                                        const theme_newsDom = `<h4 class="category_post col-12 col-md-12" id="name_theme_Category_${index + 1}"></h4>
                                                            <div id="theme_Category_${index + 1}"></div>`;


                                        theme_news.append(theme_newsDom);

                                        setTimeout(function() {
                                            let name_theme_Category_1Dom = $(`#name_theme_Category_${index + 1}`);
                                            let theme_Category_1Dom = $(`#theme_Category_${index + 1}`);
                                            let Html = "";
                                            let name_theme_Category_1 = element['kindname'];

                                            $.each(data_PostNews, function(index_PostNews, value) {
                                                let day = new Date(value['time']);
                                                let date = day.getDate() + "/" + (day.getMonth() + 1);
                                                Html += `<div class="col-12 col-md-12 Bm_Second mb-3">
                                                            <div class="Bm_I_Second">
                                                                <a href="${url}pages/post?${value['title_url']}">
                                                                    <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                                                </a>
                                                            </div>
                                                            <div class="Bm_Ab_Second">
                                                                <a href="${url}pages/post?${value['title_url']}">
                                                                    <h4 class="limit-text-news">${value['title']}</h4>
                                                                </a>
                                                                <p class="text-muted"><i class="fas fa-calendar-alt"></i> <span>Ngày</span> ${date}</p>
                                                                <p><a href="${url}pages/news_readmore?${element['kindname_url']}">Bài viết liên quan</a></p>
                                                            </div>
                                                        </div>`;
                                            })
                                            name_theme_Category_1Dom.html(name_theme_Category_1);
                                            theme_Category_1Dom.html(Html);
                                        }, 100)
                                        const readmore = `<a href="${url}pages/news_readmore?${element['kindname_url']}" class="text-center p-3 readMore">
                                                            <p><span>XEM TẤT CẢ</span></p>
                                                        </a>`
                                        theme_news.append(readmore);

                                    }
                                }
                            });
                        })
                    }

                }
            });
            //hot news 
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
                            Html += `<div class="tab-news">
                                            <a href="${url}pages/post?${value['title_url']}">
                                                <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                            </a>
                                            <a href="${url}pages/post?${value['title_url']}">
                                                <h5>${value['title']}</h5>
                                            </a>
                                            <p><small>${time_ago(value['time'])}</small></p>
                                        </div>`;
                        })
                        let hot_newsDom = $('#hot_news');
                        hot_newsDom.html(Html);
                    }
                }
            });
        }


        // news readmore  
        function strimgURLN_readmore() {
            const urlPage = [];
            if (window.location.href.split("?").length > 1) {
                if (window.location.href.split("/")[window.location.href.split("/").length - 1].split('?')[0] == "news_readmore")
                    urlPage.push(window.location.href.split("/"));
                return urlPage[0][urlPage[0].length - 1].split("?");
            }
            return false;
        }

        if (strimgURLN_readmore()) {
            const url = window.location.href.split("pages/")[0];
            const nameCategory = strimgURLN_readmore();
            console.log(nameCategory)

            $.ajax({
                url: "../api/news/getPostByCategories",
                type: "post",
                data: {
                    kindname_url: nameCategory[1],
                },
                success: function(data_PostNews) {

                    if (data_PostNews) {
                        let theme_news = $('#theme_news_readmore');

                        const theme_newsDom = `<h4 class="category_post col-12 col-md-12" id="name_theme_Category_readmore"></h4>
                                            <div id="theme_Category_readmore"></div>`;


                        theme_news.append(theme_newsDom);

                        let name_theme_Category_1Dom = $(`#name_theme_Category_readmore`);
                        let theme_Category_1Dom = $(`#theme_Category_readmore`);
                        let Html = "";
                        let name_theme_Category_1 = nameCategory[1];

                        $.each(data_PostNews, function(index_PostNews, value) {
                            let day = new Date(value['time']);
                            let date = day.getDate() + "/" + (day.getMonth() + 1);
                            Html += `<div class="col-12 col-md-12 Bm_Second mb-3">
                                            <div class="Bm_I_Second">
                                                <a href="${url}pages/post?${value['title_url']}">
                                                    <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                                </a>
                                            </div>
                                            <div class="Bm_Ab_Second">
                                                <a href="${url}pages/post?${value['title_url']}">
                                                    <h4>${value['title']}</h4>
                                                </a>
                                                <p><i class="fas fa-calendar-alt"></i> <span>Ngày</span> ${date}</p>
                                            </div>
                                        </div>`
                        })
                        name_theme_Category_1Dom.html(data_PostNews[0]['kind'].toUpperCase() || 'Category'.toUpperCase());
                        theme_Category_1Dom.html(Html);

                    } else if (data_PostNews == false) {
                        window.location = "../pages/errors/404";
                    }
                }
            });
        }
    })

})();