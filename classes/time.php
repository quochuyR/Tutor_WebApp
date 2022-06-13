<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Time 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thời gian
     * @return object thông tin thời gian
     */
    public function getAll(): object
    {
        $query = "SELECT * FROM `times` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thời gian lịch dạy gia sư
     * @param string $tutorId id gia sư
     * @param string $status trạng thái gia sư đã duyệt hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object thông tin thời gian lịch dạy gia sư
     */
    public function getTimes_TutoringSchedule($tutorId, $status)
    {
        $query = "SELECT DISTINCT `times`.`id`, `times`.`time`
        FROM ((`scheduletutors` INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `times`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin thời gian lịch dạy người dùng
     * @param string $userId id người dùng
     * @param string $status trạng thái gia sư đã duyệt hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object thông tin thời gian lịch dạy người dùng
     */
    public function getTimes_UserSchedule($userId, $status)
    {
        $query = "SELECT `times`.`id`, `times`.`time`
        FROM ((`scheduletutors` INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`userId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `times`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$userId, $status]);

        return $results ? $results : false;
    }
}
