<?php

namespace Ajax;

use Classes\AppUser;
use Helpers\Format;
use Library\Session;

// $filepath = realpath(dirname(__FILE__, 2));
require_once(__DIR__ . "../../../vendor/autoload.php");

// include_once $filepath . "../../lib/session.php";
// if (!Session::checkRoles(['tutor'])) {
//     header("location:../pages/errors/404");
// }
// include_once $filepath . "../../classes/appusers.php";

// include_once $filepath . "../../helpers/format.php";

$_app_user = new AppUser();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['value']) && !empty($_POST['value']))
    && (isset($_POST['column']) && !empty($_POST['column']))) {


        $value = Format::validation($_POST["value"]);
        $column = Format::validation($_POST["column"]);
        $hasValue = $_app_user->check_column_unique($column, $value);
        if ($hasValue) {

            $has_unique = $hasValue->fetch_assoc()["has_unique"];
            if($has_unique > 0){
               echo 'false';
            }
            else{
                echo 'true';
            }
            

        }
    }
}
