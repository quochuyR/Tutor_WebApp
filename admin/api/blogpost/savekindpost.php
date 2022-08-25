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
// include_once $filepath . "/admin/vendor/ssp.class.php";
try {
    $blog =  new blogpage();
    if (
        isset($_POST['kind'])
        && !empty($_POST['kind'])
    ) {
        $kind = $_POST["kind"];
        $blog->insertKindPost($kind);
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
