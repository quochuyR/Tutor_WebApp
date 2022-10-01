<?php

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\Notification, Classes\Remember;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__, 2));


// include_once($filepath . "../../lib/session.php");
Session::init();
// include_once($filepath . "../../classes/adminlogin.php");
// include_once($filepath . "../../classes/notifications.php");

// include_once($filepath . "../../helpers/utilities.php");
// include_once($filepath . "../../classes/remember.php");


$remember = new Remember();

header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)

if (isset($_POST["action"]) && $_POST["action"] === "logout") {
    if (session_id() !== '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
        // session isn't started


        $remember->delete_user_token(Session::get('userId'));

        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_me', "", time() - 3600, "/", "localhost");
        }
        Session::destroy();
        exit;
    }
}

$notification = new Notification();

?>
<!DOCTYPE html>
<html class="no-js" lang="vi">
<?php
include_once __DIR__ . "../head.php";
?>
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="https://www.bootdey.com/img/Content/avatar/avatar7.png" class="avatar-md" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">


                <div class="dropdown dropdown-notification">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonNoti" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell fa-lg position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle  p-2 bg-danger border border-light rounded-circle">

                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </i>
                    </button>
                    <div class="dropdown-menu w-350 dropdown-menu-start " aria-labelledby="dropdownMenuButtonNoti">
                        <div class="card border-0 mb-0">
                            <h5 class="card-header text-info">Thông báo</h5>
                            <div class="card-body p-0 px-2 overflow-y-scroll" style="max-height:40vh">
                                <div class="list-group">

                                    <?php
                                    if (Session::checkLogin()) {
                                        $fetch_notification = $notification->getNotificationByUserId(Session::get("userId"));

                                        while ($notifi = $fetch_notification->fetch_assoc()) {
                                            $sender = $notification->getUserBySenderId($notifi["SenderId"])->fetch_assoc();

                                    ?>
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <img src="../public/<?= $sender["imagepath"] ?>" class="avatar-notification avatar-sm-notification  ">
                                                </div>
                                                <div class="">
                                                    <a href="#" class="list-group-item list-group-item-action border-0 text-small">
                                                        <b><?= $sender["firstname"] ?></b> <?= $notifi["notification_text"] ?>

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

            <div class="user-area dropstart float-right">
                <button class="btn dropdown-toggle" id="dropdownMenuAccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="<?= !empty(Session::get("imagepath")) ? (Util::getCurrentURL(2) . "public/" . Session::get("imagepath")) : "https://bootdey.com/img/Content/avatar/avatar5.png" ?>" alt="User Avatar">
                </button>

                <div class="user-menu dropdown-menu dropdown-menu-account " aria-labelledby="dropdownMenuAccount">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i>Thông tin cá nhân</a>

                    <a class="nav-link" href="#"><i class="fa fa-cog"></i>Cài đặt</a>

                    <a class="nav-link logout" href-action="logout"><i class="fa fa-power-off " ></i>Đăng xuất</a>
                </div>
            </div>

        </div>
    </div>
</header>