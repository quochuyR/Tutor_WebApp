<?php

namespace Classes;

use Library\Database;
use Helpers\Format;

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/database.php");
// include_once($filepath . "../../classes/paginator.php");

// include_once($filepath."../../helpers/format.php");

class blogpage
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
    public function insertblog(string $title, string $nameimage, string $content, string $kind, int $status)
    {
        $statustext = "true";
        if($status === 0) {
            $statustext = "false";
        }
        $query = "INSERT INTO `blogs`(`id`, `time`, `kind`, `title`, `content`, `nameimage`, `status`) VALUES (NULL,CURRENT_TIMESTAMP(),?,?,?,?,$statustext)";

        $result = $this->db->p_statement($query, "ssss", [$kind, $title, $content, $nameimage]);
    }

    //cập nhật trạng thái đã duyệt liên hệ này hay chưa
    public function updateblogstatus(int $id,int $status)
    {
        $query = "UPDATE `blogs` SET `status`= ? WHERE `id` = ?";
        $statusA = 1;
        if($status == 1){
            $statusA = 0;
        }

        $result = $this->db->p_statement($query, "ii", [$statusA, $id]);
    }

    //truy danh sách thông tin liên hiện
    public function queryAllBlogs()
    {
        $query  = "SELECT * FROM `blogs`";
        $result = $this->db->select($query);
        return $result;
    }

    //truy danh sách thông tin liên hiện
    public function select($id)
    {
        $query  = "SELECT * FROM `blogs` where `id` = $id";
        $result = $this->db->select($query);
        return $result->fetch_array();
    }

    //thể loại bài Viết
    //Thêm thể loại bài Viết
    function insertKindPost($kind){
        $query = "INSERT INTO `kindpost`(`id`, `kindname`) VALUES (null,?)";

        $result = $this->db->p_statement($query, "s", [$kind]);
    }
    //select table kindpost
    function selectAllKind(){
        $query  = "SELECT * FROM `kindpost`";
        $result = $this->db->select($query);
        return $result;
    }
}
