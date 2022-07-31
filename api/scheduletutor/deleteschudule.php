<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\TutoringSchedule, Classes\TeachingTime;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));
// include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once $filepath . "../../classes/tutoringschedule.php";
// include_once $filepath . "../../classes/teachingtimes.php";
// include_once $filepath . "../../helpers/utilities.php";
// include_once $filepath . "../../helpers/format.php";

$_tutoring_schedule = new TutoringSchedule();
$_teaching_time = new TeachingTime();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {
        try {
            $Id = Format::validation($_POST["id"]);

            $get_tutoring_schedule = $_tutoring_schedule->deleteTutoringSchedule($Id);

            if ($get_tutoring_schedule > 0) {

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["action" => "success"]);
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["action" => "fail"]);
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        }
    }
}
