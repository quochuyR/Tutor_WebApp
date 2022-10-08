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
print_r($_FILES);
try {
    $blog =  new blogpage();
    if (isset($_FILES['file']['name'])) {

        /* Getting file name */
        $filename = $_FILES['file']['name'];
        

        /* Location */
        $location = "../../../public/images/blogpost/" . $filename;
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
        // $imageFileType = strtolower($imageFileType);

        /* Valid extensions */
        $valid_extensions = array("jpg", "jpeg", "png");

        /* Check file extension */
        if (in_array($imageFileType, $valid_extensions)) {
            /* Upload file */
            move_uploaded_file($_FILES['file']['tmp_name'], $location);
        }
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
