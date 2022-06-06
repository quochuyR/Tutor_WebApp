<?php

namespace Views;

use Classes\AppUser, Library\Session, Helpers\Util;
use Helpers\Format;

include_once "../classes/appusers.php";
include_once "../lib/session.php";
include_once "../helpers/format.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);


$_user = new AppUser();
if (isset($_POST['introduction']) != '') {
    $Content = strip_tags(stripslashes($_POST['introduction']));
} else {

    $Content = "";
}
$selector = " SELECT * FROM  tutors INNER JOIN appusers ON appusers.id = tutors.userId WHERE tutors.userId = " . Session::get('userId');
?>
<?php
$title = "Danh sách gia sư";
$nav_tutor_active = "active";
include "../inc/header.php";
?>
<div id="main" class="container pb-3">

    <form method="POST" action class="mt-3">

        <div class="row">
            <?php
            //   print_r($_POST);
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST) && !empty($_POST)) {
                    if ((isset($_POST["email"]) && !empty($_POST["email"]))
                        && (isset($_POST["lastname"]) && !empty($_POST["lastname"]))
                        && (isset($_POST["firstname"]) && !empty($_POST["firstname"]))
                        && (isset($_POST["phonenumber"]) && !empty($_POST["phonenumber"]))
                        && (isset($_POST["gioitinh"]) && is_numeric($_POST["gioitinh"]))
                        && (isset($_POST["address"]) && !empty($_POST["address"]))
                        && (isset($_POST["job"]) && !empty($_POST["job"]))
                        && (isset($_POST["dateofbirth"]) && !empty($_POST["dateofbirth"]))
                    ) {
                        // print_r($_POST); 

                        $email = Format::validation($_POST["email"]);
                        $last_name = Format::validation($_POST["lastname"]);
                        $first_name = Format::validation($_POST["firstname"]);
                        $sex = Format::validation($_POST["gioitinh"]);
                        $phonenumber = Format::validation($_POST["phonenumber"]);
                        $date_of_birth = Format::validation($_POST["dateofbirth"]);
                        $address = Format::validation($_POST["address"]);
                        $job = Format::validation($_POST["job"]);

                        $get_info_user = $_user->update_user(Session::get("userId"), $email, $last_name, $first_name,  $sex, $phonenumber, $date_of_birth, $address, $job);

                        if ($get_info_user) {
                        }
                    }
                }
            }


            $get_info_user = $_user->getInfoByUserId(Session::get("userId"));
            if ($get_info_user) :

                while ($person = $get_info_user->fetch_assoc()) :

            ?>
                    <div class="col-3 text-center">
                        <div class="card h-100">
                            <div class="card-body">
                                <img src="<?= Util::getCurrentURL(1) . "/../public/" . $person["imagepath"]; ?>" class="rounded-circle avatar-lg" alt="hình đại diện" value="<?php echo $person['imagepath'] ?>">
                                <div class="mt-3">
                                    <h4 class="fw-bold"><?php echo $person['lastname'] . " " . $person['firstname'] ?></h4>
                                    <h6 class="text-muted"><?php echo "<b> ID: </b>" . $person['username'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label for="username" class="form-label">Họ </label>
                                        <input type="text" class="text-muted form-control" name="lastname" id="lastname" placeholder="Họ" value="<?php echo $person['lastname']  ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="username" class="form-label">Tên</label>
                                        <input type="text" class="text-muted form-control" name="firstname" id="firstname" placeholder="Tên" value="<?php echo $person['firstname'] ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="text-muted form-control" name="phonenumber" id="phonenumber" placeholder="số điện thoại" value="<?php echo $person['phonenumber'] ?>">
                                    </div>
                                    <div class="col-5 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="text-muted form-control" id="email" name="email" placeholder="Email" value="<?php echo $person['email'] ?>">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label for="dateofbirth" class="form-label">Ngày sinh</label>
                                        <input type="date" class="text-muted form-control" id="dateofbirth" name="dateofbirth" placeholder="dateofbirth" value="<?php echo $person['dateofbirth'] ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <!-- <div class="form-group flex-column d-flex"> -->
                                        <label class="form-control-label">Nghề nghiệp</span></label>
                                        <select class="form-select" name="job" id="job">
                                        <?php
                                                $option = array("Sinh viên", "Giáo viên", "Chuyên gia", "Người đi làm", "Người nước ngoài");
                                                foreach ($option as $value) :
                                                ?>
                                                    <option value="<?= $value ?>" <?= $person['job'] == $value ? "selected" :"" ?>><?= $value ?></option>
                                                <?php endforeach; ?>

                                        </select>
                                        <!-- </div> -->

                                    </div>



                                    <div class="col-10 mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="text-muted form-control" id="address" name="address" placeholder="Địa chỉ" value="<?php echo $person['address'] ?>">
                                    </div>
                                    <div class="col-2 mb-3">
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
                            </div>

                        </div>

                <?php endwhile;
            endif; ?>
                    </div>


        </div>
    </form>
</div>
<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>