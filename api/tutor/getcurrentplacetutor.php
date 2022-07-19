<?php

namespace Ajax;

use Classes\Tutor;
use Helpers\Format;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
// if (!Session::checkRoles(['tutor', 'user'])) {
//     header("location:../../pages/errors/404");
// }
Session::init();
// include_once $filepath . "../../classes/subjecttopics.php";
// include_once $filepath . "../../classes/subjects.php";

// include_once $filepath . "../../helpers/format.php";

$_tutor = new Tutor();
// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {

        $get_provinces = $_tutor->get_current_place_tutor($_POST);
        $provinces = [];
        array_push($provinces, ["id" => "all", "text" => "-- Tất cả --"]);
        if ($get_provinces) {


            while ($result = $get_provinces->fetch_assoc()) {
                array_push($provinces, ["id" => $result["currentplace"], "text" => $result["currentplace"]]);
            }
        }


        header('Content-Type: application/json; charset=utf-8');
        // echo json_encode([ "results" => [["text" => "group 1", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]], ["text" => "group 2", "children" => [["id" => 0,"text"=> "Nguyễn Quốc HUy"], ["id" => 2,"text" => 21]]]]  ]);
        echo json_encode($provinces);
    }
}
