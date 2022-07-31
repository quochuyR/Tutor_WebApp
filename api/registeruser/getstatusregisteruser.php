<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\RegisterUser;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once $filepath . "../../classes/registerusers.php";

// include_once $filepath . "../../helpers/format.php";

$_register_user = new RegisterUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id']) && !empty($_POST['id'])) {

        try {
            $userId = Format::validation($_POST["id"]);
            $get_status = $_register_user->GetApprovalRegisteredUser($userId, Session::get("tutorId"));
            if ($get_status) {

                $status = $get_status->fetch_assoc();
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["status" => $status["status"]]);
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        }
    }
}
