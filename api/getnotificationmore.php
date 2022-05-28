<?php

namespace Ajax;

use Helpers\Format;
use Classes\Notification;
use Library\Session;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['user', 'tutor'])) {
    header("location:../pages/errors/404");
}
include_once $filepath . "../../classes/notifications.php";

include_once($filepath . "../../helpers/format.php");


$_notification = new Notification();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ((isset($_POST['numNotification']) && is_numeric($_POST['numNotification']))
    && (isset($_POST['offset']) && is_numeric($_POST['offset']))) {


        $numNotification = Format::validation($_POST["numNotification"]);
        $offset = Format::validation($_POST["offset"]);
        $fetch_notification = $_notification->getNotificationByUserId(Session::get("userId"), $numNotification, $offset);
        if ($fetch_notification) {

            while ($notifi = $fetch_notification->fetch_assoc()) {
                $sender = $_notification->getUserBySenderId($notifi["SenderId"])->fetch_assoc();

?>
                <a href="../pages/<?= htmlspecialchars($notifi["notification_link"]) ?>" class="d-flex list-group-item list-group-item-action border-0 text-small">
                    <div class="my-auto me-2">
                        <img src="../public/<?= $sender["imagepath"] ?>" class="avatar-notification avatar-sm-notification  ">
                    </div>
                    <div>
                        <b><?= $sender["firstname"] ?></b> <?= $notifi["notification_text"] ?>
                    </div>

                </a>

<?php
            }
        }
    }
}
