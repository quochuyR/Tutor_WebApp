<?php

use Classes\DayOfWeek, Classes\Time, Library\Session;

?>

<!DOCTYPE html>
<html lang="en">
<?php

$title = "Đăng kí trở thành gia sư";
include "../inc/head.php";

include_once "../classes/dayofweeks.php";
include_once "../classes/times.php";
include_once "../lib/session.php";


?>

<?php

if (Session::checkRoles(["user"]) !== true) {
    header("location: errors/404");
}

$dayofweeks = new DayOfWeek();
$_times = new Time();
?>

<body>
    <div class="container-fluid px-0">
        <header class="row g-0 m-0">

            <?php
            $nav_tutor_active = "active";
            include "../inc/header.php";
            ?>

        </header>
        <div id="main" class="container ">
            <div class="  py-3 mx-sm-auto">
                <div class="row g-0 d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-9 col-11 text-center">
                        <!-- <p class="blue-text">Just answer a few questions<br> so that we can personalize the right experience for you.</p> -->
                        <div class="card px-sm-3 py-3">
                            <div class="card-body">
                                <h3>Đăng kí dạy kèm</h3>
                                <h5 class="text-start mb-4 border-bottom pt-2 pb-2">Thông tin cá nhân</h5>
                                <form class="form-card" id="register-form">
                                    <div class="row justify-content-between text-start">

                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3">Số điện thoại<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-phone-number" name="current-phone-number" placeholder="Nhập số điện thoại" value="">
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-2">Địa chỉ email<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-email" name="current-email" placeholder="Địa chỉ email" value="">
                                        </div>

                                    </div>

                                    <div class="row justify-content-between text-start">
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Địa chỉ<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="current-address" name="current-address" placeholder="Địa chỉ ở hiện tại" value="">
                                        </div>
                                    </div>

                                    <h5 class="text-start md-4 border-bottom pb-2 pt-2">Thông tin gia sư*</h5>
                                    <div class="row justify-content-between text-start pt-3">
                                        <div class="form-group col-sm-4 flex-column d-flex">
                                            <label class="form-control-label px-3">Bạn đang là<span class="text-danger"> *</span></label>
                                            <select class="form-select" name="job" id="job">
                                                <option value="Sinh viên">Sinh viên</option>
                                                <option value="Sinh viên">Giáo viên</option>
                                                <option value="Sinh viên">Chuyên gia</option>
                                                <option value="Sinh viên">Người đi làm</option>
                                                <option value="Sinh viên">Người nước ngoài</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-8 flex-column d-flex">
                                            <label class="form-control-label px-3">Môn dạy học<span class="text-danger"> *</span></label>
                                            <select class=" js-data-subjects-ajax" name="subject[]" multiple="multiple">


                                            </select>

                                        </div>

                                    </div>
                                    <div class="row justify-content-between text-start">
                                        <div class="form-group col-sm-5 flex-column d-flex">
                                            <label class="form-control-label px-3">Khu vực bạn đang ở<span class="text-danger"> *</span></label>
                                            <div id="provinces" class=""></div>
                                        </div>
                                        <div class="form-group col-sm-7 flex-column d-flex">
                                            <label class="form-control-label px-3">Khu vực bạn có thể dạy<span class="text-danger"> *</span></label>
                                            <select class="form-select js-data-districts-ajax" name="districts[]">


                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between text-start">
                                        <div class="form-group col-sm-8 flex-column d-flex">
                                            <label class="form-control-label px-3">Trường bạn đã học<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="collage" name="collage" placeholder="Tên trường học" value="">
                                        </div>
                                        <div class="form-group col-sm-4 flex-column d-flex">
                                            <label class="form-control-label px-3">Năm tốt nghiệp<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="graduate-year" name="graduate-year" placeholder="Năm tốt nghiệp" value="">
                                        </div>
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Hình thức dạy<span class="text-danger"> *</span></label>
                                            <select class="form-select js-data-teaching-form-ajax" name="teaching-form[]">


                                            </select>
                                        </div>

                                        <div class="row justify-content-between text-start">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3">Facebook của bản (link)<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="face" name="face" placeholder="https://www.facebook.com/nguyenvana.203" value="">

                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3">Twitter của bạn (link)<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="text" id="twit" name="twit" placeholder="https://twitter.com/nguyenvana" value="">

                                        </div>
                                    </div>

                                        <div class="form-group col-12 flex-column d-flex">
                                            <span class="input-group-text">Mô tả bản thân</span>
                                            <div id="toolbar-container"></div>
                                            <div id="editor">
                                                <p>Viết ở đây.</p>
                                            </div>
                                        </div>

                                    </div>

                                    
                                    <!-- lịch đăng kí dạy kèm   -->
                                    <div class="row justify-content-between text-start">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="header-title pb-2 border-bottom">Thời gian có thể nhận lớp</h5>
                                                <div class="row-g-0">
                                                    <div class="form-group col-sm-12 flex-col d-flex">
                                                        <div class="col-12 col-sm-12 col-md-12">
                                                            <?php
                                                            $dow_list = $dayofweeks->getAll();
                                                            while ($resultDOW = $dow_list->fetch_assoc()) {


                                                            ?>
                                                                <div class="" id="<?= $resultDOW["id"] ?>">
                                                                    <b><?= $resultDOW["day"] ?></b>
                                                                    <div class="d-flex my-2">
                                                                        <?php
                                                                        $time_list = $_times->getAll();
                                                                        while ($resultTimes = $time_list->fetch_assoc()) {

                                                                        ?>

                                                                            <div class="form-check me-2">
                                                                                <input class="form-check-input" type="checkbox" id="<?= $resultDOW["id"] . $resultTimes["id"] ?>" value="<?= $resultTimes["id"] ?>" />
                                                                                <label class="form-check-label" style="font-size: 15px" for="<?= $resultDOW["id"] . $resultTimes["id"] ?>">
                                                                                    <?= $resultTimes["time"] ?>
                                                                                </label>
                                                                            </div>

                                                                        <?php

                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                            <?php
                                                            } ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div>

                                        </div>
                                        <div id="layoutSubmit" class="form-group col-sm-6">
                                            <button id="submit-register" type="submit" class="btn btn-secondary">Gửi yêu cầu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>

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

                $("#register-form").on('submit', (e) => {

                    e.preventDefault();

                    // 
                    let currentPhone = $("#current-phone-number").val();
                    let currentEmail = $("#current-email").val();
                    let currentAddress = $("#current-address").val();
                    let currentJob = $("#job").val();
                    let currentProvince = $("#province").text();
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
                        url: "../api/tutor_register",
                        data: {
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
                            }
                            else if(data.insert === 'fail'){
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
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr, error, status, "Lỗi");
                        }
                    });

                });

            });

        })();
    </script>
</body>

</html>