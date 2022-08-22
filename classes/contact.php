<?php

namespace Classes;

use Library\Database;
use Helpers\Format;

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/database.php");
// include_once($filepath . "../../classes/paginator.php");

// include_once($filepath."../../helpers/format.php");

class contact
{
    private $db;
    private $paginator;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        $this->paginator = new Paginator();
        // $this->fm = new Format();
    }

    //thêm thông tin người liên hệ vào 
    public function insertcontact(string $fullname, string $email, string $phone, string $content)
    {
        $query = "INSERT INTO `contact`(`id`, `time`, `fullname`, `email`, `phone`, `content`, `status`) VALUES (NULL,CURRENT_TIMESTAMP(),?,?,?,?,false)";

        $result = $this->db->p_statement($query, "ssss", [$fullname, $email, $phone, $content]);
    }

    //cập nhật trạng thái đã duyệt liên hệ này hay chưa
    public function updatecontactstatus(int $id,int $status)
    {
        $query = "UPDATE `contact` SET `status`= ? WHERE `id` = ?";
        $statusA = 1;
        if($status == 1){
            $statusA = 0;
        }

        $result = $this->db->p_statement($query, "ii", [$statusA, $id]);
    }

    //truy danh sách thông tin liên hiện
    public function queryAllContact()
    {
        $query  = "SELECT * FROM `contact`";
        $result = $this->db->select($query);
        return $result;
    }

    //truy danh sách thông tin liên hiện
    public function select($id)
    {
        $query  = "SELECT * FROM `contact` where `id` = $id";
        $result = $this->db->select($query);
        return $result->fetch_array();
    }
}
