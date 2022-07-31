<?php

namespace Ajax;

use Helpers\Util, Helpers\Format, Helpers\Sanitization;
use Library\Session;
use Classes\AdminSignUp;
use Fiber;

use Exception;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));
// include_once($filepath . "../../lib/session.php");
Session::init();
// include_once($filepath . "../../classes/adminsignup.php");

// include_once($filepath . "../../helpers/utilities.php");
// include_once($filepath . "../../helpers/format.php");


$signup = new AdminSignUp();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST["token"]) || !isset($_SESSION["csrf_token"])) {
        exit();
    }
    if (
        isset($_POST["first_name"])
        && isset($_POST["last_name"])
        && isset($_POST["email"])
        && isset($_POST["phone_number"])
        && isset($_POST["username"])
        && isset($_POST["password"])
        && hash_equals($_POST["token"], $_SESSION["csrf_token"])
    ) {

        $fields = [
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'phone_number' => 'string',
            'username' => 'string',
            'password' => 'string',
        ];

        $inputs = [
            'first_name' => $_POST["first_name"],
            'last_name' => $_POST["last_name"],
            'email' => $_POST["email"],
            'phone_number' => $_POST["phone_number"],
            'username' => $_POST["username"],
            'password' => $_POST["password"],
        ];


        $data = Sanitization::sanitize($inputs, $fields);

        // $first_name = Format::validation($_POST["first_name"]);
        // $last_name =  Format::validation($_POST["last_name"]);
        // $email =  filter_var(Format::validation($_POST["email"]), FILTER_VALIDATE_EMAIL);
        // $phone_number =  Format::validation($_POST["phone_number"]);
        // $username =  Format::validation($_POST["username"]);
        // $password =  Format::validation($_POST["password"]);

        $activation_code = $signup->generate_activation_code();
        try {
            $signup_check = $signup->sign_up_admin($data['first_name'], $data['last_name'], $data['email'], $data['phone_number'], $data['username'], $data['password'], $activation_code);

            // $signup_check = true;
            if ($signup_check) {

                // send the activation email


                $send = $signup->send_activation_email(["email" => $data['email'], "first_name" => $data['first_name'], "last_name" => $data['last_name']], $activation_code);

                header('Content-Type: application/json; charset=UTF-8');
                echo json_encode(array("sign_up" => "successful", "url" => "login", "email" => $data['email'], "message" => "Vui lòng kiểm tra email của bạn để kích hoạt tài khoản của bạn trước khi đăng nhập."));
            }
        } catch (Exception $ex) {

            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(array("sign_up" => "fail", "errors" => $ex->getMessage()));
        }
    }
} else {

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array());
}
// }
