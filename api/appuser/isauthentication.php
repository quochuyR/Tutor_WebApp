<?php

namespace Ajax;

use Exception;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");

// include_once $filepath . "../../classes/notifications.php";

// include_once($filepath . "../../helpers/format.php");


    try {
        if (!Session::checkRoles(['user', 'tutor'])) {
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(["isAuthentication" => false]);
            // header("location:../../pages/errors/404");
        }
            
            else{
                header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(["isAuthentication" => true]);
            }
        
    } catch (Exception $ex) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array("get_notification" => "fail", "errors" => $ex->getMessage(), "message" => "Có lỗi xãy ra"));
    }
