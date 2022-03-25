<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class AppUser 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function getInfoByUserId($userId)
    {
        $query = "SELECT  `appusers`.`id`, `appusers`.`username`, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`phonenumber`,  `appusers`.`sex`, `appusers`.`job`, `appusers`.`address`,  `appusers`.`email`,  `appusers`.`imagepath`
        FROM  `appusers` 
        WHERE `appusers`.`id` = ?;";

        $result = $this->db->p_statement($query, "s", [$userId]);
        return $result;
    }

}