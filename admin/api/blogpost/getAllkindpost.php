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
// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../../pages/errors/404");
}
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../helpers/format.php");
Session::init();
include_once $filepath . "/config/config.php";
// include_once($filepath . "../../classes/subjects.php");
// include_once($filepath . "../../helpers/format.php");
include_once $filepath . "/admin/vendor/ssp.class.php";
// DB table to use
$table = 'kindpost';

try {
    $blog =  new blogpage();
    $result = $blog->selectAllKind();
    $AllKind = Array();
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $kindname = $row['kindname'];
        $AllKind[] = array("id" => $id,
                        "kindname" => $kindname);
    }
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($AllKind);
    // echo json_encode($contact);
    // echo json_encode();
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
