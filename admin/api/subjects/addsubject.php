<?php

namespace Api;

use Exception;
use Helpers\Format;
use Classes\Subject;
use Library\Session;
// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

require_once($filepath . "/vendor/autoload.php");
// include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
// include_once($filepath . "../../classes/subjects.php");
// include_once($filepath . "../../helpers/format.php");


$_subject = new Subject();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['subject-name']) && !empty($_POST['subject-name'])
    ) {

        try {
            $subject_name = Format::validation($_POST['subject-name']);

            $subject_name_array = preg_split("/\r\n|\n|\r/", $subject_name);

            $add_subject =  $_subject->add_subject($subject_name_array);


            if ($add_subject) {

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["add" => "success", "subject" => $subject_name]);
            }
        } catch (Exception $ex) {;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["error" => $ex->getMessage()]);
        }
    }
}
