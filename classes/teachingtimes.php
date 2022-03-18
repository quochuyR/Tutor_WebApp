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

    public function getAll($tutorId, $dayofweekId, $dayId)
    {
        $query = "SELECT `teachingtimes`.`dayofweekId`, `times`.`time`, `days`.`dayname`
        FROM ((`times` INNER JOIN `days` on `days`.`id` = `times`.`dayId`)
              INNER JOIN `teachingtimes` ON `teachingtimes`.`timeId` = `times`.`id`)
        WHERE `teachingtimes`.`tutorId` = '$tutorId' and `teachingtimes`.`dayofweekId` = $dayofweekId
        AND `times`.`dayId` = $dayId";

        $result = $this->db->select($query);
        return $result;
    }

}