<?php
namespace Ajax;
use Helpers\Format;
use Classes\SavedTutor;
$filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");
include_once($filepath . "../../classes/savedtutors.php");
include_once($filepath . "../../helpers/format.php");
// Session::init();





if (isset($_POST["userId"]) && isset($_POST["tutorId"])) {
    $userId = Format::validation($_POST["userId"]);
    $tutorId = Format::validation($_POST["tutorId"]);
    $save_tutor = new SavedTutor();

    $result = $save_tutor->deleteTutorSaved($userId, $tutorId);

    header("location:../pages/saved_tutors.php");
        exit;
}

