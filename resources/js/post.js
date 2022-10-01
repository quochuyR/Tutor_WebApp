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

        // console.log('http://localhost/Tutor_WebApp/pages/post?namepost=TP.HCM:-Hoan-thanh-thu-tuc-dau-tu-du-an-nha-o-xa-hoi-trong-153-ngay&idpost=5');
        //kiểm tra nesu url này đang truy vấn đến bài viết thì kiểm thử nếu bài viết trả về tồn tại hoặc không tồn tại bài viết

        //tách nhau bởi dấu và và dấu bằng ở phần varurl
        // const urlPage = [];
        // const varPage = [];
        // if (window.location.href.split("?").length > 1) {
        //     urlPage.push(window.location.href.split("?")[0].split("/"));
        //     varPage.push(window.location.href.split("?")[window.location.href.split("?").length - 1].replace("&", "=").split("="));
        // } else {
        //     urlPage.push(window.location.href.split("/"));
        // }
        // console.log(urlPage, "url page")
        // console.log(varPage, "var page")
        // console.log($.inArray("post", urlPage[0]) != -1, "check post")

        // if (
        //     $.inArray("post", urlPage[0]) != -1
        // ) {
        //     // console.log($.inArray("idpost", varPage[0]), "idpost")
        //     // console.log($.inArray("namepost", varPage[0]), "namepost")
        //     if ($.inArray("idpost", varPage[0]) != -1 &&
        //         $.inArray("namepost", varPage[0]) != -1
        //     ) {
        //         if (
        //             $.getUrlVar("idpost") != null &&
        //             $.getUrlVar("namepost") != null
        //         ) {

        //             // decodeURIComponent giải mã url bị mã hóa 
        //             // let namepost = decodeURIComponent($.getUrlVar("namepost"));
        //             let idpost = $.getUrlVar("idpost");
        //             let namepost = $.getUrlVar("namepost");
        //             // console.log("namepost:" + namepost);
        //             // console.log("idpost:" + idpost);
        //             $.ajax({
        //                 url: "../api/news/getpost",
        //                 type: "post",
        //                 dataType: "text",
        //                 data: {
        //                     idpost,
        //                     namepost
        //                 },
        //                 success: function(data) {
        //                     // console.log(data, "data 2");
        //                     data = JSON.parse(data);

        //                     if (data == null) {
        //                         window.location = "../pages/errors/404";
        //                     } else {
        //                         $(document).attr("title", data.title);
        //                         $("#post-header h1").html(data.title);
        //                         $('#post-body-content').html(data.content);
        //                         $('#post-body-content img').addClass('img-fluid');
        //                         const timepost = new Date(data.time);
        //                         $('#post-body-author-time').html(timepost.getDate() + '/' + timepost.getMonth() + '/' + (timepost.getYear() + 1900));
        //                     }
        //                 }
        //             });
        //         }
        //     } else {
        //         window.location = "../pages/errors/404";
        //     }
        // }

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
                                $("#post-header h1").html(data.title);
                                $('#post-body-content').html(data.content);
                                $('#post-body-content img').addClass('img-fluid');
                                const timepost = new Date(data.time);
                                $('#post-body-author-time').html(timepost.getDate() + '/' + (timepost.getMonth() + 1) + '/' + (timepost.getYear() + 1900));
                            }
                        }
                    });
                } else {
                    // window.location = "../pages/errors/404";
                    console.log('title_url: ', title_url);
                }
            }
        }
    });


})();