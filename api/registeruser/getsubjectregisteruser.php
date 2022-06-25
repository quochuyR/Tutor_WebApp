<?php

namespace Ajax;

use Helpers\Format;
use Classes\SubjectTopic;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once $filepath . "../../classes/subjecttopics.php";

// include_once($filepath . "../../helpers/format.php");


$_subject_topic = new SubjectTopic();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['userId']) && !empty($_POST['userId']))
    && (isset($_POST['status']) && is_numeric($_POST['status']))) {

        $userId = Format::validation($_POST["userId"]);
        $status = Format::validation($_POST["status"]);
        $get_subject_topic = $_subject_topic->getTopic_registerUser_ByStatus(Session::get("tutorId"), $userId, $status);
        if ($get_subject_topic) {

?>
            <option value="0">-- Môn học --</option>
            <?php
            while ($subject_topic = $get_subject_topic->fetch_assoc()) {
            ?>
                <option class="<?= $subject_topic["approval"] === 1 ? "text-info" : "text-secondary"  ?>" value="<?= $subject_topic["id"] ?>"><?= $subject_topic["topicName"] ?></option>

<?php }
        }
    }
}
