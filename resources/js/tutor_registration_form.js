(function () {
    let MyEditor;
    Dropzone.autoDiscover = false;
    var dropzoneCertificate;
    $(document).ready(function () {
        document.querySelector('#editor') && DecoupledEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết nhất về kiến thức của bạn!',
                ckfinder: {
                    uploadUrl: "../editor/uploadImages.php"
                }
            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                MyEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        // dành cho select

        // Dropzone
        //  Dropzone.discover();
        if (document.querySelector("div#certificate")) {
            dropzoneCertificate = new Dropzone("div#certificate", {
                // Configuration options go here
                url: "../api/tutor/tutor_register",
                paramName: "file", // The name that will be used to transfer the file
                parallelUploads: 10,
                maxFilesize: 2, // MB
                maxFiles: 10,
                acceptedFiles: ".png,.jpg,.jpeg",
                autoProcessQueue: false,
                addRemoveLinks: true,
                uploadMultiple: true,
                // Dịch sang tiếng Việt
                dictDefaultMessage: "Kéo và thả file (có thể click) vào đây để upload <br>Ngoài ra bạn có thể chụp ảnh màn hình và dán vào trang web",
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

                    $("#upload-certificate").on("click", function (e) {
                        e.preventDefault();
                        if (confirm("Bạn đã chắc chắn chưa? Vì bạn chỉ thêm ảnh bằng cấp được 1 lần.") === true)
                            upload.processQueue();


                    });

                    this.on("addedfile", file => {

                        $("#certificate_dropzone-error")?.remove()
                    });
                },
                accept: function (file, done) {
                    if (file.size === 0) {
                        done("Không có file nào. Vui lòng upload file.");
                    } else {
                        done();
                    }
                }
            });
        }



    });

    // paste into dropzone

    document.onpaste = function (event) {
        const items = (event.clipboardData || event.originalEvent.clipboardData).items;
        items.forEach((item) => {
            if (item.kind === 'file') {
                // adds the file to your dropzone instance
                dropzoneCertificate.addFile(item.getAsFile())
            }
        })
    }

    //


    $.validator.addMethod("validOrNah", function (value, element) {

        console.log($(element)[0].selectedIndex, "element")
        if ($(element)[0].selectedIndex === 0) {
            return false;
        } else {

        }
        return true;

    });

    // dành cho checkbox



    // dành cho ckeditor
    $.validator.addMethod("ck_editor", function (value, element) {
        var content_length = MyEditor.getData().trim().length;
        // console.log(element)
        return content_length > 0;

    }, "Vui lòng thêm nội dung mô tả.");

    // dành cho dropzone
    $.validator.addMethod("dropzone_validation", function (value, element) {

        var is_exists_file = dropzoneCertificate.files.length;
        // console.log(is_exists_file)
        return is_exists_file > 0;

    }, "Vui lòng thêm ảnh bằng cấp.");

    $("#register-form").validate({

        ignore: [],
        rules: {
            "current-phone-number": {
                required: true,
                rangelength: [10, 10]
            },
            "current-email": {
                required: true,
                email: true
            },
            "current-address": {
                required: true,
                minlength: 5
            },
            "subject": {
                required: true,
            },
            "province": {
                validOrNah: true,
            },
            "districts[]": {
                required: true,
                // minlength: 1
            },
            "collage": {
                required: true,
                minlength: 5
            },
            "graduate-year": {
                required: true,
                digits: true
            },
            "teaching-form[]": {
                required: true,
                minlength: 1
            },
            "editor": {
                ck_editor: true
            },
            "teaching_time[]": {
                required: true
            },
            "certificate_dropzone": {
                dropzone_validation: true
            }
        },
        messages: {
            "current-phone-number": "Số điện thoại phải đủ 10 kí tự.",
            "current-email": "Email sai định dạng.",
            "current-address": "Địa chỉ nhiều hơn 5 kí tự.",
            "subject": "Vui lòng chọn môn học.",
            "province": "Vui lòng chọn tỉnh/thành phố.",
            "districts[]": "Vui lòng chọn huyện/thị xã.",
            "collage": "Trường phải ít nhất 5 kí tự",
            "graduate-year": "Năm tốt nghiệp không được trống và phải là số",
            "teaching-form[]": "Vui lòng chọn hình thức dạy.",
            "teaching_time[]": "Vui lòng chọn ít nhất một buổi dạy.",
        },
        errorPlacement: function (label, element) {
            if ($(element).hasClass('select2bs5')) {
                label.insertAfter($(element).next(".select2-container")).addClass('mt-2 text-danger');

            } else if ($(element).is(":checkbox")) {
                label.insertAfter($(element).closest(".form-group").children(".error-checkbox")).addClass('mt-2 text-danger');

            } else {
                label.insertAfter(element).addClass('mt-2 text-danger');
            }
        },
        success: function (label, element) {


        },
        submitHandler: (form) => {
            // submitRegisterForm();
            // form.submit();
            console.log("1huy2k")
        }
    });



    // function submitRegisterForm() {
    $("#register-form").on('submit', (e) => {

        e.preventDefault();
        let $form = $(e.target);
        console.log(dropzoneCertificate)

        if (!$form.valid()) return false;
        // 
        let token = $("#token").val();
        let currentPhone = $("#current-phone-number").val();
        let currentEmail = $("#current-email").val();
        let currentAddress = $("#current-address").val();
        let currentJob = $("#job").val();
        let currentProvince = $("#province option:selected").text()
        let currentCollage = $("#collage").val();
        let graduateYear = $("#graduate-year").val();
        let districts = "";
        let teachingForm = "";
        let subjects = [];
        let linkFace = $("#face").val();
        let linkTwit = $("#twit").val();
        let description = MyEditor.getData();

        let Sunday = {
            dayId: "0",
            timeId: []
        },
            Monday = {
                dayId: "1",
                timeId: []
            },
            Tuesday = {
                dayId: "2",
                timeId: []
            },
            Wednesday = {
                dayId: "3",
                timeId: []
            },
            Thursday = {
                dayId: "4",
                timeId: []
            },
            Friday = {
                dayId: "5",
                timeId: []
            },
            Saturday = {
                dayId: "6",
                timeId: []
            };

        // teaching time
        $(`#0`).find("input[type='checkbox']:checked").each((i, elem) => {
            Sunday.timeId.push($(elem).val())
        });

        $(`#1`).find("input[type='checkbox']:checked").each((i, elem) => {
            Monday.timeId.push($(elem).val())

        });

        $(`#2`).find("input[type='checkbox']:checked").each((i, elem) => {
            Tuesday.timeId.push($(elem).val())
        });

        $(`#3`).find("input[type='checkbox']:checked").each((i, elem) => {
            Wednesday.timeId.push($(elem).val())
        });

        $(`#4`).find("input[type='checkbox']:checked").each((i, elem) => {
            Thursday.timeId.push($(elem).val())
        });

        $(`#5`).find("input[type='checkbox']:checked").each((i, elem) => {
            Friday.timeId.push($(elem).val())
        });

        $(`#6`).find("input[type='checkbox']:checked").each((i, elem) => {
            Saturday.timeId.push($(elem).val())
        });



        // select2


        $('.js-data-subjects-ajax').select2('data').map(val => {
            subjects.push({
                id: val.id,
                "subject": val.text
            })
        });

        $('.js-data-districts-ajax').select2('data').map((val, i, arr) => {
            if (arr.length - 1 === i) {

                districts += val.text;
            }
            else {
                districts += val.text + ", "

            }
        });
        $('.js-data-teaching-form-ajax').select2('data').map((val, i, arr) => {
            if (arr.length - 1 === i) {
                teachingForm += val.id

            }
            else {
                teachingForm += val.id + ", "

            }
        });

        console.log(teachingForm)

        $.ajax({
            type: "post",
            url: "../api/tutor/tutor_register",
            data: {
                token,
                currentPhone,
                currentEmail,
                currentAddress,
                currentJob,
                currentProvince,
                currentCollage,
                graduateYear,
                districts,
                teachingForm,
                subjects,
                linkFace,
                linkTwit,
                description,
                Sunday: Sunday.timeId.length > 0 && Sunday,
                Monday: Monday.timeId.length > 0 && Monday,
                Tuesday: Tuesday.timeId.length > 0 && Tuesday,
                Wednesday: Wednesday.timeId.length > 0 && Wednesday,
                Thursday: Thursday.timeId.length > 0 && Thursday,
                Friday: Friday.timeId.length > 0 && Friday,
                Saturday: Saturday.timeId.length > 0 && Saturday,
            },
            cache: false,
            success: function (data) {
                // if(data !== '0')
                if (data.author === 'isTutor') {
                    Toastify({
                        text: "Bạn đã là gia sư rồi!",
                        duration: 5000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #C73866, #FE676E)",
                        },
                        onClick: function () { } // Callback after click
                    }).showToast();
                }
                if (data.insert === 'successful') {
                    Toastify({
                        text: "Đăng kí thành công. Bạn hãy chờ duyệt nhé!",
                        duration: 5000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #56C596, #7BE495)",
                        },
                        onClick: function () { } // Callback after click
                    }).showToast();
                } else if (data.insert === 'fail') {
                    Toastify({
                        text: "Đăng kí không thành công. Bạn đã đăng kí rồi!",
                        duration: 5000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #C73866, #FE676E)",
                        },
                        onClick: function () { } // Callback after click
                    }).showToast();
                }
                console.log(data)
                console.log("1huy2k3");
            },
            error: function (xhr, status, error) {
                console.log(xhr, error, status, "Lỗi");
            }
        });

    });
    // }



})();