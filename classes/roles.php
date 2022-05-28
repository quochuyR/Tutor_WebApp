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

     /**
     * Hàm có nhiệm vụ lấy thông tin quyền
     * @return object thông tin quyền
     */
    public function getAll(): object
    {
        $query = "SELECT `approles`.`name` FROM `approles`;";

        $result = $this->db->select($query);
        return $result;
    }

}