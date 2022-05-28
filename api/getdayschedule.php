<?php

namespace Ajax;

use Helpers\Format;
use Classes\DayOfWeek;
use Library\Session;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['tutor'])) {
    header("location:../pages/errors/404");
}
include_once $filepath . "../../classes/dayofweeks.php";

include_once($filepath . "../../helpers/format.php");


$_day_of_week = new DayOfWeek();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action']) && $_POST['action'] === "getDay") {


        $get_day_of_week = $_day_of_week->GetByTutorId(Session::get("tutorId"), 0);
        if ($get_day_of_week) {

?>
            <option value="-1">-- Thứ --</option>
            <?php
            while ($day_of_week = $get_day_of_week->fetch_assoc()) {
            ?>
                <option value="<?= $day_of_week["id"] ?>"><?= $day_of_week["day"] ?></option>

<?php }
        }
    }
}
