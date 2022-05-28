<?php

namespace Ajax;

use Classes\RegisterUser;
use Helpers\Format;
use Library\Session;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor'])) {
    header("location:../pages/errors/404");
}
include_once $filepath . "../../classes/registerusers.php";

include_once $filepath . "../../helpers/format.php";

$_register_user = new RegisterUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['id']) && !empty($_POST['id']))
     && (isset($_POST['topicId']) && !empty($_POST['topicId']))
     && (isset($_POST['status']) && is_numeric($_POST['status']))) {

        $userId = Format::validation($_POST["id"]);
        $topicId = Format::validation($_POST["topicId"]);
        $status = Format::validation($_POST["status"]);
        $get_register = $_register_user->GetRegisterIdByTopicId($userId, Session::get("tutorId"), $topicId, $status);
        if ($get_register) {

            $register = $get_register->fetch_assoc();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["registerId" => $register["id"]]);

        }
    }
}
