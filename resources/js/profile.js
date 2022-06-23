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

        $("#provinces-update") && $.ajax({
            type: "get",
            url: "https://vapi.vnappmob.com/api/province/",
            cache: false,
            success: function (data) {
                // if(data !== '0')
                let ObjProvinces = Object.assign({}, data); // copy to new obj
                let provinces = [...Object.values(ObjProvinces)]; // convert to array
                let data_province_default = $("#provinces-update").attr("data-name");
                // create many options of select
                let optionOfSelect = `<option value="0">--Chọn tỉnh--</option>`

                provinces[0].map((val, idx) => {

                    optionOfSelect += `<option value="${val.province_id}" ${val.province_name === data_province_default && 'selected'}>${val.province_name}</option>`
                    // console.log()
                })
                console.log(provinces)
                $("#provinces-update").html(`<select id = "province" name="province" class="form-select" >${optionOfSelect}</select>`); // join option into select

                onLoadDistrict();

                console.log(data, "data")
            },
            error: function (xhr, status, error) {
                console.log(xhr, error, status, "Lỗi");
            }
        });

        $("#provinces-update").on('change', (e) => {
            select2District(e);
        });



        function select2District(e) {
            $('.js-data-districts-ajax-update').select2('destroy');
            $('.js-data-districts-ajax-update').select2({
                theme: 'bootstrap-5',
                language: "vi",
                multiple: true,
                ajax: {
                    url: `https://vapi.vnappmob.com/api/province/district/${e.target.value}`,
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term
                        }

                    },
                    processResults: function (data, params) {
                        params.term = params.term ? params.term : 'all'
                        console.log(params)

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: $.map(data.results, (val) => {
                                // console.log(val.district_name.toUpperCase().includes(params.term.toUpperCase()), "pấm")

                                if (params.term === 'all') {
                                    return {
                                        id: val.district_id,
                                        text: val.district_name
                                    }
                                }
                                if (val.district_name.toUpperCase().includes(params.term.toUpperCase())) {
                                    return {
                                        id: val.district_id,
                                        text: val.district_name
                                    }
                                }


                            }),
                        }
                    },
                    cache: true
                },
                placeholder: 'Gõ chữ bất kì để tìm huyện',
            }).on("select2:close", function (e) {  // validation select2
                // $(this).valid();
            });






        }


        function onLoadDistrict() {
            var districts_update = $('.js-data-districts-ajax-update');

            var province_id = $("#province").find(":selected").val();
            $('.js-data-districts-ajax-update').select2({
                theme: 'bootstrap-5',
                language: "vi",
                multiple: true,
                ajax: {
                    url: `https://vapi.vnappmob.com/api/province/district/${province_id}`,
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term
                        }

                    },
                    processResults: function (data, params) {
                        params.term = params.term ? params.term : 'all'
                        console.log(params)

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: $.map(data.results, (val) => {
                                // console.log(val.district_name.toUpperCase().includes(params.term.toUpperCase()), "pấm")

                                if (params.term === 'all') {
                                    return {
                                        id: val.district_id,
                                        text: val.district_name
                                    }
                                }
                                if (val.district_name.toUpperCase().includes(params.term.toUpperCase())) {
                                    return {
                                        id: val.district_id,
                                        text: val.district_name
                                    }
                                }


                            }),
                        }
                    },
                    cache: true

                },
                placeholder: 'Gõ chữ bất kì để tìm huyện',

            });

            console.log(province_id);
            $.ajax({
                type: 'GET',
                url: `https://vapi.vnappmob.com/api/province/district/${province_id}`
            }).then(function (data) {
                // create the option and append to Select2


                let data_district_tutor = districts_update.attr("data-district-name")?.split(", ");
                console.log(data_district_tutor, "data_district_tutor")
                data.results.map((district_ajax) => {
                    // console.log(data_district_tutor[i], district_ajax.district_name,  "data_district_tutor[i]")

                    if (data_district_tutor.find(district_tutor => district_tutor === district_ajax.district_name)) {
                        let option = new Option(district_ajax.district_name, district_ajax.district_id, true, true);
                        districts_update.append(option).trigger('change');
                    }
                })


                console.log(data, "data-select2")
                // manually trigger the `select2:select` event
                districts_update.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.results
                    }
                });
            });
        }

        var teaching_form_update = $('.js-data-teaching-form-ajax-update');
        teaching_form_update.select2({
            theme: 'bootstrap-5',
            language: "vi",
            multiple: true,
            data: [
                { id: 0, text: "Trực tuyến (Online)" },
                { id: 1, text: "Gặp mặt (Offline)" }],
            placeholder: 'Gõ chữ bất kì để tìm hình thức dạy',
            // templateResult: formatRepo,
            // templateSelection: formatRepoSelection
        }).on("select2:close", function (e) {  // validation select2
            // $(this).valid();
        });

        /* */

        var last_element_update;
        $("input[type='text']").on('change', (e) => {
            console.log($(e.target).offset().top)
            last_element_update =  $(e.target).offset().top - 50;

        });

        $("input[type='checkbox']").on('change', (e) => {
            console.log($(e.target).offset().top)
            last_element_update =  $(e.target).offset().top - 50;

        });

        $("select").on('change', (e) => {
            console.log($(e.target).offset().top)
            last_element_update =  $(e.target).offset().top - 50;

        });


        /* */

        var value_default_teaching_form = teaching_form_update.attr("data-teaching-form")?.split(", ")
        console.log(value_default_teaching_form)
        teaching_form_update.val(value_default_teaching_form).trigger('change');
        var arr_del_teaching_time = [], arr_add_teaching_time = [];

        $("#tutor-form-update").on('submit', (e) => {
            e.preventDefault();


            let token = $("#token").val();
            let currentPhone = $("#current-phone-number").val();
            let currentEmail = $("#current-email").val();
            let currentAddress = $("#current-address").val();
            let currentProvince = $("#province option:selected").text()
            let districts = "";
            let teachingForm = "";
            let linkFace = $("#face").val();
            let linkTwit = $("#twit").val();


            $('.js-data-districts-ajax-update').select2('data').map((val, i, arr) => {
                if (arr.length - 1 === i) {

                    districts += val.text;
                }
                else {
                    districts += val.text + ", "

                }
            });
            $('.js-data-teaching-form-ajax-update').select2('data').map((val, i, arr) => {
                if (arr.length - 1 === i) {
                    teachingForm += val.id

                }
                else {
                    teachingForm += val.id + ", "

                }
            });

            arr_add_teaching_time = [];
            arr_del_teaching_time = [];

            /* Kiểm tra có timeId không nếu có thêm vào mảng xoá time */
            if(Sunday_del.length > 0){
                arr_del_teaching_time.push(Sunday_del)
            }
            if(Monday_del.length > 0){
                arr_del_teaching_time.push(Monday_del)
            }
            if(Tuesday_del.length > 0){
                arr_del_teaching_time.push(Tuesday_del)
            }
            if(Wednesday_del.length > 0){
                arr_del_teaching_time.push(Wednesday_del)
            }
            if(Thursday_del.length > 0){
                arr_del_teaching_time.push(Thursday_del)
            }
            if(Friday_del.length > 0){
                arr_del_teaching_time.push(Friday_del)
            }
            if(Saturday_del.length > 0){
                arr_del_teaching_time.push(Saturday_del)
            }

            /* Kiểm tra có timeId không nếu có thêm vào mảng thêm time */
            if(Sunday_add.length > 0){
                arr_add_teaching_time.push(Sunday_add)
            }
            if(Monday_add.length > 0){
                arr_add_teaching_time.push(Monday_add)
            }
            if(Tuesday_add.length > 0){
                arr_add_teaching_time.push(Tuesday_add)
            }
            if(Wednesday_add.length > 0){
                arr_add_teaching_time.push(Wednesday_add)
            }
            if(Thursday_add.length > 0){
                arr_add_teaching_time.push(Thursday_add)
            }
            if(Friday_add.length > 0){
                arr_add_teaching_time.push(Friday_add)
            }
            if(Saturday_add.length > 0){
                arr_add_teaching_time.push(Saturday_add)
            }
           
           

           
            console.log(arr_del_teaching_time, arr_add_teaching_time);
            $.ajax({
                type: "post",
                url: "../api/tutor/updateinfotutor",
                data: {
                    token,
                    currentPhone,
                    currentEmail,
                    currentAddress,
                    currentProvince,
                    districts,
                    teachingForm,
                    linkFace,
                    linkTwit,
                    arr_add_teaching_time,
                    arr_del_teaching_time
                }

                ,
                cache: false,
                success: function (data) {

                    if (data.update === "successful") {
                        window.location.reload();
                        localStorage.setItem("scrollpos", last_element_update);
                        console.log(last_element_update, "scrollpos" )
                    }

                    console.log(data)
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });






        

        // 



        var Sunday_del = [],
            Monday_del = [],
            Tuesday_del = [],
            Wednesday_del = [],
            Thursday_del = [],
            Friday_del = [],
            Saturday_del = [];

        // chọn tất cả thẻ input có type = checkbox, name = teaching_time[]
        // không bị disabled và đã checked
        $("input[type='checkbox'][name='teaching_time[]']:not(:disabled):checked").on("change", (e) => {


            if ($(e.target).prop("checked")) {
                if ($(e.target).attr("data-day-id") === "0") {
                    const index = Sunday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Sunday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "1" ) {
                    const index = Monday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Monday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }
                else if ($(e.target).attr("data-day-id") === "2") {
                    const index = Tuesday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Tuesday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }
                else if ($(e.target).attr("data-day-id") === "3" ) {
                    const index = Wednesday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Wednesday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "4") {
                    const index = Thursday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Thursday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "5") {
                    const index = Friday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Friday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "6") {
                    const index = Saturday_del.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Saturday_del.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

            }

            else {
                
                if ($(e.target).attr("data-day-id") === "0" && Sunday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Sunday_del.push({
                        dayId: 0,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "1" && Monday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Monday_del.push({
                        dayId: 1,
                        timeId: e.target.value
                    })

                }
                else if ($(e.target).attr("data-day-id") === "2" && Tuesday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Tuesday_del.push({
                        dayId: 2,
                        timeId: e.target.value
                    })

                }
                else if ($(e.target).attr("data-day-id") === "3" && Wednesday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Wednesday_del.push({
                        dayId: 3,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "4" && Thursday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Thursday_del.push({
                        dayId: 4,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "5" && Friday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Friday_del.push({
                        dayId: 5,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "6" && Saturday_del.findIndex(val => e.target.value === val.timeId) < 0) {
                    Saturday_del.push({
                        dayId: 6,
                        timeId: e.target.value
                    })

                }


            }




           

            // console.log(Sunday_del, Monday_del, Tuesday_del, Wednesday_del, Thursday_del,
            //      Friday_del, Saturday_del, Sunday_del)
        });




        var Sunday_add = [],
            Monday_add = [],
            Tuesday_add = []
            Wednesday_add = [],
            Thursday_add = [],
            Friday_add = [],
            Saturday_add = [];

        // chọn tất cả thẻ input có type = checkbox, name = teaching_time[]
        // không bị disabled và đã checked
        $("input[type='checkbox'][name='teaching_time[]']:not(:disabled):not(:checked)").on("change", (e) => {

            console.log(e.target.value, "not checked")
            if (!$(e.target).prop("checked")) {
                if ($(e.target).attr("data-day-id") === "0") {
                    const index = Sunday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Sunday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "1" ) {
                    const index = Monday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Monday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }
                else if ($(e.target).attr("data-day-id") === "2" ) {
                    const index = Tuesday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Tuesday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }
                else if ($(e.target).attr("data-day-id") === "3" ) {
                    const index = Wednesday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Wednesday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "4" ) {
                    const index = Thursday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Thursday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "5" ) {
                    const index = Friday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Friday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

                else if ($(e.target).attr("data-day-id") === "6" ) {
                    const index = Saturday_add.findIndex(val => e.target.value === val.timeId);
                    if (index > -1) {
                        Saturday_add.splice(index, 1); // 2nd parameter means remove one item only
                    }

                }

            }

            else {

                if ($(e.target).attr("data-day-id") === "0" && Sunday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Sunday_add.push({
                        dayId: 0,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "1" && Monday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Monday_add.push({
                        dayId: 1,
                        timeId: e.target.value
                    })

                }
                else if ($(e.target).attr("data-day-id") === "2" && Tuesday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Tuesday_add.push({
                        dayId: 2,
                        timeId: e.target.value
                    })

                }
                else if ($(e.target).attr("data-day-id") === "3" && Wednesday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Wednesday_add.push({
                        dayId: 3,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "4" && Thursday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Thursday_add.push({
                        dayId: 4,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "5" && Friday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Friday_add.push({
                        dayId: 5,
                        timeId: e.target.value
                    })

                }

                else if ($(e.target).attr("data-day-id") === "6" && Saturday_add.findIndex(val => e.target.value === val.timeId) < 0) {
                    Saturday_add.push({
                        dayId: 6,
                        timeId: e.target.value
                    })

                }


            }







            console.log(Sunday_add, Monday_add, Tuesday_add, Wednesday_add, Thursday_add,
                Friday_add, Saturday_add)
        })



    });


    // paste into dropzone



   
    //


})();