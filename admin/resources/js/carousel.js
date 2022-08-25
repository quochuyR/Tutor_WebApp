(function() {
    jQuery(document).ready(function($) {
        "use strict",
        // tinymce editor
        tinymce.init({
            selector: '#mytextareapost',
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

        //add kind new
        $("#addKind").on("click", function(event) {
            event.preventDefault();
            let modalKind = $("#kindModal");
            modalKind.modal('show');
            $("#themepost").focus();
        })

        //close the modal Kinđ

        $(".closeKindModal").on("click", function() {
            let modalKind = $("#kindModal");
            modalKind.modal('hide');
        });

        //save the modal Kind

        $("#btnSaveKind").on("click", function(event) {
            //gọi ajax lưu lại bảng Kind
            event.preventDefault();
            let kindname = $("#themepost").val();
            if (kindname.length > 0) {
                $.ajax({
                    url: "../api/blogpost/savekindpost",
                    type: "post",
                    dataType: "text",
                    data: {
                        kind: kindname
                    },
                });
                $("#errorThemePostInput").html("");
                $("#themepost").val('')
                $("#kindModal").modal('hide');

            } else {
                $("#errorThemePostInput").html("Vui lòng nhập chủ đề bài viết");
            }
        });

        //kind table edit
        "use strict";

        $("#kindtable").DataTable({
            // processing: true,
            // serverSide: true,
            searchPanes: {
                controls: false
            },
            searching: false,
            info: false,
            ajax: {
                url: "../api/blogpost/getkindpost",
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
                        return "<p class='counternumber text-center'>Number</p>";
                    }
                },
                {
                    "data": "kindname",
                    render: function(data, type, row) {
                        return `<input type="text" name="kindname" class="form-control" value="${data}">`;
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        // return `<a href="?id=${data.id}" id="moreview">Xem thêm</a>`
                        return `<div class="text-center d-block">
                                <span id="edit" class="material-symbols-rounded" style="color: #42855B"> done </span>
                                <span id="remote" class="material-symbols-rounded" style="color: #D61C4E"> delete </span>
                            </div>`;
                        // return `<button id="moreviewbutton" class="btn btn-success m-1 p-1">Xem</button>`;

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
        // count number in table 
        $("#kindtable").on("draw.dt", function() {
            let n = 0;
            $(".counternumber").each(function() {
                $(this).html(++n);
            })
        });
        //submit save post
        tinyMCE.triggerSave();
        $("#savepost").on("click", function(event) {
            event.preventDefault();
            let title = $("#titlepost").val();
            let nameimage = $('#imagepost').val();
            let kind = $('input[name="radioKind"]:checked').val();
            let data = tinyMCE.get('mytextareapost').getContent();
            if (
                title != "" &&
                nameimage !== "" &&
                data != ""
            ) {
                nameimage = $('#imagepost')[0].files[0].name;
                $.ajax({
                        type: "post",
                        url: "../api/blogpost/insertblog",
                        dataType: "text",
                        data: {
                            title: title,
                            content: data,
                            nameimage: nameimage,
                            kind: kind,
                            status: 0
                        }
                        // cache: false,

                    })
                    .done(function() {
                        $("#modalPostStatus").modal("show");
                        $("#modalPostStatus h4").html("Thêm bài viết thành công");

                        $("#titlepost").val("");
                        $('#imagepost').val("");
                        tinyMCE.get('mytextareapost').setContent("");
                    })
            } else {
                $("#modalPostStatus").modal("show");
                $("#modalPostStatus h4").html("Vui lòng điền đủ dữ liệu");

            }

        });
        //submit publish post
        $("#publishpost").on("click", function(event) {
            event.preventDefault();
            let title = $("#titlepost").val();
            let nameimage = $('#imagepost').val();
            let kind = $('input[name="radioKind"]:checked').val();
            let data = tinyMCE.get('mytextareapost').getContent();
            // console.log("data: " + data);
            // $("div #data").html(data);
            if (
                title != "" &&
                nameimage !== '' &&
                data != ""
            ) {
                nameimage = $('#imagepost')[0].files[0].name;
                $.ajax({
                        type: "post",
                        url: "../api/blogpost/insertblog",
                        dataType: "text",
                        data: {
                            title: title,
                            content: data,
                            nameimage: nameimage,
                            kind: kind,
                            status: 1
                        }
                        // cache: false,

                    })
                    .done(function() {
                        //thông báo thêm thành công
                        //xóa hết dữ liệu củ
                        $("#modalPostStatus").modal("show");
                        $("#modalPostStatus h4").html("Thêm bài viết thành công");
                        $("#titlepost").val("");
                        $('#imagepost').val("");
                        tinyMCE.get('mytextareapost').setContent("");

                    });
            } else {
                $("#modalPostStatus").modal("show");
                $("#modalPostStatus h4").html("Vui lòng điền đủ dữ liệu");
            }
        });
    })


})(jQuery);