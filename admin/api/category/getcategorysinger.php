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
    $id = $_POST['id'];
    $result = $blog->selectKind($id);
    header('Content-Type: application/json; charset=utf-8');

    echo  json_encode($result->fetch_assoc());

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
