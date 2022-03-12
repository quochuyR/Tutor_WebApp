<?php

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../classes/adminlogin.php");
include_once($filepath . "../../helpers/utilities.php");


$captcha = '';
// handling the captcha and checking if it's ok
$secret = '6Lfw6MkeAAAAAIS-qyaNIm281C8imMz6h1ThadJT';
$login = new AdminLogin();


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
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="">
                                <img src="<?= !empty(Session::get("imagepath")) ? (Util::getCurrentURL() ."/../". Session::get("imagepath")) : "https://bootdey.com/img/Content/avatar/avatar5.png" ?>" class="avatar-md rounded-circle" alt="Hình avatar">
                            </span>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">
                                <i class="far fa-calendar-alt"></i>
                                <span class="ms-2">Quản lí lịch dạy</span>
                            </a>
                            <a class="dropdown-item" href="./saved_tutors.php">

                                <i class="fas fa-heart text-danger"></i>
                                <span class="ms-2">Gia sư đã lưu</span>
                            </a>

                            <a class="dropdown-item logout" href-action="logout"><i class="fa-solid fa-right-from-bracket"></i><span class="ms-2">Đăng xuất</span> </a>
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