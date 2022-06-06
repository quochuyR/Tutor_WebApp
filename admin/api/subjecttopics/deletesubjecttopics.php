<?php

namespace Api;

use Helpers\Format;
use Classes\SubjectTopic;
use Library\Session;
use mysqli_sql_exception;

// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
include_once($filepath . "../../classes/subjecttopics.php");
include_once($filepath . "../../helpers/format.php");


$_subject_topic = new SubjectTopic();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // print_r($_POST['id_subject_topic']);

    if (isset($_POST['id_subject_topic'])) {
        if (is_array($_POST['id_subject_topic'])) {
            $id = Format::validationArray($_POST['id_subject_topic']);
        } else if (is_numeric($_POST['id_subject_topic'])) {
            $id = Format::validation($_POST['id_subject_topic']);
        }

        try {
            $delete_subject_topic =  $_subject_topic->delete_subject_topic($id);
            if ($delete_subject_topic) {

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["delete" => "success", "subject_id" => $id]);
            }
        } catch (mysqli_sql_exception $ex) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["delete" => "fail", "message" => "Không thể xoá vì \"hàng dữ liệu\" liên kết với dữ liệu \"chủ để môn học\"" . $ex->getMessage()]);
        }
        
    }
}
