<?php

namespace Api;

use Exception;
use Classes\AppUser;
use Helpers\Format;
use Library\Session;

//  \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));
require_once($filepath . "/vendor/autoload.php");

// include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
// include_once($filepath . "../../classes/tutors.php");
// include_once($filepath . "../../helpers/format.php");


$_user = new AppUser();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
    ) {
        try {
            $id = Format::validation($_POST['id']);
            $isActive = Format::validation($_POST['isActive']);
            //  echo $isActive;

            $update_active_user =  $_user->activate_user($id, $isActive);


            if ($update_active_user) {
                if ($isActive == 1) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["update" => "success", "message" => "Kích hoạt tài khoản thành công"]);
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["update" => "success", "message" => "Khoá tài khoản thành công."]);
                }
            }
        } catch (Exception $ex) {;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["error" => $ex->getMessage()]);
        }
    }
}
