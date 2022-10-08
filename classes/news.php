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
    public function selectAritcleByCategory($category)
    {
        $queryCategoryStatus = "SELECT `kindname` FROM `kindpost` WHERE `kindname` = ? AND `status` = true";
        $statusCategory  = $this->db->p_statement($queryCategoryStatus, "s", [$category]);
        if ($statusCategory->num_rows > 0) {
            $query  = "SELECT * FROM `blogs` where `kind` = ? AND `status` = true ORDER BY `time` DESC";
            $result = $this->db->p_statement($query, "s", [$category]);
            return $result;
        }
        return false;
    }

    //truy danh sách thông tin liên hiện
    public function selectAritcleByTime()
    {
        $query  = "SELECT * FROM `blogs` where `status` = true ORDER BY `time` DESC";
        $result = $this->db->select($query);
        return $result;
    }

    //select table kindpost
    public function selectallcategories()
    {
        $query  = "SELECT *, (SELECT COUNT(title)  FROM `blogs` WHERE `kind` = kindname) AS NUMBER FROM `kindpost` WHERE `status` = true  ORDER BY `id` DESC";
        $result = $this->db->select($query);
        return $result;
    }

    //truy vấn theo vị trí
    public function selectCategoryByPosition($position)
    {
        $query  = "SELECT *, (SELECT COUNT(title)  FROM `blogs` WHERE `kind` = kindname) AS NUMBER FROM `kindpost` WHERE `status` = true AND `position_show` = ? ORDER BY `id` DESC";
        $result = $this->db->p_statement($query, "s", [$position]);
        return $result;
    }

    //truy vấn theo vị trí
    public function selectCategoryByUrl($kindnameUrl)
    {
        $query  = "SELECT `kindname` FROM `kindpost` WHERE `kindname_url` = ?";
        $result = $this->db->p_statement($query, "s", [$kindnameUrl]);
        return $result;
    }

    public function selectAritcleByCategory_url($kindnameurl)
    {
        $query = "SELECT * FROM `blogs` where `kind` = (SELECT `kindname` FROM `kindpost` WHERE `kindname_url` = ? AND `status` = true) AND `status` = true ORDER BY `time` DESC";
        $result = $this->db->p_statement($query, "s", [$kindnameurl]);
        return $result;
    }
}
