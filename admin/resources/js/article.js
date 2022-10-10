(function() {
    jQuery(document).ready(function($) {
        "use strict";
        //table blogs 
        $("#tableblogs").DataTable({
            // processing: true,
            // serverSide: true,
            // searchPanes: {
            //     controls: false
            // },
            // searching: false,
            // info: false,
            ajax: {
                url: "../api/article/gettablearticle",
                dataType: 'json',
                type: 'get',
            },
            createdRow: function(row, data, dataIndex) {
                if (data.status === 0) {
                    $(row).addClass('badge-light-danger');
                }
            },
            columns: [{
                    "data": "id",
                    render: function(data, type, row) {
                        return `<div class="text-center checklistArticle"><input  class="form-check-input checklistArticle" type="checkbox" value="${data}" name="flexCheckTableArticle[]"></div>`;
                    }
                },
                {
                    "data": "status",
                    render: function(data, type, row) {
                        if (data) {
                            return `<p class="text-center icon-tablecategory"><i class="fa-solid fa-circle-check icon-tablecategory"></i></p>`
                        }
                        return `<p class="text-center icon-tablecategory"><i class="fa-solid fa-circle-xmark icon-tablecategory"></i></p>`;
                    }
                },
                {
                    "data": {
                        "title": "title",
                        "title_url": "title_url"
                    },
                    render: function(data, type, row) {
                        return `<a href="articleedit?${data['title_url']}" class="link-dark" target="_blank"><p class="text-start overflow-hidden"><b>${data['title']}</b></p></a>`;
                    }
                },
                {
                    "data": "kind",
                    render: function(data, type, row) {
                        return `<p class="text-center overflow-hidden">${data}</p>`;
                    }
                },
                {
                    "data": "time",
                },

                {
                    "data": null,
                    render: function(data, type, row) {
                        return ` <div class = "text-center" >
                        <span id = "remotearticle" class = "material-symbols-rounded"style = "color: #D61C4E"> delete </span> 
                        </div>`;
                    }
                }
            ],
            "order": [
                [1, 'asc']
            ],
            // initComplete: function(settings, json) {
            //     InitLoadSuccess(settings, json);
            // }
            stateSave: true,
            responsive: true,
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [0]
            }],
            orderCellsTop: true,
            fixedHeader: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
                paginate: {
                    next: '»',
                    previous: '«',
                }
            }
        });

        function loadTableArticle() {
            const spinnertable = $('.spinnertable');
            const tableCategory = $('#tableblogs tbody');
            tableCategory.addClass('fade');
            spinnertable.removeClass('fade');
            setTimeout(function() {
                spinnertable.addClass('fade');
                tableCategory.removeClass('fade');
                $('#tableblogs').DataTable().ajax.reload();
            }, 300);
        }

        $('#publishedArticle').on('click', function(event) {
            event.preventDefault();
            var arr = [];
            arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "../api/article/changestatusarticle",
                    data: {
                        id: arr,
                        status: 1
                    }
                }).done(function(data) {
                    loadTableArticle();
                });
            }
        })



        $('#unPublishedArticle').on('click', function(event) {
            event.preventDefault();
            var arr = [];
            arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "../api/article/changestatusarticle",
                    data: {
                        id: arr,
                        status: 0
                    }
                }).done(function(data) {
                    loadTableArticle();
                });
            }
        })

        $('#deleteArticle').on('click', function(event) {
            event.preventDefault();
            var arr = [];

            arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "../api/article/deleteArticle",
                    data: {
                        id: arr,
                    },

                }).done(function(data) {
                    loadTableArticle();
                });
            }
        })

        $('#reloadTableArticle').on('click', function(event) {
            event.preventDefault();
            loadTableArticle();

        })
        $('#tableblogs tbody').on('click', '#remotearticle', function() {
            // alert(data[0] + "'s salary is: " + data[5]);
            let table = $("#tableblogs").DataTable();
            var data = table.row($(this).parents('tr')).data();
            //truy vấn xóa trong db
            let arr = [];
            arr[0] = data['id'];
            $.ajax({
                    type: "post",
                    url: "../api/article/deleteArticle",
                    data: {
                        id: arr
                    }
                })
                .done(function() {
                    //không cần hiển thị thông báo
                    loadTableArticle();
                });
        });
        //article insert

        tinymce.init({
            selector: '#textareaArticle',
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
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'BaiVietID' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                        // lưu tên hình vào db
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });


        //load select kind in post page
        function LoadSelectCategory() {
            $('#SelectKind')
                .empty()
                .append($('<option>', {
                    selected: true,
                    class: "text-center fw-bold",
                    value: "none",
                    text: "-- Chọn chủ đề --"
                }));
            $.ajax({
                type: "POST",
                url: "../api/category/getallcategory",

                success: function(data) {
                    $(data).each(function(item, value) {
                        $('#SelectKind')
                            .append($('<option>', {
                                value: value['kindname'],
                                text: value['kindname']
                            }));
                    });
                }
            });
        }
        LoadSelectCategory();

        $('#reloadSelectCategory').on('click', function(event) {
            event.preventDefault();
            LoadSelectCategory();
        })

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
            str = str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-')
            str = str.replace(/[`’‘'!@#$%^&*().`~\\?,:;"[{\}\]]/g, "_");
            str = str.replace(/ /g, "-");
            return str;
        }

        function ModalNotify(modal, message) {
            $("#modalPostStatus").modal(modal);
            $("#modalPostStatus h4").html(message);
        }

        function insertArticle() {
            let title = $("#titleArticle").val();
            let title_url = xoa_dau(title.toString()) + '-';
            let file_tmp_name = $('#imageArticle_small').val();
            let status = $('#status').val();
            // console.log(file_tmp_name);
            let nameCatogory = $("#SelectKind").val();
            let data = tinyMCE.get('textareaArticle').getContent();
            if (
                title != "" &&
                file_tmp_name !== "" &&
                data != "" &&
                nameCatogory !== "none"
            ) {

                let nameimage = $('#imageArticle_small')[0].files[0].name;
                $.ajax({
                    type: "post",
                    url: "../api/article/insertarticle",
                    dataType: "text",
                    data: {
                        title: title,
                        title_url: title_url,
                        content: data,
                        nameimage: nameimage,
                        kind: nameCatogory,
                        status: status
                    },
                    success: function(data) {
                        // console.log(data, "status");
                        // ModalNotify("show", "Lưu bài viết thành công");
                        // $("#titlepost").val("");
                        // tinyMCE.get('mytextareapost').setContent("");
                        $.ajax({
                            type: "post",
                            url: "../api/article/insertreadmost",
                        });
                    }
                });
                //imagepost
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
                    ModalNotify("show", "Thêm bài viết thành công");
                    return true;
                } else {
                    ModalNotify("show", "Vui lòng thêm hình bài viết.")
                    return false;
                }
            } else {
                ModalNotify("show", "Vui lòng điền đầy đủ dữ liệu")
                return false;
            }
        }

        //submit save post
        tinyMCE.triggerSave();
        $("#saveArticle").on("click", function(event) {
            event.preventDefault();
            insertArticle();
        });

        $("#saveNewArticle").on("click", function(event) {
            event.preventDefault();
            insertArticle();
            $("#titleArticle").val("");
            tinyMCE.get('textareaArticle').setContent("");
            $('#imageArticle_small').val(null);
        });

        $("#saveCloseArticle").on("click", function(event) {
            if (!insertArticle())
                event.preventDefault();
        });
    })
})();