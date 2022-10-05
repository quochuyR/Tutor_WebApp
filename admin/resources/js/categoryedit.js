(function() {
    jQuery(document).ready(function($) {
        "use strict"

        function LoadEditCategoryParent() {
            $('#parentEditCategory')
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
                        $('#parentEditCategory')
                            .append($('<option>', {
                                value: value['kindname'],
                                text: value['kindname']
                            }));
                    });
                }
            });
        }


        function checkInput() {
            const name = $('#litleEditCategory');
            if (name.val() == "") {
                alert('Vui lòng điền tên danh mục');
                return false;
            }
            return true;
        }

        function strimURLD() {
            const urlPage = [];
            if (window.location.href.split("?").length > 1) {
                urlPage.push(window.location.href.split("/"));
                return urlPage[0][urlPage[0].length - 1].split("?");
            }
            return false;
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

        function updatecategory() {
            if (checkInput()) {
                const id = strimURLD()[1];
                const name = $('#titleEditCategory').val();
                const about = tinyMCE.get('aboutEditCategory').getContent();;
                const status = $('#statusEditCategory').val();
                const position_show = $('#eidtPosition_show').val();
                const parentCategory = $('#parentEditCategory').val();
                const name_url = xoa_dau(name);
                // console.log(name_url, 'nameurl');

                // console.log('id: ' + id)
                // console.log('name: ' + name)
                // console.log('about: ' + about)
                // console.log('status: ' + status)
                // console.log('parentCategory: ' + parentCategory)

                $.ajax({
                    type: "post",
                    url: "../api/category/updatecategory",
                    dataType: 'text',
                    data: {
                        id: id,
                        name: name,
                        about: about,
                        status: status,
                        id_parent: parentCategory,
                        position_show: position_show,
                        name_url: name_url
                    },
                    success: function(data) {
                        // console.log(data, 'updatecategory');
                    }
                })
            }
        }

        function setEditCategory() {
            if (strimURLD()) {
                const id = strimURLD()[1];
                let titleCategory = $('#titleEditCategory');
                let statusCategory = $('#statusEditCategory');
                let parentCategory = $('#parentEditCategory');
                let position_show = $('#eidtPosition_show');
                $.ajax({
                    type: "post",
                    url: "../api/category/getcategorysinger",
                    data: {
                        id
                    },
                    success: function(data) {
                        // console.log(data, "data category");
                        console.log(data['status'], 'statusCategory')
                        titleCategory.val(data['kindname']);
                        tinyMCE.get('aboutEditCategory').setContent(data['about']);
                        statusCategory.val(data['status']).change();
                        position_show.val(data['position_show']).change();
                        if (data['id_parent'] !== data['kindname'])
                            parentCategory.val(data['id_parent']).change();
                        $(`#parentEditCategory option[value='${data['kindname']}']`).remove();
                    }
                })
            }
        }
        tinymce.init({
            selector: '#aboutEditCategory',
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


        if (strimURLD()[0] === "categoryedit") {
            LoadEditCategoryParent();
            setEditCategory();
        }



        $("#saveEditCategory").on('click', function(event) {
            event.preventDefault();
            updatecategory();
            alert("Cập nhật Thành Công");
        })
        $("#saveEditNewCategory").on('click', function() {
            updatecategory();
            alert("Cập nhật thành công")
        })
        $("#saveEditCloseCategory").on('click', function() {
            updatecategory();
        })
    })
})();