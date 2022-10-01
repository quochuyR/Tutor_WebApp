<?php

namespace Pages;

use Classes\AdminLogin, Classes\Remember, Classes\Notification;
use Exception;
use Helpers\Util, Helpers\Format;
use Library\Session;

require_once(__DIR__ . "../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));
// include_once($filepath . "../../classes/adminlogin.php");
// include_once($filepath . "../../classes/remember.php");
// include_once($filepath . "../../lib/session.php");
// include_once($filepath . "../../helpers/utilities.php");
// include_once($filepath . "../../helpers/format.php");
// include_once($filepath . "../../classes/notifications.php");
Session::init();
if(Session::checkLogin()){
    header("location: index");
}
$captcha = '';
// handling the captcha and checking if it's ok
$secret = '6Lfw6MkeAAAAAIS-qyaNIm281C8imMz6h1ThadJT';
$notification = new Notification();

$login = new AdminLogin();

$remember = new Remember();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["token"]) || !isset($_SESSION["csrf_token"])) {
        exit();
    }
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        // echo 'captcha: '.$captcha;
    }

    if (!$captcha) {

        header('Content-Type: application/json; charset=UTF-8');
        json_encode(array('message' => 'Captcha chưa được checked')); // 1011 : ERROR_CAPTCHA_NOT_BEEN_CHECKED
    }

    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

    // var_dump($response);

    // if the captcha is cleared with google, send the mail and echo ok.
    if ($response['success'] != false) {
        // send the actual mail
        // @mail($email_to, $subject, $finalMsg);





        // the echo goes back to the ajax, so the user can know if everything is ok
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["remember"]) && hash_equals($_POST["token"], $_SESSION["csrf_token"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $remember = $_POST["remember"];

            try {
                $login_check = $login->login_admin($username, $password, $remember);


                if ($login_check) {
                    if (Session::checkRoles(["admin"])) {
                        header("Content-Type: application/json;charset=utf-8");
                        echo json_encode(["login" => "successful", "url" => "../admin/pages"]);
                    } else {
                        if (isset($_SESSION['rdrurl'])) {
                            header("Content-Type: application/json;charset=utf-8");
                            echo json_encode(["login" => "successful", "url" => Session::get('rdrurl')]);
                        } else {
                            header("Content-Type: application/json;charset=utf-8");
                            echo json_encode(["login" => "successful", "url" => "./"]);
                        }
                    }

                    exit;
                }
            } catch (Exception $ex) {
                print_r($ex->getMessage());
            }

            exit;
        }
    } else {

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array('message' => 'Captcha phản hồi thất bại'));
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    [$errors, $inputs] = \Helpers\Flash::session_flash('errors', 'inputs');
}

$title = "Đăng nhập";


include "../inc/header.php";
?>


<div id="main" class="container ">
    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">

                    <div class="container-login100" style="background-image: none;">
                        <div class="wrap-login100 p-l-45 p-r-30 p-t-57 p-b-30">
                            <form class="login100-form validate-form signin-form">
                                <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />
                                <span class="login100-form-title p-b-37">
                                    Đăng nhập
                                </span>

                                <div id="error-login">
                                    <?php \Helpers\Flash::flash(); ?>

                                </div>
                                <div class="wrap-input100 validate-input m-b-35">
                                    <span class="focus-input100"></span>
                                    <span class="field-icon field-icon-user"></span>
                                    <input id="username-field" class="input100" type="text" name="username" placeholder="Tài khoản">
                                </div>
                                <div class="wrap-input100 validate-input m-b-35">
                                    <span class="focus-input100"></span>
                                    <span class="field-icon field-icon-password"></span>

                                    <input id="password-field" class="input100" type="password" name="password" placeholder="Mật khẩu">
                                </div>
                                <span id="recaptcha-error" class="d-block mb-2 ps-3 text-danger"></span>
                                <div class="wrap-input100 validate-input m-b-20 d-flex justify-content-center">
                                    <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6Lfw6MkeAAAAADmRhvf__Nri7XkH3dVGsR9v64lM"></div>

                                </div>

                                <div class="form-group d-md-flex m-b-25">
                                    <div class="w-100 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Nhớ đăng nhập
                                            <input id="remember-me" type="checkbox" checked>
                                            <span class="checkmark-sign"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="submit login100-form-btn">
                                        Đăng nhập
                                    </button>
                                </div>
                                <!--  -->
                                <!-- <div class="text-center p-t-57 p-b-20">
                                    <span class="txt1">
                                        hoặc đăng nhập bằng
                                    </span>
                                </div>
                                <div class="flex-c p-b-90">
                                    <a href="#" class="login100-social-item">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="login100-social-item">
                                        <img src="../public/images/icons/icon-google.png" alt="GOOGLE">
                                    </a>
                                </div> -->
                                <div class="text-center p-t-57 p-b-5">
                                    <span class="txt1 fw-600">
                                        Bạn chưa có tài khoản?
                                    </span>
                                    <a href="signup" class=" hov1 fw-500">
                                        Đăng ký
                                    </a>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

</div>







<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>