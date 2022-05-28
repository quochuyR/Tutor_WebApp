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
    
    /**
     * Hàm có nhiệm vụ lấy thông tin buổi học (sáng, chiều, tối)
     * @return object thông tin buổi (sáng, chiều, tối)
     */
    public function getAll(): object
    {
        $query = "SELECT  * FROM `days`; ";

        $result = $this->db->select($query);
        return $result;
    }

}