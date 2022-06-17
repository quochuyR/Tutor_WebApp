<?php

namespace Views\Auth;

use Classes\AppUser, Classes\AdminLogin;
use Helpers\Filter, Helpers\Util, Helpers\FLASH;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

Session::init();
$_user = new AppUser();
$_login = new AdminLogin();
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // sanitize the email & activation code
    if (isset($_GET['email']) && isset($_GET['activation_code'])) {
        [$inputs, $errors] = Filter::filter($_GET, [
            'email' => 'string | required | email',
            'activation_code' => 'string | required'
        ]);

        if (!$errors) {

            $user = $_user->find_unverified_user($inputs['activation_code'], $inputs['email']);

            // if user exists and activate the user successfully
            if ($user && $_user->activate_user($user['id'])) {
                Util::redirect_with_message(
                    '../login',
                    'Tài khoản của bạn đã được kích hoạt thành công. Vui lòng đăng nhập tại đây.'
                );
                
            }
        }
    }
}

//redirect to the register page in other cases
Util::redirect_with_message(
    '../signup',
    'Liên kết kích hoạt không hợp lệ, vui lòng đăng ký lại.',
    Flash::FLASH_ERROR
);
