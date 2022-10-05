<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\Contact;
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

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 'id'),
    array('db' => 'kindname', 'dt' => 'kindname'),
    array('db' => 'status', 'dt' => 'status'),
    array('db' => 'id_parent', 'dt' => 'id_parent'),
    array('db' => 'position_show', 'dt' => 'position_show')
);

// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db' => DB_NAME,
    'host' => DB_HOST,
);




try {
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
