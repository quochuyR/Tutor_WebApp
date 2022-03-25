<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class DayOfWeek 
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
        $query = "SELECT  * FROM `dayofweeks`; ";

        $result = $this->db->select($query);
        return $result;
    }

    public function GetDayOfWeek_TutoringSchedule($tutorId, $status)
    {
        $query = "SELECT DISTINCT `dayofweeks`.`id`, `dayofweeks`.`day` 
        FROM ((`scheduletutors` INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`registeredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `dayofweeks`.`id` ASC;";        
        
        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

    public function GetByTutorId($tutorId, $status)
    {
        $query = "SELECT DISTINCT `dayofweeks`.`id`,  `dayofweeks`.`day`
        FROM `teachingtimes` INNER JOIN `dayofweeks` ON `teachingtimes`.`dayofweekId` = `dayofweeks`.`id`
        WHERE `teachingtimes`.`tutorId` = ? AND `teachingtimes`.`status` = ?
        ORDER BY `dayofweeks`.`id` ASC;";        
        
        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

}