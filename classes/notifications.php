<?php
namespace Classes;

use Library\Database;
use Helpers\Format;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath."../../lib/database.php");
include_once($filepath."../../helpers/format.php");


class Notification{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getNotificationByUserId($userId)
    {
        $userId = Format::validation($userId);

        $userId = mysqli_real_escape_string($this->db->link, $userId);

        if(!empty($userId)){
            $query = "SELECT `notifications`.`SenderId`, `notifications`.`notification_subject`, `notifications`.`notification_text`
            FROM `notifications` 
            WHERE`notifications`.`userID` = ?;";

            $result = $this->db->p_statement($query, "s", [$userId]);
            return $result;
        }

        return false;
    }

    // Lấy id người gửi
    public function getUserBySenderId($senderId)
    {
        $senderId = Format::validation($senderId);

        $senderId = mysqli_real_escape_string($this->db->link, $senderId);

        if(!empty($senderId)){
            $query = "SELECT DISTINCT  `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`imagepath`
            FROM `appusers` 
            WHERE `appusers`.`id` = ?;";

            $result = $this->db->p_statement($query, "s", [$senderId]);
            return $result;
        }

        return false;
    }

    public function count_unread_notifications($UserId)
    {
        $UserId = Format::validation($UserId);

        $UserId = mysqli_real_escape_string($this->db->link, $UserId);

        if(!empty($UserId)){
            $query = "SELECT COUNT(*) AS count_unread
            FROM `notifications`
            WHERE `notifications`.`userID` = ? AND `notifications`.`notificationstatus` = ?;";

            $result = $this->db->p_statement($query, "si", [$UserId, 0]);
            return $result;
        }

        return false;
    }
    public function set_read_notifications($UserId)
    {
        $UserId = Format::validation($UserId);

        $UserId = mysqli_real_escape_string($this->db->link, $UserId);

        if(!empty($UserId)){
            $query = "UPDATE `notifications` 
            SET `notifications`.`notificationstatus` = ?
            WHERE `notifications`.`userID` = ? AND `notifications`.`notificationstatus` = ?;";

            $result = $this->db->p_statement($query, "isi", [1, $UserId, 0]);
            return $result;
        }

        return false;
    }
}
