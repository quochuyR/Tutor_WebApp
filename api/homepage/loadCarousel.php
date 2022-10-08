<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\HomePage_;

$filepath  = realpath(dirname(__FILE__));
require_once(__DIR__ . "../../../vendor/autoload.php");
Session::init();

try {
    $homepage_ = new HomePage_();

    $result = $homepage_->loadImageToArrayCarousel();

    if ($result !== false) {
        $postArray = array();
        // $postArray = $result->fetch_array();
        while ($row = $result->fetch_assoc()) {
            array_push($postArray, $row);
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($postArray);
    } else {
        echo false;
    }

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
