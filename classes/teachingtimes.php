<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class TeachingTime 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function insertTeachingTime($tutorId, $dayofweekId, $timeId)
    {
        $query = "INSERT INTO `teachingtimes` 
        VALUES (NULL, ?, ?, ?, b'0')";

        $result = $this->db->p_statement($query, "sii", [$tutorId, $dayofweekId, $timeId]);
        return $result ? $result : false;
    }

    public function getAll($tutorId, $dayofweekId, $dayId)
    {
        $query = "SELECT `teachingtimes`.`dayofweekId`, `times`.`time`, `days`.`dayname`
        FROM ((`times` INNER JOIN `days` on `days`.`id` = `times`.`dayId`)
              INNER JOIN `teachingtimes` ON `teachingtimes`.`timeId` = `times`.`id`)
        WHERE `teachingtimes`.`tutorId` = ? and `teachingtimes`.`dayofweekId` = ?
        AND `times`.`dayId` = ? AND `teachingtimes`.`status` = ?";

        $result = $this->db->p_statement($query, "siii", [$tutorId, $dayofweekId, $dayId, 0]);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    public function getByTutorId($tutorId, $dayofweekId, $status)
    {
        $query = "SELECT `times`.`id`,  `times`.`time` 
        FROM `teachingtimes` INNER JOIN `times` ON `teachingtimes`.`timeId` = `times`.`id`
        WHERE `teachingtimes`.`tutorId` = ? AND `teachingtimes`.`dayofweekId` = ? AND `teachingtimes`.`status` = ?;";

        $result = $this->db->p_statement($query, "sii", [$tutorId, $dayofweekId, $status]);
        return $result;
    }

    public function updateStatusDayAndTime($tutorId, $dayofweekId, $timeId, $dayofweekId_prev, $timeId_prev)
    {
       
        $query = "CALL update_schedule(?,?,?,?,?);";

        $result = $this->db->p_statement($query, "siiii", [$tutorId, $dayofweekId, $timeId, $dayofweekId_prev, $timeId_prev]);
        return $result;
    }

    

}