(function() {
    jQuery(document).ready(function($) {
        "use strict"
        tinymce.init({
            selector: '#aboutCategory',
            plugins: 'image code',
            // toolbar: 'undo redo | link image | code',
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: false,
            height: "480",
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            // images_upload_url: 'saveimg.php',
            // images_upload_base_path: '../public/images/blogpost',
            // images_upload_credentials: true,
            /* and here's our custom image picker*/

            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        function LoadCategoryParent() {
            $('#parentCategory')
                .empty()
                .append($('<option>', {
                    selected: true,
                    class: "fw-bold",
                    value: "0",
                    text: "Không có"
                }));
            $.ajax({
                type: "POST",
                url: "../api/category/getallcategory",

                success: function(data) {
                    $(data).each(function(item, value) {
                        $('#parentCategory')
                            .append($('<option>', {
                                value: value['kindname'],
                                text: value['kindname']
                            }));
                    });
                }
            });
        }

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
        LoadCategoryParent();

        function checkInput() {
            const name = $('#titleCategory');
            if (name.val() == "") {
                alert('Vui lòng điền tên danh mục');
                return false;
            }
            return true;
        }

        function insertcategory() {
            if (checkInput()) {
                const name = $('#titleCategory').val();
                const about = tinyMCE.get('aboutCategory').getContent();
                const position_show = $('#position_show').val();
                const status = $('#statusCategory').val();
                const parentCategory = $('#parentCategory').val();
                const name_url = xoa_dau(name);
                $.ajax({
                    type: "post",
                    url: "../api/category/insertcategory",
                    data: {
                        name: name,
                        about: about,
                        status: status,
                        id_parent: parentCategory,
                        position_show: position_show,
                        name_url: name_url
                    }
                }).done(function(data) {

                    alert('Thêm danh mục thành công');
                })
            }
        }

        $("#saveCategory").on('click', function(event) {
            event.preventDefault();
            insertcategory();
        })
        $("#saveNewCategory").on('click', function(event) {
            event.preventDefault();
            insertcategory();
            $('#titleCategory').val("")
            $('#aboutCategory').val("");
            $('#statusCategory option').eq(0).prop('selected', true);
            $('#parentCategory option').eq(0).prop('selected', true);
        })
        $("#saveCloseCategory").on('click', function(event) {
            insertcategory();
        })
    })
})();