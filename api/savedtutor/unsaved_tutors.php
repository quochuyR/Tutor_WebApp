<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\SavedTutor;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['user', 'tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../helpers/format.php");
// Session::init();
$save_tutor = new SavedTutor();




if (isset($_POST["tutorId"]) && !empty($_POST["tutorId"])) {
    try {
        $tutorId = Format::validation($_POST["tutorId"]);


        $result = $save_tutor->deleteTutorSaved(Session::get("userId"), $tutorId);
        if ($result) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["delete" => "successful"]);
        }
    } catch (Exception $ex) {
        print_r($ex->getMessage());
    } finally {
        exit;
    }
}
