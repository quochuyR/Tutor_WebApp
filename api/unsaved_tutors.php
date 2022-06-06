<?php
namespace Ajax;
use Library\Session;
use Helpers\Format;
use Classes\SavedTutor;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/session.php");
if(!Session::checkRoles(['user','tutor'])){
    header("location:../pages/errors/404");
}
include_once($filepath . "../../classes/savedtutors.php");
include_once($filepath . "../../helpers/format.php");
// Session::init();
$save_tutor = new SavedTutor();




if (isset($_POST["tutorId"]) && !empty($_POST["tutorId"])) {
    $tutorId = Format::validation($_POST["tutorId"]);


    $result = $save_tutor->deleteTutorSaved(Session::get("userId"), $tutorId);
    if($result){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["delete" => "successful"]);
    }
    exit;
}

