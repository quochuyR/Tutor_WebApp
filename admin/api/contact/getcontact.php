<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\Contact;

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





try {
    $contact  = new contact();
    $result = $contact->queryAllContact();
    $listcontact = array();
    while ($rs = $result->fetch_assoc()) {
        array_push($listcontact, $rs);
    }
    // header('Content-Type: application/json; charset=utf-8');
    echo json_encode($listcontact);
} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
