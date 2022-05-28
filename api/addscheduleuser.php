<?php

namespace Ajax;

use Classes\TutoringSchedule;
use Helpers\Format;
use Library\Session;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor'])) {
    header("location:../pages/errors/404");
}
include_once $filepath . "../../classes/tutoringschedule.php";

include_once $filepath . "../../helpers/format.php";

$_schedule = new TutoringSchedule();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["id"]) && is_numeric($_POST["id"])
        && isset($_POST["status"]) && is_numeric($_POST["status"])
    ) {

        $id = Format::validation($_POST["id"]);
        $status = Format::validation($_POST["status"]);

       

        if ((isset($_POST["DoW_id"]) && $_POST["DoW_id"] != -1)
            && (isset($_POST["topicId"]) && $_POST["topicId"] != 0)
            && (isset($_POST["timeId"]) && $_POST["timeId"] != 0)) {

                $dayofweekId = Format::validation($_POST["DoW_id"]);
                $topicId = Format::validation($_POST["topicId"]);
                $timeId = Format::validation($_POST["timeId"]);

                $insert_schedule = $_schedule->AddTutoringSchedule($status, $id, $dayofweekId, $topicId, $timeId, Session::get("tutorId"));
                if ($insert_schedule) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["action" => "successful"]);
                }
            }

            else{
                $update_status = $_schedule->AddTutoringSchedule($status, $id, null, null, null, null);
                if ($update_status) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["status" => $status]);
                }
            }
    }
}
