<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\Contact;
use Vendor\SSP;
use Classes\Blogpage;


// \tutor_webapp
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
    $result = $blog->getallcategory();
    $arr = Array();
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $kindname = $row['kindname'];
        $arr[] = array("id" => $id,
                        "kindname" => $kindname);
    }

    header('Content-Type: application/json; charset=utf-8');

    echo  json_encode($arr);

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
