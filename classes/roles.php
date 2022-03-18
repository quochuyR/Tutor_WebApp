<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Roles 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function getTutorByUserId($userId)
    {
        $query = "SELECT `tutors`.`id` FROM `tutors` WHERE `tutors`.`userId` = ?;";

        $result = $this->db->p_statement($query, "s", [$userId]);
        return $result;
    }

}