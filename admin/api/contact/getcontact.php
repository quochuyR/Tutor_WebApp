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
$table = 'contact';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 'id'),
    array('db' => 'time', 'dt' => 'time'),
    array('db' => 'fullname', 'dt' => 'fullname'),
    array('db' => 'email', 'dt' => 'email'),
    array('db' => 'phone', 'dt' => 'phone'),
    array('db' => 'content', 'dt' => 'content'),
    array('db' => 'status', 'dt' => 'status'),

);

// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db' => DB_NAME,
    'host' => DB_HOST,
);




try {
    // $contact  = new contact();
    // $result = $contact->queryAllContact();
    // $listcontact = array();
    // $count = 1;
    // while ($rs = $result->fetch_assoc()) {
    //     $row = array(
    //         "id" => $count,
    //         "time" => $rs["time"],
    //         "fullname" => $rs["fullname"],
    //         "email" => $rs["email"],
    //         "phone" => $rs["phone"],
    //         "content" => $rs["content"],
    //         "status" => $rs["status"] == 0 ? "Đã xem" : "Chưa xem"
    //     );
    //     array_push($listcontact, $row);
    //     $count++;
    // }
    header('Content-Type: application/json; charset=utf-8');

    // echo json_encode($contact);
    echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));

} catch (Exception $ex) {
    print_r($ex->getMessage());
} finally {
    exit;
}
