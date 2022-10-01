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
                $.ajax({
                    type: "post",
                    url: "../api/category/insertcategory",
                    data: {
                        name: name,
                        about: about,
                        status: status,
                        id_parent: parentCategory,
                        position_show: position_show
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