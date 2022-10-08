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

    $position = $_POST['position'];
    // $position = "";
    $result = $news->selectCategoryByPosition($position);

    if ($result->num_rows > 0) {
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arr);
    } else {
        echo false;
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
