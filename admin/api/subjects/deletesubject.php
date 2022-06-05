<?php

namespace Api;

use Helpers\Format;
use Classes\Subject;
use Library\Session;
use mysqli_sql_exception;

// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
include_once($filepath . "../../classes/subjects.php");
include_once($filepath . "../../helpers/format.php");


$_subject = new Subject();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id_subject'])) {
        if (is_array($_POST['id_subject'])) {
            $id = Format::validationArray($_POST['id_subject']);
        } else if (is_numeric($_POST['id_subject'])) {
            $id = Format::validation($_POST['id_subject']);
        }

        try {
            $delete_subject =  $_subject->delete_subject($id);
            if ($delete_subject) {

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["delete" => "success", "subject_id" => $id]);
            }
        } catch (mysqli_sql_exception $ex) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["delete" => "fail", "message" => "Không thể xoá vì \"hàng dữ liệu\" liên kết với dữ liệu \"chủ để môn học\""]);
        }
        
    }
}
