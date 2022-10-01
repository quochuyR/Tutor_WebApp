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

    $result = $news->selectBlog($title_url);

    if ($result !== false) {
        $postArray = array();
        $postArray = $result->fetch_array();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($postArray);
    } else {
        $postArray = array();
        $postArray = `["id"=>-1,"redirect" => "../pages/errors/404"]`;
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($postArray);
    }

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
