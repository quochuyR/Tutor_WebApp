<?php

namespace Ajax;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\AdminLogin, Classes\Notification;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/session.php");
Session::init();
include_once($filepath . "../../classes/adminlogin.php");

include_once($filepath . "../../helpers/utilities.php");
include_once($filepath . "../../helpers/format.php");
include_once($filepath . "../../classes/notifications.php");


$captcha = '';
// handling the captcha and checking if it's ok
$secret = '6Lfw6MkeAAAAAIS-qyaNIm281C8imMz6h1ThadJT';
$login = new AdminLogin();
$notification = new Notification();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        // echo 'captcha: '.$captcha;
    }

    if (!$captcha) {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'CAPTCHA CHƯA ĐƯỢC CHECKED', 'code' => 1011))); // 1011 : ERROR_CAPTCHA_NOT_BEEN_CHECKED
    }

    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

    // var_dump($response);

    // if the captcha is cleared with google, send the mail and echo ok.
    if ($response['success'] != false) {
        // send the actual mail
        // @mail($email_to, $subject, $finalMsg);

        // the echo goes back to the ajax, so the user can know if everything is ok
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $login_check = $login->login_admin($username, $password);

            if ($login_check) {

?>
                <div class=" <?= !empty($_SESSION) ? "d-flex justify-content-center align-items-center" : "d-none"  ?>" id="login">
                    <div class="dropdown-notification">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-bell fa-lg position-relative">
                                <span class="position-absolute top-0 start-100 translate-middle  p-2 bg-danger border border-light rounded-circle">

                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </i>
                        </button>
                        <div class="dropdown-menu w-350  py-0" aria-labelledby="dropdownMenuButton">
                            <div class="card border-0 mb-0">
                                <h5 class="card-header text-info">Thông báo</h5>
                                <div class="card-body p-0 px-2">
                                    <div class="list-group">

                                        <?php
                                        if (Session::checkLogin()) {
                                            $fetch_notification = $notification->getNotificationByUserId(Session::get("userId"));
                                            while ($notifi = $fetch_notification->fetch_assoc()) {
                                                $sender = $notification->getUserBySenderId($notifi["SenderId"])->fetch_assoc();
                                        ?>
                                                <div class="d-flex">
                                                    <div class="my-auto">
                                                        <img src="../<?= $sender["imagepath"] ?>" class="avatar-notification avatar-sm-notification  ">
                                                    </div>
                                                    <div class="">
                                                        <a href="#" class="list-group-item list-group-item-action border-0 text-small">
                                                            <?= $notifi["notification_text"] ?>

                                                        </a>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </div>

                                </div>
                                <div class="card-footer text-muted p-0 border-0">
                                    <a href="#" class="list-group-item border-0 list-group-item-action  py-3 text-center">
                                        <b>Xem thêm</b>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <div class=" <?= !empty($_SESSION) ? "d-flex justify-content-center align-items-center" : "d-none"  ?>" id="login">
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="">
                                <img src="<?= !empty(Session::get("imagepath")) ? (Util::getCurrentURL() . "/../public/"  . Session::get("imagepath")) : "https://bootdey.com/img/Content/avatar/avatar5.png" ?>" class="avatar-md rounded-circle" alt="Hình avatar">
                            </span>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if (Session::checkRoles(["tutor"])) { ?>
                                <a class="dropdown-item py-1" href="../pages/registered_users.php">

                                    <i class="fa-solid fa-user-pen fa-lg w-20"></i>

                                    <span class=" w-80">Người dùng đăng ký</span>
                                </a>

                                <a class="dropdown-item   py-1" href="../pages/schedule_tutors.php">
                                    <i class="far fa-calendar-alt fa-lg w-20"></i>
                                    <span class=" w-80">Quản lí lịch dạy</span>
                                </a>
                            <?php } ?>

                            <?php if (Session::checkRoles(["user"])) { ?>
                                    <a class="dropdown-item py-1" href="../pages/registered_tutors">

                                        <i class="fa-solid fa-user-pen fa-lg w-20"></i>

                                        <span class=" w-80">Gia sư đã đăng ký</span>
                                    </a>

                                    <a class="dropdown-item   py-1" href="../pages/schedule_user">
                                        <i class="far fa-calendar-alt fa-lg w-20"></i>
                                        <span class=" w-80">Lịch học của bạn</span>
                                    </a>
                                <?php } ?>

                            <a class="dropdown-item   py-1" href="<?= Format::validation("./saved_tutors.php?limit=3&page=1") ?>">
                                <i class="fas fa-heart text-danger fa-lg w-20"></i>
                                <span class=" w-80">Gia sư đã lưu</span>
                            </a>


                            <a class="dropdown-item  logout py-1" href-action="logout">
                                <i class="fa-solid fa-right-from-bracket fa-lg w-20 "></i>
                                <span class=" w-80">Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                    <span class="font-weight-600 ">
                        <?= Session::get("firstname") . ' ' . Session::get("lastname") ?>
                    </span>

                </div>


<?php

            }
        }
    } else {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'CAPTCHA PHẢN HỒI THẤT BẠI', 'code' => 1012))); // 1012 : ERROR_CAPTCHA_FAIL
    }
}




?>