<?php

namespace Classes;

use Library\Database;
use Helpers\Format;

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/database.php");
// include_once($filepath . "../../classes/paginator.php");

// include_once($filepath."../../helpers/format.php");

class news
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

    public function selectBlog($title_url)
    {
        $query  = "SELECT * FROM `blogs` where `title_url` = ? AND `status`  = true";
        $result = $this->db->p_statement($query, "s", [$title_url]);
        if (!empty($result->num_rows) && $result->num_rows === 1) {
            return $result;
        }
        return false;
    }

    //truy danh sách thông tin liên hiện
    public function select($id)
    {
        $query  = "SELECT * FROM `blogs` where `id` = ? AND `status` == true";
        $result = $this->db->p_statement($query, "i", [$id]);
        return $result->fetch_array();
    }

    public
    
    //select table kindpost
    function selectAllKind()
    {
        $query  = "SELECT * FROM `kindpost`";
        $result = $this->db->select($query);
        return $result;
    }
}
