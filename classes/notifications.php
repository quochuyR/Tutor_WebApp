<?php

namespace Classes;

use Library\Database;
use Helpers\Format;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");


class Notification
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Hàm có nhiệm vụ lấy thông báo dựa vào id người dùng
     * @param string $tutorId id gia sư
     * @param int $limit giới hạn số lượng thông báo (mặc định là 2)
     * @param int $offset bắt đầu từ thông báo nào (hàng trong csdl. Mặc định là 2)
     * @return object | bool thông tin của thông báo (SenderId, notification_subject, ...)
     */

    public function getNotificationByUserId(string $userId, int $limit = 2, int $offset = 0): object | bool
    {
        $userId = Format::validation($userId);

        $userId = mysqli_real_escape_string($this->db->link, $userId);

        if (!empty($userId)) {
            $query = "SELECT `notifications`.`SenderId`, `notifications`.`notification_subject`, `notifications`.`notification_text`, `notifications`.`notification_link`
            FROM `notifications` 
            WHERE `notifications`.`userID` = ?
            ORDER BY `notifications`.`id` DESC 
            LIMIT ? OFFSET ?;";

            $result = $this->db->p_statement($query, "sii", [$userId, $limit, $offset]);
            return $result;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin người dùng dựa vào id người gửi
     * @param string $senderId id của người gửi (senderId cũng là userId)
     * @return object | bool thông tin của người dùng (firstname, lastname, ...)
     */
    public function getUserBySenderId(string $senderId): object | bool
    {
        $senderId = Format::validation($senderId);

        $senderId = mysqli_real_escape_string($this->db->link, $senderId);

        if (!empty($senderId)) {
            $query = "SELECT DISTINCT  `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`imagepath`
            FROM `appusers` 
            WHERE `appusers`.`id` = ?;";

            $result = $this->db->p_statement($query, "s", [$senderId]);
            return $result;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ đếm số lượng thông báo chưa đọc dựa vào id người dùng
     * @param string $UserId id người dùng
     * @return object | bool số lượng thông báo
     */
    public function count_unread_notifications(string $UserId): object|bool
    {
        $UserId = Format::validation($UserId);

        $UserId = mysqli_real_escape_string($this->db->link, $UserId);

        if (!empty($UserId)) {
            $query = "SELECT COUNT(*) AS count_unread
            FROM `notifications`
            WHERE `notifications`.`userID` = ? AND `notifications`.`notificationstatus` = ?;";

            $result = $this->db->p_statement($query, "si", [$UserId, 0]);
            return $result;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ đặt thông báo là đã đọc rồi
     * @param string $UserId id người dùng
     * @return object | bool số lượng thông báo đã đọc rồi
     */
    public function set_read_notifications(string $UserId): object | bool
    {
        $UserId = Format::validation($UserId);

        $UserId = mysqli_real_escape_string($this->db->link, $UserId);

        if (!empty($UserId)) {
            $query = "UPDATE `notifications` 
            SET `notifications`.`notificationstatus` = ?
            WHERE `notifications`.`userID` = ? AND `notifications`.`notificationstatus` = ?;";

            $result = $this->db->p_statement($query, "isi", [1, $UserId, 0]);
            return $result;
        }

        return false;
    }
}
