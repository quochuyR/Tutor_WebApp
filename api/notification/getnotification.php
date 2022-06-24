<?php

namespace Ajax;

use Helpers\Format;
use Classes\Notification;
use Exception;
use Helpers\Sanitization;
use Helpers\Util;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/session.php");
if (!Session::checkRoles(['user', 'tutor'])) {
    header("location:../pages/errors/404");
}
// include_once $filepath . "../../classes/notifications.php";

// include_once($filepath . "../../helpers/format.php");

$_notification = new Notification();
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $output = '';
        if (isset($_POST["view"]) && !empty($_POST["view"])) {
            $_notification->set_read_notifications(Session::get("userId"));
        }

            // $input = array(
            //     'num_notification' => $_POST["num_notification"],
            //     'offset' => $_POST["offset"]
            // );

            // $field = array(
            //     'num_notification' => "int",
            //     'offset' => "int"
            // );
            // $input_sanitization = Sanitization::sanitize($input, $field);
            $count_unread = $_notification->count_unread_notifications(Session::get("userId"))->fetch_assoc()["count_unread"];


            // $limit = $count_unread ? $count_unread : $input_sanitization["num_notification"];
            $fetch_notification = $_notification->getNotificationByUserId(Session::get("userId"), 0, $count_unread);
            if ($fetch_notification->num_rows > 0) {


                while ($notifi = $fetch_notification->fetch_assoc()) {
                    $sender = $_notification->getUserBySenderId($notifi["SenderId"])->fetch_assoc();

                    $output .= '<a href="' . (Util::getCurrentURL(2) . "pages/" . $notifi["notification_link"]) . '" class="d-flex list-group-item list-group-item-action border-0 text-small">
                <div class="my-auto me-2">
                    <img src="' . (isset($sender["imagepath"]) ? Util::getCurrentURL(2) . "public/" . $sender["imagepath"] : Util::getCurrentURL(2) . "public/images/avatar5-default.jpg") . '" class="avatar-notification avatar-sm-notification  ">
                </div>
                <div>
                    <b>' . $sender["firstname"] . '</b>' . $notifi["notification_text"] . '
                </div>

            </a>';
                }
            } else {
               
                // $output .= '<a href="#" class="d-flex list-group-item list-group-item-action border-0 text-small">Không có thông báo</a>';
            }

            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count_unread ? $count_unread : 0
            );

            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode($data);
        
    } catch (Exception $ex) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array("get_notification" => "fail", "errors" => $ex->getMessage(), "message" => "Có lỗi xãy ra"));
    }
}
