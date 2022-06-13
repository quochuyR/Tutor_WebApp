<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Topic 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

     /**
     * Hàm có nhiệm vụ lấy thông tin chủ đề môn học
     * @return object thông tin chủ đề môn học
     */
    public function getAll(): object
    {
        $query = "SELECT * FROM `subjecttopics` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }
}
