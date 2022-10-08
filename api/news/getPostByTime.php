<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\News;

$filepath  = realpath(dirname(__FILE__));
require_once(__DIR__ . "../../../vendor/autoload.php");
Session::init();

try {
    $news = new news();
    $result = $news->selectAritcleByTime();

    if ($result->num_rows > 0) {
        $postArray = array();
        while($row = $result->fetch_assoc()){
            array_push($postArray, $row);
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($postArray);
    }
    else{
        echo false;
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
