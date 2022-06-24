<?php

namespace Inc;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\Notification, Classes\AdminLogin, Classes\Remember;

require_once(__DIR__ . "../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));


// include_once($filepath . "../../lib/session.php");
// // include_once($filepath . "../../classes/adminlogin.php");
// include_once($filepath . "../../classes/notifications.php");
// include_once($filepath . "../../classes/remember.php");

// include_once($filepath . "../../helpers/utilities.php");
// include_once($filepath . "../../classes/adminlogin.php");

Session::init();

header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);

$notification = new Notification();
$login = new AdminLogin();

$remember = new Remember();
// setcookie('remember_me', "576c3ff6bc6b6877a949704950a7225e:6085f24874c4f58985a1baeb52c261ab178b36c11191c2fdae845ea2c3299225", time() + 60 *60*24 *30);
// echo password_hash("123", PASSWORD_DEFAULT);

$token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_UNSAFE_RAW);

if ($token && $remember->token_is_valid($token)) {
    $user = $remember->find_user_by_token($token);
    if ($user) {
        $login_with_token =  $login->is_user_logged_in($user);
    }
}
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
?>
<!DOCTYPE html>
<html lang="vi">

<?php

include "../inc/head.php";



?>

<body>

    <div class="container-fluid px-0" id="main-container">
        <header class="row g-0 m-0">

            <section class="p-0 d-flex   align-items-center" id="top-header">
                <div class="container-lg d-flex  justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation" aria-haspopup="true">
                            <span class="material-symbols-rounded">
                                view_headline
                            </span>
                        </button>
                        <a class="ms-4" href="/"><img src="https://www.bootdey.com/img/Content/avatar/avatar7.png" class="avatar-md rounded-circle" alt="Logo">
                        </a>
                    </div>
                    <div class="d-flex justify-content-center align-items-center pe-3">

                        <?php

                        if (isset($_SESSION["userId"])) :

                        ?>
                            <div class="d-flex justify-content-center align-items-center" id="login">
                                <div class="dropdown dropdown-notification">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonNoti" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-symbols-rounded position-relative">
                                            notifications
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="num_unread_notification">
                                                0
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>


                                    </button>
                                    <div class="dropdown-menu w-350 dropdown-menu-start " aria-labelledby="dropdownMenuButtonNoti">
                                        <div class="card border-0 mb-0">
                                            <h5 class="card-header text-primary">Thông báo</h5>
                                            <div class="card-body overflow-y-scroll" style="max-height:40vh;">
                                                <h6 class="fw-600">Mới nhất</h6>
                                                <div class="list-group new-notification-list">

                                                    <a href="#" class="d-flex list-group-item list-group-item-action border-0 text-small">Không có thông báo</a>
                                                </div>
                                                <h6 class="fw-600">Trước đó</h6>
                                                <div class="list-group list-notification">
                                                </div>
                                                <div id="end-notification"></div>
                                            </div>
                                            <div class="card-footer text-muted p-0 border-0">
                                                <button type="button" id="more-notification" class="btn list-group-item border-0 list-group-item-action  py-3 text-center">
                                                    <b>Xem thêm</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!--  -->

                            <div class="d-flex justify-content-center align-items-center" id="login">
                                <div class="dropdown">
                                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuAccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="">
                                            <img src="<?= !empty(Session::get("imagepath")) ? (Util::getCurrentURL(1) . "public/" . Session::get("imagepath")) : "https://bootdey.com/img/Content/avatar/avatar5.png" ?>" class="avatar-md avatar rounded-circle" alt="Hình avatar">
                                        </span>

                                    </button>
                                    <div class="dropdown-menu w-215" aria-labelledby="dropdownMenuAccount">
                                        <?php if (Session::checkRoles(["tutor"])) { ?>
                                            <li>
                                                <a class="dropdown-item py-1 d-inline-flex" href="../pages/registered_users">

                                                    <span class="material-symbols-rounded">
                                                        person_pin
                                                    </span>

                                                    <span class="d-block m-l-10 ">Người dùng đăng ký</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item d-inline-flex  py-1" href="../pages/schedule_tutors">
                                                    <span class="material-symbols-rounded">
                                                        calendar_month
                                                    </span>
                                                    <span class=" d-block m-l-10">Quản lí lịch dạy</span>
                                                </a>
                                            <li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                        <?php } ?>

                                        <?php if (Session::checkRoles(["user", "tutor"])) { ?>
                                            <li>
                                                <a class="dropdown-item d-inline-flex py-1" href="../pages/registered_tutors">

                                                    <span class="material-symbols-rounded">
                                                        school
                                                    </span>
                                                    <!-- <img src="../public/images/icons/tuition_60px.png" class="w-20" alt="" srcset=""> -->

                                                    <span class="d-block m-l-10">Gia sư đã đăng ký</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item  d-inline-flex py-1" href="../pages/schedule_user">
                                                    <span class="material-symbols-rounded">
                                                        today
                                                    </span>
                                                    <!-- <img src="../public/images/icons/schedule_48px.png" class="w-24" alt="" srcset=""> -->

                                                    <span class="d-block m-l-10">Lịch học của bạn</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item d-inline-flex py-1" href="<?= Format::validation("./saved_tutors?limit=3&page=1") ?>">
                                                    <span class="material-symbols-rounded text-danger">
                                                        favorite
                                                    </span>
                                                    <span class="d-block m-l-10">Gia sư đã lưu</span>
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>


                                        <?php } ?>

                                        <li>
                                            <a class="dropdown-item d-inline-flex py-1" href="<?= Format::validation("../pages/profile") ?>">
                                                <span class="material-symbols-rounded">
                                                    manage_accounts
                                                </span>
                                                <span class="d-block m-l-10">Cài đặt tài khoản</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-inline-flex logout py-1" href-action="logout">
                                                <span class="material-symbols-rounded">
                                                    logout
                                                </span>
                                                <span class="d-block m-l-10">Đăng xuất</span>
                                            </a>
                                        </li>
                                    </div>
                                </div>
                                <span class="font-weight-600 d-md-block d-none">
                                    <?= Session::get("lastname") . ' ' . Session::get("firstname") ?>
                                </span>

                            </div>

                        <?php

                        else :
                        ?>
                            <div class="d-block" id="signup-signin">
                                <a href="<?php echo htmlspecialchars("login") ?>" style="cursor: pointer">
                                    Đăng nhập/Đăng kí
                                </a>

                            </div>

                        <?php endif; ?>
                        <!-- Button trigger modal -->
                    </div>
                </div>
            </section>

            <section class="p-0" id="header">

                <nav class="navbar navbar-expand-lg p-0 navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
                    <div class="container-lg h-100  px-2 ">


                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation" aria-haspopup="true">
                <span class="fa-solid fa-bars fa-2xl"></span>
            </button> -->




                        <div class="collapse h-100  navbar-collapse " id="ftco-nav">
                            <ul class="navbar-nav h-100  me-auto align-items-lg-center">
                                <li class="nav-item <?php if (isset($introduction)) echo $introduction;
                                                    else echo ""  ?>
                                                    ?>"><a href="index" class="nav-link">Giới thiệu</a></li>
                                <li class="nav-item dropdown <?php if (isset($nav_tutor_active)) echo $nav_tutor_active;
                                                                else echo ""  ?>">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tìm gia sư</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                                        <a class="dropdown-item" href="#">Page 1</a>
                                        <a class="dropdown-item" href="#">Page 2</a>
                                        <a class="dropdown-item" href="#">Page 3</a>
                                        <a class="dropdown-item" href="list_tutor">Danh sách gia sư</a>
                                    </div>
                                </li>
                                <li class="nav-item <?php if (isset($nav_tutor_register_form_active)) echo $nav_tutor_register_form_active;
                                                    else echo ""  ?>"><a href="tutor_registration_form" class="nav-link">Trở thành gia sư</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Bài viết</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Liên hệ</a></li>

                            </ul>




                        </div>



                    </div>

                </nav>
                <!-- END nav -->

            </section>

        </header>