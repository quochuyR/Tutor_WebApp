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
$table = 'blogs';

try {
    $blog =  new blogpage();
    $id = $_POST['id'];
    foreach ($id as $value) {
        $result = $blog->deleteArticle($value);
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
