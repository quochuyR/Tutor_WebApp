<?php

namespace Ajax;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\AdminLogin, Classes\Notification;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));
// include_once($filepath . "../../lib/session.php");
Session::init();
// include_once($filepath . "../../classes/adminlogin.php");

// include_once($filepath . "../../helpers/utilities.php");
// include_once($filepath . "../../helpers/format.php");
// include_once($filepath . "../../classes/notifications.php");


$captcha = '';
// handling the captcha and checking if it's ok
$secret = '6Lfw6MkeAAAAAIS-qyaNIm281C8imMz6h1ThadJT';
$login = new AdminLogin();
$notification = new Notification();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // if (isset($_POST['g-recaptcha-response'])) {
    //     $captcha = $_POST['g-recaptcha-response'];
    //     // echo 'captcha: '.$captcha;
    // }

    // if (!$captcha) {
    //     header('HTTP/1.1 500 Internal Server Booboo');
    //     header('Content-Type: application/json; charset=UTF-8');
    //     die(json_encode(array('message' => 'CAPTCHA CHƯA ĐƯỢC CHECKED', 'code' => 1011))); // 1011 : ERROR_CAPTCHA_NOT_BEEN_CHECKED
    // }

    // $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

    // var_dump($response);

    // if the captcha is cleared with google, send the mail and echo ok.
    // if ($response['success'] != false) {
    // send the actual mail
    // @mail($email_to, $subject, $finalMsg);
      


        // the echo goes back to the ajax, so the user can know if everything is ok
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["remember"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $remember = $_POST["remember"];


            $login_check = $login->login_admin($username, $password, $remember);
        }
      
        if ($login_check ) {



        
    }
} else {
    header('HTTP/1.1 500 Internal Server Booboo');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'CAPTCHA PHẢN HỒI THẤT BẠI', 'code' => 1012))); // 1012 : ERROR_CAPTCHA_FAIL
}
// }




?>