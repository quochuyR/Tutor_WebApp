<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\SubjectTopic, Classes\Subject;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['tutor', 'user'])) {
    header("location:../../pages/errors/404");
}
// include_once $filepath . "../../classes/subjecttopics.php";
// include_once $filepath . "../../classes/subjects.php";

// include_once $filepath . "../../helpers/format.php";

$_subject_topic = new SubjectTopic();
$_subjects = new Subject();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {

        try {
            $get_subjects = $_subjects->getAll();

            $subjects = [];
            if ($get_subjects) {
                while ($r = $get_subjects->fetch_assoc()) {
                    $get_subjects_topic = $_subject_topic->getSubjectByQuery($_POST, $r["id"]);
                    if ($get_subjects_topic) {


                        $subject_topic = array();

                        while ($result = $get_subjects_topic->fetch_assoc()) {
                            array_push($subject_topic, ["id" => $r["id"] . '-' . $result["topicId"], "text" => $result["topicName"]]);
                        }
                        if (!empty($subject_topic)) array_push($subjects, ["id" => $r["id"], "text" =>  $r["subject"], "children" => $subject_topic]);
                    }
                }
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        } finally {
            header('Content-Type: application/json; charset=utf-8');
            // echo json_encode([ "results" => [["text" => "group 1", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]], ["text" => "group 2", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]]]  ]);
            echo json_encode($subjects);
        }
    }
}
