<?php

namespace Api;

use Helpers\Format;
use Classes\SubjectTopic;
use Library\Session;

//  \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
include_once($filepath . "../../classes/subjecttopics.php");
include_once($filepath . "../../helpers/format.php");


$_subject_topic = new SubjectTopic();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['subject_id']) && is_numeric($_POST['subject_id']))
        && (isset($_POST['topic_id']) && is_numeric($_POST['topic_id']))
        && (isset($_POST['topic_name']) && !empty($_POST['topic_name']))
    ) {
        $subjectId = Format::validation($_POST['subject_id']);
        $topic_id = Format::validation($_POST['topic_id']);
        $topic_name = Format::validation($_POST['topic_name']);
        

        $update_subject_topic =  $_subject_topic->update_subject_subject($topic_id, $subjectId, $topic_name);


        if ($update_subject_topic) {

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["update"=>"success", "subject"=> $topic_name]);
        }
    }
}
