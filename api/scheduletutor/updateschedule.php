<?php

namespace Ajax;

use Classes\TutoringSchedule, Classes\TeachingTime;
use Helpers\Format;
use Library\Session;
require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));
// include_once $filepath . "../../lib/session.php";
Session::checkRoles(['tutor']);
// include_once $filepath . "../../classes/tutoringschedule.php";
// include_once $filepath . "../../classes/teachingtimes.php";
// include_once $filepath . "../../helpers/utilities.php";
// include_once $filepath . "../../helpers/format.php";

$_tutoring_schedule = new TutoringSchedule();
$_teaching_time = new TeachingTime();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {
        $Id = Format::validation($_POST["id"]);
        $day_of_weekId = Format::validation($_POST["dayofweek"]);
        $timeId = Format::validation($_POST["time"]);
        $subjectTopicId = Format::validation($_POST["subject_topic"]);
        $day_of_weekId_prev = Format::validation($_POST["dayofweek_prev"]);
        $timeId_prev = Format::validation($_POST["time_prev"]);
        $get_tutoring_schedule = $_tutoring_schedule->updateTutoringSchedule($Id, $day_of_weekId, $timeId, $subjectTopicId);

        if ($get_tutoring_schedule > 0) {
            
            $_teaching_time->updateStatusDayAndTime(Session::get("tutorId"), $day_of_weekId, $timeId, $day_of_weekId_prev, $timeId_prev);
            $get_schedule = $_tutoring_schedule->GetUserScheduleById($Id);
            if ($get_schedule) {
                $row = array();
                while ($schedule = $get_schedule->fetch_assoc()) {
                    $row[] = $schedule;
 }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($row);
            }
        }
    }
} ?>