<?php

use Classes\DayOfWeek, Classes\Time, Library\Session;
require_once(__DIR__ . "../../vendor/autoload.php");


// include_once "../classes/dayofweeks.php";
// include_once "../classes/times.php";
// include_once "../lib/session.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (Session::checkRoles(["user"]) !== true) {
    // echo '<script> var myModal = new bootstrap.Modal(document.getElementById("modalLogin"), {
    //         keyboard: false
    //     });
    //     myModal.show();
    // </script>';
}
?>



<?php



$dayofweeks = new DayOfWeek();
$_times = new Time();
?>



<?php
$title = "Đăng kí trở thành gia sư";

$nav_tutor_register_form_active = "active";
include "../inc/header.php";



?>


<div id="main" class="container ">
    <div class="  py-3 mx-sm-auto">
        <div class="row g-0 d-flex justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-9 col-11 text-center">
                <!-- <p class="blue-text">Just answer a few questions<br> so that we can personalize the right experience for you.</p> -->
                <div class="card py-3">
                    <div class="card-body">
                        <h3 class="fw-bold">Đăng kí dạy kèm</h3>

                        <form class="form-card" id="register-form">
                            <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-between text-start">
                                        <h5 class="text-start fw-bold mb-4 border-bottom pt-2 pb-2">Thông tin cá nhân</h5>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label ">Số điện thoại<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-phone-number" name="current-phone-number" placeholder="Nhập số điện thoại" value="">
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label ">Địa chỉ email<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-email" name="current-email" placeholder="Địa chỉ email" value="">
                                        </div>

                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label ">Địa chỉ<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-address" name="current-address" placeholder="Địa chỉ ở hiện tại" value="">
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-start fw-bold md-4 border-bottom pb-2 pt-2">Thông tin gia sư</h5>
                                    <div class="row justify-content-between text-start pt-3">
                                        <div class="form-group col-sm-4 flex-column d-flex">
                                            <label class="form-control-label">Bạn đang là<span class="text-danger"> *</span></label>
                                            <select class="form-select" name="job" id="job">

                                                <?php
                                                $option = array("Sinh viên", "Giáo viên", "Chuyên gia", "Người đi làm", "Người nước ngoài");
                                                foreach ($option as $value) :
                                                ?>
                                                    <option value="<?= $value ?>"><?= $value ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-8 flex-column d-flex">
                                            <label class="form-control-label">Môn dạy học<span class="text-danger"> *</span></label>
                                            <select class=" js-data-subjects-ajax select2bs5" name="subject" multiple="multiple">


                                            </select>

                                        </div>



                                        <div class="form-group col-sm-4 flex-column d-flex">
                                            <label class="form-control-label ">Khu vực bạn đang ở<span class="text-danger"> *</span></label>
                                            <div id="provinces" class=""></div>
                                        </div>
                                        <div class="form-group col-sm-8 flex-column d-flex">
                                            <label class="form-control-label ">Khu vực bạn có thể dạy<span class="text-danger"> *</span></label>
                                            <select class="form-select js-data-districts-ajax" name="districts[]">


                                            </select>
                                        </div>


                                        <div class="form-group col-sm-8 flex-column d-flex">
                                            <label class="form-control-label ">Trường bạn đã học<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="collage" name="collage" placeholder="Tên trường học" value="">
                                        </div>
                                        <div class="form-group col-sm-4 flex-column d-flex">
                                            <label class="form-control-label ">Năm tốt nghiệp<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="graduate-year" name="graduate-year" placeholder="Năm tốt nghiệp" value="">
                                        </div>
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label ">Hình thức dạy<span class="text-danger"> *</span></label>
                                            <select class="form-select js-data-teaching-form-ajax select2bs5" id="teaching-form" name="teaching-form[]">


                                            </select>
                                        </div>


                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Facebook của bạn (link)</label>
                                            <input class="form-control" type="text" id="face" name="face" placeholder="https://www.facebook.com/nguyenvana.203" value="">

                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Twitter của bạn (link)</label>
                                            <input class="form-control" type="text" id="twit" name="twit" placeholder="https://twitter.com/nguyenvana" value="">

                                        </div>


                                        <div class="form-group col-12 flex-column d-flex">
                                            <span class="input-group-text">Mô tả bản thân</span>
                                            <div id="toolbar-container"></div>
                                            <div id="editor" name="editor">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- lịch đăng kí dạy kèm   -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-between text-start">
                                        <h5 class="header-title fw-bold pb-2 border-bottom">Thời gian có thể nhận lớp</h5>
                                        <div class="row g-0">
                                            <div class="form-group col-sm-12">

                                                <?php
                                                $dow_list = $dayofweeks->getAll();
                                                while ($resultDOW = $dow_list->fetch_assoc()) {


                                                ?>
                                                    <div class="px-sm-3" id="<?= $resultDOW["id"] ?>">
                                                        <b><?= $resultDOW["day"] ?></b>
                                                        <div class="row g-0 my-2 justify-content-center d-flex justify-content-around">
                                                            <?php
                                                            $time_list = $_times->getAll();
                                                            while ($resultTimes = $time_list->fetch_assoc()) {

                                                            ?>

                                                                <div class="form-check me-2 col-3 col-sm-3 col-lg-auto " data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $resultTimes["time"] ?>">
                                                                    <input class="form-check-input" type="checkbox" id="<?= $resultDOW["id"] . $resultTimes["id"] ?>" name="teaching_time[]" value="<?= $resultTimes["id"] ?>" />
                                                                    <label class="form-check-label" for="<?= $resultDOW["id"] . $resultTimes["id"] ?>">
                                                                        <?= "tiết " . $resultTimes["id"] ?>
                                                                    </label>
                                                                </div>

                                                            <?php

                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                <?php
                                                } ?>


                                                <div class="error-checkbox"></div>

                                                <div class="card mt-4 bg-notes mx-3">
                                                    <div class="card-body px-md-4">
                                                        <h5 class="card-title fw-bold">Ghi chú</h5>
                                                        <?php
                                                        $time_list = $_times->getAll();
                                                        while ($resultTimes = $time_list->fetch_assoc()) {

                                                        ?>
                                                            <div class="form-check me-2 col-12 col-sm-4  py-1">
                                                                <span id="<?= $resultDOW["id"] . $resultTimes["id"] ?>"> <b><?= "Tiết " . $resultTimes["id"] ?>: </b> <span class="ps-2 fw-regular"><?= $resultTimes["time"] ?></span> </span>

                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div id="layoutSubmit" class="form-group col-sm-6">
                                    <button id="submit-register" type="submit" class="btn btn-register">Gửi yêu cầu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php


include "../inc/script.php"
?>
<script>
    (function() {
        let MyEditor;

        $(document).ready(function() {
            DecoupledEditor
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
            $.validator.addMethod("validOrNah", function(value, element) {

                console.log($(element)[0].selectedIndex, "element")
                if ($(element)[0].selectedIndex === 0) {
                    return false;
                } else {

                }
                return true;

            });

            // dành cho checkbox



            // dành cho ckeditor
            $.validator.addMethod("ck_editor", function(value, element) {
                var content_length = MyEditor.getData().trim().length;
                // console.log(element)
                return content_length > 0;

            }, "Vui lòng thêm nội dung mô tả.");

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
                errorPlacement: function(label, element) {
                    if ($(element).hasClass('select2bs5')) {
                        label.insertAfter($(element).next(".select2-container")).addClass('mt-2 text-danger');

                    } else if ($(element).is(":checkbox")) {
                        label.insertAfter($(element).closest(".form-group").children(".error-checkbox")).addClass('mt-2 text-danger');

                    } else {
                        label.insertAfter(element).addClass('mt-2 text-danger');
                    }
                },
                success: function(label, element) {


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

                $('.js-data-districts-ajax').select2('data').map(val => {
                    districts += val.text + ", "
                });
                $('.js-data-teaching-form-ajax').select2('data').map(val => {
                    teachingForm += val.id + ", "
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
                    success: function(data) {
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
                                onClick: function() {} // Callback after click
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
                                onClick: function() {} // Callback after click
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
                                onClick: function() {} // Callback after click
                            }).showToast();
                        }
                        console.log(data)
                        console.log("1huy2k3");
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, error, status, "Lỗi");
                    }
                });

            });
            // }


        });

    })();
</script>
<?php include '../inc/footer.php' ?>