(function() {
    jQuery(document).ready(function($) {
        //edit
        function strimURL() {
            const urlPage = [];
            if (window.location.href.split("?").length > 1) {
                urlPage.push(window.location.href.split("/"));
                return urlPage[0][urlPage[0].length - 1].split("?");
            }
            return false;
        }

        function setArticleEdit() {

            if (strimURL()) {
                const arrUrl = strimURL();
                // console.log(arrUrl, 'arrUrl');
                if (arrUrl[0] == "articleedit") {
                    let title = $("#titleArticle");
                    let status = $('#status');
                    let nameCatogory = $("#SelectKind");
                    let title_url = arrUrl[1];
                    let img = $('.form-image-up img');
                    let id = $('#idArticle b');
                    $.ajax({
                        type: "POST",
                        url: "../api/article/getarticle",
                        data: {
                            title_url,
                        },
                        success: function(data) {
                            id.html(data['id']);
                            title.val(data['title']);
                            status.val(data['status']).change();
                            nameCatogory.val(data['kind']).change();
                            console.log(data['content']);
                            tinyMCE.get('textareaArticle').setContent(data['content']);
                            // img.attr('src', 'https://us.123rf.com/450wm/antonbrand/antonbrand1105/antonbrand110500035/9529928-illustration-of-a-instant-camera-isolated-on-white.jpg?ver=6')
                            img.attr('src', `../public/images/blogpost/${data['nameimage']}`)
                            img.attr('alt', data['nameimage'])
                        }
                    });
                }
            }
        }
        setTimeout(function() {
            setArticleEdit();
        }, 1000);


        //xoa dau tiếng việt - thay thế dấu cách thành gạch nối
        function xoa_dau(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            str = str.replace(/[/]/g, "_");
            str = str.replace(/['!@#$%^&*().`~\\?,:;"[{\}\]]/g, "_");
            // str = str.replace(/['.*+?^${}()|[\]\\]/g, "_");
            str = str.replace(/ /g, "-");
            return str;
        }

        // show or hide notification
        function ModalNotify(modal, message) {
            $("#modalPostStatus").modal(modal);
            $("#modalPostStatus h4").html(message);
        }

        function updateArticleEdit() {
            let id = $('#idArticle b').html();
            let title = $("#titleArticle").val();
            let title_url = xoa_dau(title.toString());
            let status = $('#status').val();
            let file_tmp_name = $('#imageArticle_small')[0].files[0] == null;
            // let kind = $('input[name="radioKind"]:checked').val();
            let nameCatogory = $("#SelectKind").val();
            let data = tinyMCE.get('textareaArticle').getContent();


            if (
                title != "" &&
                data != "" &&
                nameCatogory !== "none"
            ) {
                let nameimage = $('.form-image-up img').attr("alt");
                // console.log(id);
                // console.log(title);
                // console.log(title_url);
                // console.log(nameCatogory);
                // console.log(nameimage);
                // console.log(status);
                // console.log(data);

                if (!file_tmp_name) {
                    nameimage = $('#imageArticle_small')[0].files[0].name;
                }
                $.ajax({
                    type: "post",
                    url: "../api/article/uploadArticle",
                    dataType: "text",
                    data: {
                        id: id,
                        title: title,
                        title_url: title_url,
                        content: data,
                        nameimage: nameimage,
                        kind: nameCatogory,
                        status: status
                    },
                    success: function(data) {
                        // ModalNotify("show", "Lưu bài viết thành công");
                        // $("#titlepost").val("");
                        // tinyMCE.get('mytextareapost').setContent("");
                    }
                });
                //imagepost
                if (!file_tmp_name) {
                    var fd = new FormData();
                    var files = $('#imageArticle_small')[0].files;
                    // Check file selected or not
                    if (files.length > 0) {

                        fd.append('file', files[0]);

                        $.ajax({
                            url: '../api/article/uploadimagearticle',
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                return true;
                            }
                        });
                        return true;
                    }
                }
            } else {
                ModalNotify("show", "Vui lòng nhập đầy đủ thông tin")
                return false;
            }
        }

        $("#saveArticleEdit").on("click", function(event) {
            event.preventDefault();
            updateArticleEdit();
            ModalNotify("show", "Đã cập nhật thông tin bài viết");
        });

        $("#saveNewArticleEdit").on("click", function(event) {
            updateArticleEdit();
        })

        $("#saveCloseArticleEdit").on("click", function(event) {
            updateArticleEdit();
        })
    })
})();