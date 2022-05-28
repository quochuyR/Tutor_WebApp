<?php

namespace Ajax;

use Classes\RegisterUser;
use Helpers\Format;
use Library\Session;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['user'])) {
    header("location:../pages/errors/404");
}
include_once $filepath . "../../classes/registerusers.php";

include_once $filepath . "../../helpers/format.php";

$_register_tutor = new RegisterUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {

        $action = Format::validation($_POST["action"]);
        $tutorId = Format::validation($_POST["tuId"]);
        $topicId = Format::validation($_POST["topicId"]);

        $ins_or_del_register_tutor = $_register_tutor->AddOrDeleteRegisterTutor($action, Session::get("userId"), $tutorId, $topicId);
       
        if ($ins_or_del_register_tutor) {
             // chỉ có topicName
            $result = $ins_or_del_register_tutor->fetch_assoc();
            // print_r($result);
            if(isset($result["added"]) && $result["added"] == "added"){
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["added" => "added", "topicName" => $result["topicName"]]);
            }
            else{
                if ($action == 1) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["insert" => "successful", "topicName" => $result["topicName"]]);
                } else {
    
    
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["delete" => "successful", "topicName" => $result["topicName"]]);
                }
            }
            
        }
    }
}
