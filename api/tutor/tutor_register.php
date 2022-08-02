<?php

namespace Ajax;


use Exception;
use Library\Session;
use Helpers\Format, Helpers\UploadFile;
use Classes\Tutor, Classes\TeachingTime, Classes\TeachingSubject, Classes\Certificate;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
if (Session::checkRoles(['tutor'])) {
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
$_certificate = new Certificate();

/* upload certificate */
$dir_certificate = __DIR__ . "../../../admin/certificates/" . Session::get("username");
if (!is_dir($dir_certificate)) {
    mkdir($dir_certificate);
}

// file upload if the number of files in the directory is less than 10 or is empty.
$files_in_directory = scandir($dir_certificate);
if ($files_in_directory) {
    $files_in_directory = array_diff($files_in_directory, array('.', '..'));
}

// limit 10 certificate   
if (count($files_in_directory) <= 10 || !$files_in_directory) {
    $registered_as_tutor = $_tutor->getTutorIdByUserId(Session::get("userId"))->fetch_row();
    if (!isset($registered_as_tutor)) {
        $upload_image = UploadFile::upload("file", $dir_certificate . "/");
    }
}

/* end upload certificate */


// info tutor
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST["token"]) || !isset($_SESSION["csrf_token"])) {
        exit();
    }

    if (
        (isset($_POST["currentPhone"]) && !empty($_POST["currentPhone"]))
        && (isset($_POST["currentEmail"]) && !empty($_POST["currentEmail"]))
        && (isset($_POST["currentAddress"]) && !empty($_POST["currentAddress"]))
        && (isset($_POST["currentJob"]) && !empty($_POST["currentJob"]))
        && (isset($_POST["currentProvince"]) && !empty($_POST["currentProvince"]))
        && (isset($_POST["currentCollage"]) && !empty($_POST["currentCollage"]))
        && (isset($_POST["graduateYear"]) && is_numeric($_POST["graduateYear"]))
        && (isset($_POST["districts"]) && !empty($_POST["districts"]))
        && (isset($_POST["teachingForm"]) && is_string($_POST["teachingForm"]))
        && (isset($_POST["description"]) && !empty($_POST["description"]))
        && hash_equals($_POST["token"], $_SESSION["csrf_token"])
    ) {
        try {
            $inputs = [
                "currentPhone" => $_POST["currentPhone"],
                "currentEmail" => $_POST["currentEmail"],
                "currentAddress" => $_POST["currentAddress"],
                "currentJob" => $_POST["currentJob"],
                "currentProvince" => $_POST["currentProvince"],
                "currentCollage" => $_POST["currentCollage"],
                "graduateYear" => $_POST["graduateYear"],
                "districts" => $_POST["districts"],
                "teachingForm" => $_POST["teachingForm"],
     
                
            ];
            $fields = [
                "currentPhone" => "string",
                "currentEmail" =>"email",
                "currentAddress" => "string",
                "currentJob" => "string",
                "currentProvince" => "string",
                "currentCollage" => "string",
                "graduateYear" => "int",
                "districts" => "string",
                "teachingForm" => "string",
            ];

            // description, linkFace, linkTwitter validation bình thường 
            // bằng htmlspecialchars không cần sanitize
            $description = Format::validation($_POST["description"]);
            $linkFace = isset($_POST["linkFace"]) && !empty($_POST["linkFace"]) ? Format::validation($_POST["linkFace"]) : NULL;
            $linkTwit = isset($_POST["linkTwit"]) && !empty($_POST["linkTwit"]) ?Format::validation($_POST["linkTwit"]) : NULL;
            
            // sanitize input
            $data_input = \Helpers\Sanitization::sanitize($inputs,$fields);
            // tạo mảng chứa data input
            $data = array(Session::get("userId"), $description, $data_input['currentPhone'], $data_input['currentEmail'], $data_input['currentAddress'], $data_input['currentCollage'], $data_input['graduateYear'],  $data_input['currentJob'], $data_input['currentProvince'], $data_input['teachingForm'],  $data_input['districts'], $linkFace, $linkTwit);

            // print_r($currentProvince);
            $numTutor = $_tutor->countTutorByUserId(Session::get("userId"))->fetch_assoc()["countTutor"];
            // $numTutor = 0;
            if ($numTutor === 0) {
                $insert_register_tutor = $_tutor->addRegisterTutor($data);
                // $insert_register_tutor = false;

                if ($insert_register_tutor) {
                    $tutorId = $_tutor->getTutorIdByUserId(Session::get("userId"))->fetch_assoc()["tutorId"];



                    // upload avatar user
                    // 0 => 'images', 1 => image file name
                    $certificate_images = scandir($dir_certificate);
                    $certificate_images = array_diff($certificate_images, array('.', '..'));

                    if (!empty($certificate_images)) {
                        // update lại đường dẫn insert_certificates($tutorId, $upload_image["fileName"])
                        $insert_new_certificate_image = $_certificate->insert_certificates($tutorId, array_values($certificate_images));
                        if ($insert_new_certificate_image) {
                        }
                    }


                    // teaching subject
                    if (isset($_POST["subjects"]) && !empty($_POST["subjects"])) {
                        foreach ($_POST["subjects"] as $key => $topic) {

                            $topicId = explode("-", $topic["id"])[1];
                            if (Format::validation($topicId)) {
                                $_teaching_subject->insertTeachingSubjects($tutorId, $topicId);
                                // print_r($topicId . " ");
                            }
                        }
                    }

                    // teaching time
                    if (isset($_POST["Monday"]) && $_POST["Monday"] !== "false" && is_array($_POST["Monday"])) {
                        foreach ($_POST["Monday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Monday"]["dayId"], $timeId);
                        }
                    }


                    if (isset($_POST["Tuesday"]) && $_POST["Tuesday"] !== "false" && is_array($_POST["Tuesday"])) {
                        foreach ($_POST["Tuesday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Tuesday"]["dayId"], $timeId);
                        }
                    }

                    if (isset($_POST["Wednesday"]) && $_POST["Wednesday"] !== "false" && is_array($_POST["Wednesday"])) {
                        foreach ($_POST["Wednesday"]["timeId"] as $timeId) {
                            // print_r( gettype($_POST["Wednesday"]));
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Wednesday"]["dayId"], $timeId);
                        }
                    }

                    if (isset($_POST["Thursday"]) && $_POST["Thursday"] !== "false" && is_array($_POST["Thursday"])) {
                        foreach ($_POST["Thursday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Thursday"]["dayId"], $timeId);
                        }
                    }

                    if (isset($_POST["Friday"]) && $_POST["Friday"] !== "false" && is_array($_POST["Friday"])) {
                        foreach ($_POST["Friday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Friday"]["dayId"], $timeId);
                        }
                    }

                    if (isset($_POST["Saturday"]) && $_POST["Saturday"] !== "false" && is_array($_POST["Saturday"])) {
                        foreach ($_POST["Saturday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Saturday"]["dayId"], $timeId);
                        }
                    }

                    if (isset($_POST["Sunday"]) && $_POST["Sunday"] !== "false" && is_array($_POST["Sunday"])) {
                        foreach ($_POST["Sunday"]["timeId"] as $timeId) {
                            // print_r($timeId);
                            $_teaching_time->insertTeachingTime($tutorId, $_POST["Sunday"]["dayId"], $timeId);
                        }
                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["insert" => "successful"]);
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["insert" => "fail"]);
                }
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["author" => "isTutor"]);
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        }
    }
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["token" => "not_match"]);
}
