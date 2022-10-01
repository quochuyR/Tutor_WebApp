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
        isset($_POST['title'])
        && isset($_POST['nameimage'])
        && isset($_POST['content'])
    ) {
        $kind = Format::validation($_POST["kind"]);
        $title = Format::validation($_POST["title"]);
        $title_url = Format::validation($_POST["title_url"]);
        $content = ($_POST["content"]);
        $nameimage = Format::validation($_POST["nameimage"]);
        $status = Format::validation($_POST["status"]);
        $result = $blog->countArticle();
        $title_url .= $result->fetch_assoc()['NUMBER'];
        
        $blog->insertArticle($title, $title_url,  $nameimage,  $content,  $kind, $status);
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
