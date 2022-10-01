<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\blogpage;
use Vendor\SSP;


// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

require_once($filepath . "/vendor/autoload.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../../pages/errors/404");
}
Session::init();
include_once $filepath . "/config/config.php";
try {
    $blog =  new blogpage();


    $id = $_POST['id'];
    $about = $_POST['about'];
    $name = $_POST["name"];
    $status = $_POST["status"];
    $id_parent = $_POST["id_parent"];
    $position_show  = $_POST["position_show"];

    $result = $blog->updatecategory($id, $name, $status, $id_parent,$position_show, $about);

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
