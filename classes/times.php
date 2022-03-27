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

    public function getAll()
    {
        $query = "SELECT * FROM `times` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTimes_TutoringSchedule($tutorId, $status)
    {
        $query = "SELECT `times`.`id`, `times`.`time`
        FROM ((`scheduletutors` INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `times`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

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
