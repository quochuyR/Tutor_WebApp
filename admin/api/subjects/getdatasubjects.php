<?php

namespace Api;

// use Helpers\Format;
// use Classes\Subject;
use Library\Session;
use Vendor\SSP;

// \tutor_webapp
$filepath  = realpath(dirname(__FILE__, 4));

include_once($filepath . "../lib/session.php");
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
include_once($filepath . "../../classes/subjects.php");
include_once($filepath . "../../helpers/format.php");
include_once($filepath . "../../admin/vendor/ssp.class.php");
// DB table to use
$table = 'subjects';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => "Id" ),
    array( 'db' => 'subject',  'dt' => "Tên môn học" ),
    
);
 
// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode(SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));

// print_r(SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));
// $_subject = new Subject();
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     if ((isset($_POST['id-subject']) && is_numeric($_POST['id-subject']))
//         && (isset($_POST['subject']) && !empty($_POST['subject']))
//     ) {
//         $id = Format::validation($_POST['id-subject']);
//         $subject_name = Format::validation($_POST['subject']);


// $get_subject =  $_subject->getAll();


// if ($get_subject) {
//     $result = array();
//     while ($row = $get_subject->fetch_assoc()) {
//         $result[] = ["Id" => $row["id"], "Tên môn học" => $row["subject"]];
//     }

//     // header('Content-Type: application/json; charset=utf-8');
// }
//     }
// }
