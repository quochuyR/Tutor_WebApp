<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Day 
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
        $query = "SELECT  * FROM `days`; ";

        $result = $this->db->select($query);
        return $result;
    }

}