<?php

use Classes\DayOfWeek, Classes\Time, Classes\Tutor, Library\Session;

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


$dayofweeks = new DayOfWeek();
$_times = new Time();
$_tutor = new Tutor();
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
                        <h3 class="fw-bold mb-5">Đăng kí dạy kèm</h3>

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

                            <!-- Thông tin bằng tốt nghiệp   -->

                            <div class="card">
                                <div class="card-body">

                                    <div class="row justify-content-between text-start">
                                        <h5 class="header-title fw-bold pb-2 mb-3 border-bottom">Bằng cấp gia sư</h5>
                                        <div class="row g-0">

                                            <div class="form-group col-sm-12">
                                                <div class="mb-3 px-sm-3">

                                                    <label for="certificate" class="form-label">Ảnh bằng cấp</label>

                                                    <div id="certificate" name="certificate" class="dropzone" enctype="multipart/form-data">
                                                    </div>
                                                    <input type="hidden" id="certificate_dropzone" name="certificate_dropzone" />

                                                </div>
                                                <?php

                                                // Mục đích là khi đăng ký trở thành gia sư rồi sẽ không hiển thị button xác nhận nữa
                                                $registered_as_tutor = $_tutor->getTutorIdByUserId(Session::get("userId"))->fetch_row();
                                                if (!isset($registered_as_tutor)) :

                                                ?>
                                                    <div class="mb-3 px-sm-3 text-end">
                                                        <button type="submit" class="btn btn-register" id="upload-certificate">Xác nhận</button>
                                                    </div>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- lịch đăng kí dạy kèm   -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-between text-start">
                                        <h5 class="header-title fw-bold pb-2 mb-3 border-bottom">Thời gian có thể nhận lớp</h5>
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
   
</script>
<?php include '../inc/footer.php' ?>