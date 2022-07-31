<?php

namespace Api;

use Exception;
use Classes\Tutor;
use Helpers\Format;
use Library\Session;

//  \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));
require_once($filepath . "/vendor/autoload.php");

// include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
// include_once($filepath . "../../classes/tutors.php");
// include_once($filepath . "../../helpers/format.php");


$_tutor = new Tutor();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
    ) {
        try {
            $id = Format::validation($_POST['id']);


            $update_tutor =  $_tutor->update_approval_tutor($id);


            if ($update_tutor) {
                $message = $update_tutor->fetch_assoc();
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["update" => "success", "message" => array_keys($message)[0]]);
            }
        } catch (Exception $ex) {;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["error" => $ex->getMessage()]);
        }
    }
}
