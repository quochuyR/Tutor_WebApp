<?php

namespace Views;

use Classes\AppUser,
    Classes\DayOfWeek,
    Classes\Time,
    Classes\Tutor,
    Classes\TeachingTime;
use Library\Session, Helpers\Util, Helpers\UploadFile;
use Helpers\Format;

require_once(__DIR__ . "../../vendor/autoload.php");

// include_once "../classes/appusers.php";
// include_once "../lib/session.php";
// include_once "../helpers/format.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);


$_user = new AppUser();
$dayofweeks = new DayOfWeek();
$_times = new Time();
$_tutor = new Tutor();
$_teachingtime = new TeachingTime();
// upload avatar user
$upload_image = UploadFile::upload("file", "../public/images/");
// 0 => 'images', 1 => image file name
$explode_path = explode("/",  Session::get("imagepath"));
if ($upload_image && $upload_image["uploaded"] == 1) {
    // update lại đường dẫn
    $update_new_image = $_user->update_image_user(Session::get("userId"), "images/" . $upload_image["fileName"][0]);
    if ($update_new_image) {
        // đường dẫn hình ảnh củ
        $path_del = __DIR__ . "../../public/images/$explode_path[1]";
        if (file_exists($path_del)) {
            // xoá hình củ
            unlink(__DIR__ . "../../public/images/$explode_path[1]");
            // set session lại hình mới upload
            Session::set("imagepath", "images/" . $upload_image["fileName"][0]);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["action" => "success", "fileName" =>  $upload_image["fileName"][0]]);
            exit();
        }
    }
}


$title = "Cài đặt tài khoản";
// $nav_tutor_active = "active";
include "../inc/header.php";
?>
<div id="main" class="container pb-3">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>

    </svg>
    <!-- <form action="profile" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="file" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form> -->




    <div class="row">

        <?php
        $message = "";
        //   print_r($_POST);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST) && !empty($_POST) && isset($_POST["update-profile"])) {

                // print_r($_POST); 

                $email = (isset($_POST["email"]) && !empty($_POST["email"])) ? Format::validation($_POST["email"]) : NULL;
                $last_name = (isset($_POST["lastname"]) && !empty($_POST["lastname"])) ? Format::validation($_POST["lastname"]) : NULL;
                $first_name = (isset($_POST["firstname"]) && !empty($_POST["firstname"])) ? Format::validation($_POST["firstname"]) : NULL;
                $sex = (isset($_POST["gioitinh"]) && is_numeric($_POST["gioitinh"])) ? Format::validation($_POST["gioitinh"]) : NULL;
                $phonenumber = (isset($_POST["phonenumber"]) && !empty($_POST["phonenumber"])) ? Format::validation($_POST["phonenumber"]) : NULL;
                $date_of_birth = (isset($_POST["dateofbirth"]) && !empty($_POST["dateofbirth"])) ? Format::validation($_POST["dateofbirth"]) : NULL;
                $address = (isset($_POST["address"]) && !empty($_POST["address"])) ? Format::validation($_POST["address"]) : NULL;
                $job = (isset($_POST["job"]) && !empty($_POST["job"])) ? Format::validation($_POST["job"]) : NULL;


                $get_info_user = $_user->update_user(Session::get("userId"), $email, $last_name, $first_name,  $sex, $phonenumber, $date_of_birth, $address, $job);

                if ($get_info_user) {
                    $message = ' <div class="col-12"> 
                                            <div class="alert alert-success  d-flex align-items-center text-start" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>Cập nhật dữ liệu thành công.</div>
                        </div></div>';
                }
            }
        }


        $get_info_user = $_user->getInfoByUserId(Session::get("userId"));
        if ($get_info_user) :

            while ($person = $get_info_user->fetch_assoc()) :
                // print_r($person);

        ?>
                <div class="col-12 col-sm-3 mb-3 mb-sm-0 text-center mt-2">

                    <div class="card" style="position: sticky;top:1rem">
                        <div class="card-body">
                            <div class="position-absolute end-5 bottom-0 translate-middle-y">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-tutor-detail" data-bs-toggle="modal" data-bs-target="#change-picture">
                                    Đổi ảnh
                                </button>
                            </div>


                            <img src="<?= isset($person["imagepath"]) ? Util::getCurrentURL(1) . "public/" . $person["imagepath"] : Util::getCurrentURL(1) . "public/images/avatar5-default.jpg"; ?>" class="rounded avatar-lg avatar" alt="hình đại diện" value="<?php echo $person['imagepath'] ?>" id="my-image">
                            <div class="mt-3 h-50 d-flex flex-column pb-5">

                                <h4 class="fw-bold mb-1"><?php echo $person['lastname'] . " " . $person['firstname'] ?></h4>
                                <h6 class="text-muted"><?php echo "<b> ID: </b>" . $person['username'] ?></h6>
                                <input type="hidden" name="" value="<?= Session::get('tutorId') ?>" id="tuid">

                                <button type="button" class="d-block m-auto pt-3" data-bs-toggle="modal" data-bs-target="#QRModal">
                                    <div class="card w-fit-content bg-gray-600" style="cursor:pointer;" id="my-qr-code">
                                        <div class="card-body p-2">
                                            <span class="material-symbols-rounded font-64 text-white d-flex m-auto">
                                                qr_code_2
                                            </span>
                                        </div>
                                    </div>
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-9">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="col-6 col-sm-3 rounded text-center fw-bold position-absolute top-0 start-5 translate-y-middle p-2 bg-body shadow-sm">
                                Thông tin cá nhân
                            </div>
                            <form method="POST" action class="mt-3">

                                <div class="row pt-3">


                                    <?= isset($message) ? $message : "" ?>
                                    <input type="hidden" name="update-profile">
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="username" class="form-label">Họ </label>
                                        <input type="text" class="text-muted form-control" name="lastname" id="lastname" placeholder="Họ" value="<?php echo $person['lastname']  ?>">
                                    </div>
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="username" class="form-label">Tên</label>
                                        <input type="text" class="text-muted form-control" name="firstname" id="firstname" placeholder="Tên" value="<?php echo $person['firstname'] ?>">
                                    </div>
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="text-muted form-control" name="phonenumber" id="phonenumber" placeholder="số điện thoại" value="<?php echo $person['phonenumber'] ?>">
                                    </div>
                                    <div class="col-6 col-sm-5 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="text-muted form-control" id="email" name="email" placeholder="Email" value="<?php echo $person['email'] ?>">
                                    </div>

                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="dateofbirth" class="form-label">Ngày sinh</label>
                                        <input type="date" class="text-muted form-control" id="dateofbirth" name="dateofbirth" placeholder="dateofbirth" value="<?= isset($person['dateofbirth']) ? $person['dateofbirth'] : ""; ?>">
                                    </div>
                                    <div class="col-6 col-sm-3 mb-3">
                                        <!-- <div class="form-group flex-column d-flex"> -->
                                        <label class="form-control-label">Nghề nghiệp</span></label>
                                        <select class="form-select" name="job" id="job">
                                            <?php
                                            $option = array("-- Không xác định --", "Sinh viên", "Giáo viên", "Chuyên gia", "Người đi làm", "Người nước ngoài");
                                            foreach ($option as $value) :
                                            ?>
                                                <option value="<?= $value ?>" <?= $person['job'] == $value ? "selected" : "" ?>><?= $value ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <!-- </div> -->

                                    </div>



                                    <div class="col-12 col-sm-10 mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="text-muted form-control" id="address" name="address" placeholder="Hãy cập nhật địa chỉ." value="<?= isset($person['address']) ? $person['address'] : ""; ?>">
                                    </div>
                                    <div class="col-6 col-sm-2 mb-3">
                                        <div class="input-group">
                                            <label class="form-check-label" for="radio-nam">Giới tính</label>
                                        </div>
                                        <div class=" d-flex flex-column">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gioitinh" id="radio-nam" value="1" <?php if ($person['sex'] == 1) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                                <label class="form-check-label" for="radio-nam">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input " type="radio" name="gioitinh" id="radio-nu" value="0" <?php if ($person['sex'] == 0) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                                <label class="form-check-label" for="radio-nu">Nữ</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-12 ">

                                            <textarea id="textarea" placeholder="Giới thiệu bản thân" name="introduction" id="introduction" <?php echo $Content ?>></textarea>
                                        </div>
                                    </div> -->


                                    <div class="col-12 text-end mt-3">

                                        <!-- link tại trang mặt định lấy giá trị $_GET  -->
                                        <button type="submit" class="btn btn-tutor-detail" name="submit">Cập nhật</button>
                                        <!-- link qua trang đăng kí làm gia sư -->
                                        <!-- <a href="http://localhost/Tutor_WebApp/pages/tutor_registration_form" class="btn btn-primary " name="dangki">Đăng kí làm gia sư</a> -->
                                    </div>


                                </div>
                            </form>

                        </div>

                    </div>



            <?php endwhile;
        endif; ?>
            <div class="card py-3 mt-5">
                <div class="card-body">
                    <div class="col-6 col-sm-3 rounded text-center fw-bold position-absolute top-0 start-5 translate-y-middle p-2 bg-body shadow-sm">
                        Thông tin gia sư
                    </div>

                    <form class="form-card" id="tutor-form-update">
                        <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />
                        <?php

                        $get_info_tutor = $_tutor->get_tutor_detail_for_update(Session::get("tutorId"));
                        if ($get_info_tutor) :
                            while ($info_tutor = $get_info_tutor->fetch_assoc()) :
                        ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between text-start">
                                            <h6 class="text-start fw-bold mb-4 border-bottom pt-2 pb-2">Thông tin liên lạc</h6>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label ">Số điện thoại<span class="text-danger"> *</span></label>
                                                <input class="form-control" type="text" id="current-phone-number" name="current-phone-number" placeholder="Nhập số điện thoại" value="<?= $info_tutor["currentphonenumber"]; ?>">
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label ">Địa chỉ email<span class="text-danger"> *</span></label>
                                                <input class="form-control" type="text" id="current-email" name="current-email" placeholder="Địa chỉ email" value="<?= $info_tutor["currentemail"]; ?>">
                                            </div>

                                            <div class="form-group col-sm-12 flex-column d-flex">
                                                <label class="form-control-label ">Địa chỉ<span class="text-danger"> *</span></label>
                                                <input class="form-control" type="text" id="current-address" name="current-address" placeholder="Địa chỉ ở hiện tại" value="<?= $info_tutor["currentaddress"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-start fw-bold md-4 border-bottom pb-2 pt-2">Thông tin gia sư</h6>
                                        <div class="row justify-content-between text-start pt-3">



                                            <div class="form-group col-sm-4 flex-column d-flex">
                                                <label class="form-control-label ">Khu vực bạn đang ở<span class="text-danger"> *</span></label>
                                                <div id="provinces-update" class="" data-name="<?= $info_tutor["currentplace"]; ?>"></div>
                                            </div>
                                            <div class="form-group col-sm-8 flex-column d-flex">
                                                <label class="form-control-label ">Khu vực bạn có thể dạy<span class="text-danger"> *</span></label>
                                                <select class="form-select js-data-districts-ajax-update" name="districts[]" data-district-name="<?= $info_tutor["teachingarea"]; ?>">


                                                </select>
                                            </div>



                                            <div class="form-group col-sm-12 flex-column d-flex">
                                                <label class="form-control-label ">Hình thức dạy<span class="text-danger"> *</span></label>
                                                <select class="form-select js-data-teaching-form-ajax-update select2bs5" id="teaching-form" name="teaching-form[]" data-teaching-form="<?= $info_tutor["teachingform"]; ?>">


                                                </select>
                                            </div>


                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Facebook của bạn (link)</label>
                                                <input class="form-control" type="text" id="face" name="face" placeholder="https://www.facebook.com/nguyenvana.203" value="<?= $info_tutor["linkfacebook"]; ?>">

                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Twitter của bạn (link)</label>
                                                <input class="form-control" type="text" id="twit" name="twit" placeholder="https://twitter.com/nguyenvana" value="<?= $info_tutor["linktwitter"]; ?>">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- lịch đăng kí dạy kèm   -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between text-start">
                                            <h6 class="header-title fw-bold pb-2 mb-3 border-bottom">Thời gian có thể nhận lớp</h6>
                                            <div class="row g-0">
                                                <div class="form-group col-sm-12">

                                                    <?php
                                                    $dow_list = $dayofweeks->getAll();
                                                    while ($resultDOW = $dow_list->fetch_assoc()) {


                                                    ?>
                                                        <div class="px-sm-3" id="<?= $resultDOW["id"] ?>">
                                                            <b> <?= $resultDOW["day"] ?> </b>
                                                            <div class="row g-0 my-2 justify-content-center d-flex justify-content-around">
                                                                <?php
                                                                $time_list = $_teachingtime->get_for_update(Session::get("tutorId"), $resultDOW["id"]);
                                                                while ($resultTimes = $time_list->fetch_assoc()) {

                                                                ?>

                                                                    <div class="form-check me-2 col-3 col-sm-3 col-lg-auto " data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $resultTimes["time"] ?>">
                                                                        <input class="form-check-input" type="checkbox" id="<?= $resultDOW["id"] . $resultTimes["id"] ?>" name="teaching_time[]" value="<?= $resultTimes["id"] ?>" data-day-id="<?= $resultDOW["id"] ?>" <?= isset($resultTimes["status"]) ? "checked" : "" ?> <?= isset($resultTimes["status"]) && $resultTimes["status"] == 1  ? "disabled" : "" ?> />
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
                                                                    <span id="<?= $resultDOW["id"] . $resultTimes["id"] ?>">
                                                                        <b><?= "Tiết " . $resultTimes["id"] ?>: </b>
                                                                        <span class="ps-2 fw-regular"><?= $resultTimes["time"] ?>
                                                                        </span>
                                                                    </span>

                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div id="layoutSubmit" class="form-group col-sm-2">
                                        <button id="submit-update_tutor" type="submit" class="btn btn-register">Lưu cập nhật</button>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
                    </form>

                </div>
            </div>
                </div>




    </div>



    <!-- Modal QR -->
    <div class="modal fade" id="QRModal" tabindex="-1" aria-labelledby="QRModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QRModalLabel">QR code của tôi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            <div id="canvas"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-tutor-detail" id="download">Tải về</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal update image -->
    <div class="modal fade" id="change-picture" tabindex="-1" aria-labelledby="change-pictureLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-pictureLabel">Thay đổi ảnh đại diện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <div id="demo-basic"></div>
                                </div>

                                <div class="col-12">
                                    <div action="profile" class="dropzone" id="profile" enctype="multipart/form-data"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" class="btn btn-tutor-detail" id="save-change-picture">Lưu lại</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php


include "../inc/script.php"
?>
<script type="text/javascript">
    (function() {
        $(window).on("load", function() {
            if(localStorage.getItem("scrollpos")){
                $("html,body").animate({
                    scrollTop: localStorage.getItem("scrollpos")
                },
                "slow");

                localStorage.setItem("scrollpos", 0)
            }
            

        });
    })();
</script>
<?php include '../inc/footer.php' ?>