<?php

namespace Ajax;

use Classes\Subject;
use Helpers\Format;
use Library\Session;

$filepath = realpath(dirname(__FILE__, 4));

include_once $filepath . "../lib/session.php";
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}

include_once $filepath . "../../classes/subjects.php";

include_once $filepath . "../../helpers/format.php";

$_subjects = new Subject();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST) ) {

        $get_subjects = $_subjects->getSubjectJoinTopicByQuery($_POST);

        $subjects = [];
        if ($get_subjects) {
            while($r = $get_subjects->fetch_assoc()){              
                 array_push($subjects, ["id" => $r["id"], "text" =>  $r["subject"]]);
            }
            
            
            
        }
        header('Content-Type: application/json; charset=utf-8');
        // echo json_encode([ "results" => [["text" => "group 1", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]], ["text" => "group 2", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]]]  ]);
        echo json_encode($subjects);
        
    }
}
