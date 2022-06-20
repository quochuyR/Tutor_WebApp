(function () {
    Dropzone.autoDiscover = false;
    // Dropzone.discover();
    var dropzoneProfile;
    var basic;
    $(document).ready(function () {
        var src_img = $("#my-image").prop("src");
        let tuid = $("#tuid").val();
        var data = new URL(`./tutor_details?id=${tuid}`, window.location.href);

        // When the avatar changes, reattach the src_img. variable.
        $("#my-image").on('load', (e) => {
            // console.log(e.target.src)
            src_img = e.target.src;
        })
        console.log(data);
        //
        var option = {
            "width": 360,
            "height": 360,
            "data": data.href,
            "image": src_img,
            "margin": 20,
            "qrOptions": {
                "typeNumber": "0",
                "mode": "Byte",
                "errorCorrectionLevel": "M"
            },
            "imageOptions": {
                "hideBackgroundDots": true,
                "imageSize": 0.6,
                "margin": 10
            },
            "dotsOptions": {
                "type": "classy",
                "color": "#45b8ac"
            },
            "backgroundOptions": {
                "color": "#ffffff"
            },
            "dotsOptionsHelper": {
                "colorType": {
                    "single": true,
                    "gradient": false
                }
            },
            "cornersSquareOptions": {
                "type": "extra-rounded",
                "color": "#038f7e"
            },
            "cornersSquareOptionsHelper": {
                "colorType": {
                    "single": true,
                    "gradient": false
                }
            },
            "cornersDotOptions": {

                "color": "#038f81",
                "gradient": null
            },
            "cornersDotOptionsHelper": {
                "colorType": {
                    "single": true,
                    "gradient": false
                }
            },
            "backgroundOptionsHelper": {
                "colorType": {
                    "single": true,
                    "gradient": false
                },

            }
        }
        var QRModalEl = document.getElementById('QRModal')
        QRModalEl?.addEventListener('shown.bs.modal', function (event) {
            option.image = src_img;
            qrCode.update(option);
        })

        let qrCode = new QRCodeStyling(option);

        qrCode.append(document.getElementById("canvas"));
        $("#download").on('click', (e) => {
            qrCode.download({
                name: "qr-tutor",
                extension: "png"
            });
        });

        // Dropzone

        // dropzone
        if (document.querySelector("div#profile")) {
            dropzoneProfile = new Dropzone("div#profile", {
                // Configuration options go here
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 1,
                acceptedFiles: ".png,.jpg,.jpeg",
                autoProcessQueue: false,
                addRemoveLinks: true,
                uploadMultiple: true,
                // Dịch sang tiếng Việt
                dictDefaultMessage: "Kéo và thả file (có thể click) vào đây để upload<br>Ngoài ra bạn có thể chụp ảnh màn hình và dán vào trang web",
                dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ kéo và thả upload file.",
                dictFallbackText: "Vui lòng sử dụng biểu mẫu dự phòng bên dưới để tải lên các file của bạn như ngày xưa.",
                dictFileTooBig: "File quá lớn ({{filesize}}MiB). Tối đa filesize: {{maxFilesize}}MiB.",
                dictInvalidFileType: "Bạn không thể tải lên các file thuộc loại này (chú ý đến đuôi file).",
                dictResponseError: "Máy chủ đã phản hồi với {{statusCode}} code.",
                dictCancelUpload: "Huỷ bỏ upload",
                dictUploadCanceled: "Upload đã huỷ bỏ.",
                dictCancelUploadConfirmation: "Bạn có chắc chắn muốn hủy upload này không?",
                dictRemoveFile: "Xoá file",
                dictRemoveFileConfirmation: null,
                dictMaxFilesExceeded: "Bạn không thể tải lên bất kỳ tệp nào nữa.",
                init: function () {
                    let upload = this;
                    // Restrict to 1 file uploaded
                    upload.on("addedfile", function (file) {
                        if (upload.files[1] != null) {
                            upload.removeFile(upload.files[0]);
                        }

                        basic.croppie('bind', {
                            url: URL.createObjectURL(file),
                            // points: [77, 469, 280, 739]
                        });
                        console.log(URL.createObjectURL(file))


                    });
                    // If validation passes, process queue and add insurance
                    $("#save-change-picture").on("click", function (e) {
                        e.preventDefault();
                        // upload.processQueue();
                        // console.log(upload.files[0].dataURL, "upload")

                        basic.croppie('result', {
                            type: 'blob',
                            size: 'viewport',
                            format: 'jpeg'
                        }).then(function (image) {
                            // html is div (overflow hidden)
                            // with img positioned inside.


                            let formData = new FormData();
                            formData.append("file[]", image, "image.jpg");
                            // console.log(event.target.result)
                            $.ajax({
                                type: "post",
                                url: "profile",
                                contentType: false,
                                processData: false,
                                data: formData,
                                cache: false,
                                success: function (data) {
                                    if (data.action === "success") {
                                        $("img.avatar").each((i, img) => {
                                            img.src = "../public/images/" + data.fileName;
                                        });

                                        Toastify({
                                            text: "Đổi ảnh đại diện thành công!",
                                            duration: 5000,
                                            close: true,
                                            gravity: "top", // `top` or `bottom`
                                            position: "right", // `left`, `center` or `right`
                                            stopOnFocus: true, // Prevents dismissing of toast on hover
                                            style: {
                                                background: "linear-gradient(to right, #56C596, #7BE495)",
                                            },
                                            onClick: function () { }
                                        });
                                    }
                                    console.log(data, "profile")
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr);
                                }
                            });


                        });


                    });
                },
            });
        }


        document.onpaste = function (event) {
            const items = (event.clipboardData || event.originalEvent.clipboardData).items;
            items.forEach((item) => {
                if (item.kind === 'file') {
                    // adds the file to your dropzone instance
                    dropzoneProfile.addFile(item.getAsFile())
                }
            })
        }

        basic = $('#demo-basic').croppie({
            enableExif: true,
            viewport: {
                width: 320,
                height: 320,
                type: 'square'

            },

            boundary: {
                width: 720,
                height: 360,
            },
            showZoomer: true,
            mouseWheelZoom: 'ctrl',
        });

        $('#change-picture').on('shown.bs.modal', function () {
            basic.croppie('bind', {
                url: src_img,
                // points: [77, 469, 280, 739]
            });
        });


        //on button click



    });

    // paste into dropzone



    //


})();