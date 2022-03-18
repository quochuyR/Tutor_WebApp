<?php
namespace Inc;
use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\Notification;

$filepath  = realpath(dirname(__FILE__));


include_once($filepath . "../../lib/session.php");
include_once($filepath . "../../classes/adminlogin.php");
include_once($filepath . "../../classes/notifications.php");

include_once($filepath . "../../helpers/utilities.php");
Session::init();
?>

<?php
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
?>


<?php
$notification = new Notification();



if (isset($_POST["action"]) && $_POST["action"] === "logout") {
    if (session_id() !== '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
        // session isn't started
        Session::destroy();
        exit;
    }
}
?>
<section class="p-0" id="header">

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
        <div class="container h-100">
            <a class="me-4" href="/"><img src="https://www.bootdey.com/img/Content/avatar/avatar7.png" class="avatar-md rounded-circle" alt="Logo"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation" aria-haspopup="true">
                <span class="fa-solid fa-bars fa-2xl"></span>
            </button>




            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item <?php //$nav_intro_active 
                                        ?>"><a href="#" class="nav-link">Giới thiệu</a></li>
                    <li class="nav-item dropdown <?php if (isset($nav_tutor_active)) echo $nav_tutor_active;
                                                    else echo ""  ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tìm gia sư</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Page 1</a>
                            <a class="dropdown-item" href="#">Page 2</a>
                            <a class="dropdown-item" href="#">Page 3</a>
                            <a class="dropdown-item" href="list_Tutor.php">Danh sách gia sư</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Môn học</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Bài viết</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Liên hệ</a></li>

                </ul>

                <div class="d-flex justify-content-center align-items-center">
                    <div class=" <?= !empty($_SESSION) ? "d-flex justify-content-center align-items-center" : "d-none"  ?>" id="login">
                        <div class="dropdown-notification">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell fa-lg position-relative">
                                    <span class="position-absolute top-0 start-100 translate-middle  p-2 bg-danger border border-light rounded-circle">

                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                </i>
                            </button>
                            <div class="dropdown-menu  py-0" aria-labelledby="dropdownMenuButton">
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

                    <!--  -->

                    <div class=" <?= !empty($_SESSION) ? "d-flex justify-content-center align-items-center" : "d-none"  ?>" id="login">
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="">
                                <img src="<?= !empty(Session::get("imagepath")) ? (Util::getCurrentURL() . "/../" . Session::get("imagepath")) : "https://bootdey.com/img/Content/avatar/avatar5.png" ?>" class="avatar-md rounded-circle" alt="Hình avatar">
                            </span>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">
                                <i class="far fa-calendar-alt"></i>
                                <span class="ms-2">Quản lí lịch dạy</span>
                            </a>

                            <a class="dropdown-item" href="<?= Format::validation("./saved_tutors.php?limit=3&page=1") ?>">
                                <i class="fas fa-heart text-danger"></i>
                                <span class="ms-2">Gia sư đã lưu</span>
                            </a>


                            <a class="dropdown-item logout" href-action="logout">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="ms-2">Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                    <span class="font-weight-600 ">
                        <?= Session::get("firstname") . ' ' . Session::get("lastname") ?>
                    </span>

                </div>


                <div class="<?= empty($_SESSION) ?  "d-block" : "d-none"   ?>" id="signup-signin">
                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="cursor: pointer">
                        Đăng nhập/Đăng kí
                    </span>

                </div>
                <!-- Button trigger modal -->
                </div>


                







            </div>

    </nav>
    <!-- END nav -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <section class="ftco-section">

                    <div class="row justify-content-center">
                        <div class="col-md-11 col-lg-10">
                            <div class="wrap">

                                <div class="login-wrap p-4">
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <h3 class="mb-4">Đăng nhập</h3>
                                        </div>
                                        <div class="w-100">
                                            <p class="social-media d-flex justify-content-end ">
                                                <a href="#" class="social-icon d-flex align-items-center justify-content-center text-decoration-none"><span class="fa fa-facebook"></span></a>

                                                <a href="#" class="social-icon d-flex align-items-center justify-content-center text-decoration-none"><span class="fa fa-google"></span></a>
                                                <a href="#" class="social-icon d-flex align-items-center justify-content-center text-decoration-none"><span class="fa fa-twitter"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <form class="signin-form">
                                        <div class="form-group mt-3">
                                            <input id="username-field" type="text" name="username" class="form-control" required>
                                            <label class="form-control-placeholder" for="username">Tài khoản</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="password-field" type="password" name="password" class="form-control" required>
                                            <label class="form-control-placeholder" for="password">Mật khẩu</label>
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6Lfw6MkeAAAAADmRhvf__Nri7XkH3dVGsR9v64lM"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Đăng
                                                nhập</button>
                                        </div>
                                        <div class="form-group d-md-flex">
                                            <div class="w-50 text-left">
                                                <label class="checkbox-wrap checkbox-primary mb-0">Nhớ đăng nhập
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark-sign"></span>
                                                </label>
                                            </div>
                                            <div class="w-50 text-end">
                                                <a href="#">Quên mật khẩu</a>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="text-center">Chưa có tài khoản? <a data-toggle="tab" href="#">Đăng kí</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>

</section>