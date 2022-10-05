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
    $position_show = $_POST['position_show'];
    $about = $_POST['about'];
    $name = $_POST["name"];
    $status = $_POST["status"];
    $id_parent = $_POST["id_parent"];
    $name_url = $_POST["name_url"];

    $result = $blog->insertcategory($name, $status, $id_parent, $position_show, $about, $name_url);

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
