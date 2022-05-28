<?php

namespace Classes;

use Library\Database;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/database.php";
// include_once($filepath."../../helpers/format.php");

class DayOfWeek
{
    private $db;
    // private $fm;
    public function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    /**
     * Hàm có nhiệm vụ đếm tổng số lượng thứ
     * @return object số lượng thứ
     */
    public function getAll(): object
    {
        $query = "SELECT  * FROM `dayofweeks`;";

        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thứ dựa vào id gia sư
     * @param string $tutorId id gia sư
     * @param int $status trạng thái duyệt gia sư hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object | bool thông tin thứ
     */
    public function GetByTutorId(string $tutorId, int $status): object | bool
    {
        $query = "SELECT DISTINCT `dayofweeks`.`id`,  `dayofweeks`.`day`
        FROM `teachingtimes` INNER JOIN `dayofweeks` ON `teachingtimes`.`dayofweekId` = `dayofweeks`.`id`
        WHERE `teachingtimes`.`tutorId` = ? AND `teachingtimes`.`status` = ?
        ORDER BY `dayofweeks`.`id` ASC;";

        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thứ dựa vào id gia sư, theo lịch dạy gia sư
     * @param string $tutorId id gia sư
     * @param int $status trạng thái duyệt gia sư hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object | bool thông tin thứ
     */
    public function GetDayOfWeek_TutoringSchedule(string $tutorId, int $status)
    {
        $query = "SELECT DISTINCT `dayofweeks`.`id`, `dayofweeks`.`day`
        FROM ((`scheduletutors` INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`registeredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `dayofweeks`.`id` ASC;";

        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thứ dựa vào id người dùng, dựa theo lịch học người dùng
     * @param string $userId id người dùng
     * @param int $status trạng thái duyệt gia sư duyệt người dùng hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object | bool thông tin thứ
     */
    public function GetDayOfWeek_UserSchedule(string $userId, int $status)
    {
        $query = "SELECT DISTINCT `dayofweeks`.`id`, `dayofweeks`.`day`
        FROM ((`scheduletutors` INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`registeredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`userId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `dayofweeks`.`id` ASC;";

        $results = $this->db->p_statement($query, "si", [$userId, $status]);

        return $results ? $results : false;
    }
}
