<?php

namespace Ajax;


use Classes\Tutor, Classes\TeachingTime, Classes\TeachingSubject, Classes\Certificate;
use Exception;
use Helpers\Format;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor'])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["author" => "isTutor"]);
    exit();
}
// include_once $filepath . "../../classes/tutors.php";
// include_once $filepath . "../../classes/teachingtimes.php";
// include_once $filepath . "../../classes/teachingsubjects.php";

// include_once $filepath . "../../helpers/format.php";

$_tutor = new Tutor();
$_teaching_time = new TeachingTime();
$_teaching_subject = new TeachingSubject();


// print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST["token"]) || !isset($_SESSION["csrf_token"])) {
        exit();
    }

    if (hash_equals($_POST["token"], $_SESSION["csrf_token"])) {
        try {
            $currentPhone =    (isset($_POST["currentPhone"]) && !empty($_POST["currentPhone"])) ? Format::validation($_POST["currentPhone"]) : NULL;
            $currentEmail = (isset($_POST["currentEmail"]) && !empty($_POST["currentEmail"])) ? filter_var($_POST["currentEmail"], FILTER_SANITIZE_EMAIL) : NULL;
            $currentAddress = (isset($_POST["currentAddress"]) && !empty($_POST["currentAddress"])) ? Format::validation($_POST["currentAddress"]) : NULL;
            $currentProvince = (isset($_POST["currentProvince"]) && !empty($_POST["currentProvince"])) ? Format::validation($_POST["currentProvince"]) : NULL;
            $districts = (isset($_POST["districts"]) && !empty($_POST["districts"])) ? Format::validation($_POST["districts"]) : NULL;
            $teachingForm = (isset($_POST["teachingForm"]) && is_string($_POST["teachingForm"])) ? Format::validation($_POST["teachingForm"]) : NULL;
            $linkFace = isset($_POST["linkFace"]) && !empty($_POST["linkFace"]) ? Format::validation($_POST["linkFace"]) : NULL;
            $linkTwit = isset($_POST["linkTwit"]) && !empty($_POST["linkTwit"]) ? Format::validation($_POST["linkTwit"]) : NULL;

            $data = array($currentPhone, $currentEmail, $currentAddress, $currentProvince, $teachingForm,  $districts, $linkFace, $linkTwit, Session::get("tutorId"));

            $update_tutor = $_tutor->update_info_tutor($data);


            // if (!$update_tutor) {
            //     header('Content-Type: application/json; charset=utf-8');
            //     echo json_encode(["update" => "fail", "message" => "Thông tin không có sự thay đổi."]);
            // }

            if (isset($_POST["arr_add_teaching_time"]) && !empty($_POST["arr_add_teaching_time"])) {
                // print_r($_POST["arr_add_teaching_time"]);
                foreach ($_POST["arr_add_teaching_time"] as $times_add) {
                    foreach ($times_add as $times) {
                        $_teaching_time->insertTeachingTime(Session::get("tutorId"), $times["dayId"],  $times["timeId"]);
                    }
                }
            }
            if (isset($_POST["arr_del_teaching_time"]) && !empty($_POST["arr_del_teaching_time"])) {
                foreach ($_POST["arr_del_teaching_time"] as $times_del) {
                    foreach ($times_del as $times) {
                        $_teaching_time->delete_teaching_time(Session::get("tutorId"), $times["dayId"],  $times["timeId"]);
                    }
                }
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["update" => "successful"]);
        } catch (Exception $ex) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["update" => "fail", "Có lỗi xãy ra vui lòng nhập đúng định dạng"]);
        }
    }
}
