<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\blogpage;
use Vendor\SSP;


$filepath  = realpath(dirname(__FILE__, 4));

require_once($filepath . "/vendor/autoload.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../../pages/errors/404");
}
Session::init();
include_once $filepath . "/config/config.php";
include_once $filepath . "/admin/vendor/ssp.class.php";
// DB table to use
$table = 'kindpost';

try {
    $blog =  new blogpage();
    $title_url = $_POST['title_url'];
    $result = $blog->getArticle($title_url);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($result->fetch_assoc());
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
