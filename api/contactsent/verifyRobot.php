<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\Contact;

$filepath  = realpath(dirname(__FILE__));

require_once(__DIR__ . "../../../vendor/autoload.php");
// include_once($filepath . "../../lib/session.php");
// if (!Session::checkRoles(['user', 'tutor'])) {
//         header("location:../../pages/errors/404");
// }
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../helpers/format.php");
Session::init();


try {
    $secret = '6Lfw6MkeAAAAAIS-qyaNIm281C8imMz6h1ThadJT';

    $captcha = '';

    $REMOTE_ADDR = $_POST['REMOTE_ADDR'];
    if (!isset($_POST["token_homepage"])) {
        exit();
    }
    if (isset($_POST['g_recaptcha_response'])) {
        $captcha = $_POST['g_recaptcha_response'];
        // echo 'captcha: '.$captcha;
    }

    if (!$captcha) {
        header('Content-Type: application/json; charset=UTF-8');
        json_encode(array('message' => 'Captcha chưa được checked')); // 1011 : ERROR_CAPTCHA_NOT_BEEN_CHECKED
    }
    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $REMOTE_ADDR), true);
    echo ($response['success']);
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
