<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\TeachingTime;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once($filepath . "../../classes/teachingtimes.php");
// include_once($filepath . "../../helpers/format.php");


$_teaching_time = new TeachingTime();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['dayofweek']) && is_numeric($_POST['dayofweek'])) {
        try {
            $dayofweek = Format::validation($_POST['dayofweek']);


            $get_teaching_time =  $_teaching_time->getByTutorId(Session::get("tutorId"), $dayofweek, 0);


            if ($get_teaching_time) {
?>
                <option value="0">-- Buổi học --</option>

                <?php

                while ($time = $get_teaching_time->fetch_assoc()) {
                ?>

                    <option value="<?= $time["id"] ?>"><?= $time["time"] ?> </option>
                    </option>
<?php
                }
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        }
    }
}
