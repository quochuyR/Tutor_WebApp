<?php

namespace Api;

use Helpers\Format;
use Classes\SubjectTopic;
use Library\Session;
// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

require_once($filepath . "/vendor/autoload.php");

// include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
// include_once($filepath . "../../classes/subjecttopics.php");
// include_once($filepath . "../../helpers/format.php");


$_subject = new SubjectTopic();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['subject-topic-name']) && !empty($_POST['subject-topic-name'])) 
    && (isset($_POST['subject-topic']) && !empty($_POST['subject-topic']))
    ) {

        $subject_id = Format::validation($_POST['subject-topic']);
        $subject_topic_name = Format::validation($_POST['subject-topic-name']);

        $subject_name_array = preg_split("/\r\n|\n|\r/", $subject_topic_name);

        $add_subject =  $_subject->add_subject_topic($subject_id, $subject_name_array);


        if ($add_subject) {

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["add" => "success", "subject" => $subject_topic_name]);
        }
    }
}
