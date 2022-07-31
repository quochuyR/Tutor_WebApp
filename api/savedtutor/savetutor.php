<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\SavedTutor;

$filepath  = realpath(dirname(__FILE__));

require_once(__DIR__ . "../../../vendor/autoload.php");
// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['user', 'tutor'])) {
        header("location:../../pages/errors/404");
}
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../helpers/format.php");
Session::init();





if (isset($_POST["tutorId"]) && !empty($_POST["tutorId"])) {
        try {
                $tutorId = Format::validation($_POST["tutorId"]);
                $save_tutor = new SavedTutor();
                $isSavedTutor = $save_tutor->countTutorSaved(Session::get("userId"), $tutorId)->fetch_assoc()["numTutor"];

                if ($isSavedTutor == 0) {
                        $result = $save_tutor->createTutorSaved(Session::get("userId"), $tutorId);

                        header("Content-Type: application/json;charset=utf-8");
                        echo json_encode(["insert" => "successful", "data" =>  $result !== false ? "Đã lưu" : "Lưu"]);
                } else {
                        header("Content-Type: application/json;charset=utf-8");
                        echo json_encode(["insert" => "fail"]);
                }
        } catch (Exception $ex) {
                print_r($ex->getMessage());
        } finally {
                exit;
        }
}
