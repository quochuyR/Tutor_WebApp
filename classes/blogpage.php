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

    //select Post
    public function getArticle($title_url)
    {
        $query  = "SELECT * FROM `blogs` WHERE `title_url` =  ?";
        $result = $this->db->p_statement($query, 's', [$title_url]);
        return $result;
    }

    //delete blog
    function deleteArticle($id)
    {
        $query = "DELETE FROM `blogs` WHERE `id` = ?";

        $result = $this->db->p_statement($query, "i", [$id]);
    }


    //cập nhật trạng thái đã duyệt liên hệ này hay chưa
    public function changeStatusArticle($id, $status)
    {
        $query = "UPDATE `blogs` SET `status`= ? WHERE `id` = ?";
        $result = $this->db->p_statement($query, "ii", [$status, $id]);
    }

    //get Status Article
    function getStatusArticle($id)
    {
        $query  = "SELECT status FROM `blogs` where `id` = ?";
        $result = $this->db->p_statement($query, "i", [$id]);
        return $result;
    }

    public function insertArticle(string $title, string $title_url, string $nameimage, string $content, string $kind, int $status)
    {
        $statustext = "true";
        if ($status === 0) {
            $statustext = "false";
        }
        $query = "INSERT INTO `blogs`(`id`, `time`, `kind`, `title`, `title_url`, `content`, `nameimage`, `status`) VALUES (NULL,CURRENT_TIMESTAMP(),?,?,?,?,?,$statustext)";

        $result = $this->db->p_statement($query, "sssss", [$kind, $title, $title_url, $content, $nameimage]);
    }

    public function upldateArticle(int $id, string $title, string $title_url, string $nameimage, string $content, string $kind, int $status)
    {
        $statustext = "true";
        if ($status === 0) {
            $statustext = "false";
        }
        $query = "UPDATE `blogs` SET `time`= CURRENT_TIMESTAMP(),`kind`= ?,`title`= ?,`title_url`= ?,`content`= ?,`nameimage`= ?,`status`= $statustext WHERE `id` = ?";

        $result = $this->db->p_statement($query, "sssssi", [$kind, $title, $title_url, $content, $nameimage, $id]);
    }

    public function countArticle()
    {
        $query = "SELECT COUNT(`id`) AS NUMBER FROM `blogs`";
        $result = $this->db->select($query);
        return $result;
    }

    //select table kindpost
    function selectAllKind()
    {
        $query  = "SELECT * FROM `kindpost`";
        $result = $this->db->select($query);
        return $result;
    }

    //truy danh sách thông tin liên hiện
    public function selectKind($id) //chua chay duoc
    {
        $query  = "SELECT *FROM `kindpost` where `id` = $id";
        $result = $this->db->select($query);
        return $result;
    }

    public function getStatusCategory($id)
    {
        $query  = "SELECT status FROM `kindpost` WHERE `id` = ?";
        $result = $this->db->p_statement($query, "i", [$id]);
        return $result;
    }

    //change category status

    public function changeStatusCategory($id, $status)
    {
        $query  = "UPDATE `kindpost` SET `status`=? WHERE `id` = ?";
        $result = $this->db->p_statement($query, "ii", [$status, $id]);
    }

    // delete deleteCategory
    function deleteCategory($id)
    {
        $query = "DELETE FROM `kindpost` WHERE `id` = ?";
        $result = $this->db->p_statement($query, "i", [$id]);
    }

    //select table kindpost
    function getallcategory()
    {
        $query  = "SELECT * FROM `kindpost`";
        $result = $this->db->select($query);
        return $result;
    }

    function insertcategory($name, $status, $id_parent, $position_show, $about, $name_url)
    {
        // $status = true;
        // if ($status == 0)
        //     $status = false;
        $query = "INSERT INTO `kindpost`(`id`, `kindname`, `status`, `id_parent`,`position_show`, `about`, `kindname_url`) VALUES (null,?,$status,?,?,?,?)";
        $result = $this->db->p_statement($query, "sssss", [$name, $id_parent, $position_show, $about, $name_url]);
    }

    function updatecategory($id, $name, $status, $id_parent, $position_show, $about, $name_url)
    {
        $query = "UPDATE `kindpost` SET `kindname`= ?,`status`= $status,`id_parent`= ?,`position_show`= ?,`about`= ?, `kindname_url` = ? WHERE `id` = ?";
        $result = $this->db->p_statement($query, "sssssi", [$name, $id_parent, $position_show, $about, $name_url, $id]);
    }
    // count readmost article
    public function create_readmost()
    {
        $query_createReadmost = "INSERT INTO `readmost`(`id`, `count`, `id_blogs`, `title_url_blogs`) VALUES (null,0,(SELECT `id` FROM `blogs` order by `time` DESC LIMIT 1),(SELECT `title_url` FROM `blogs` order by `time` DESC LIMIT 1))";
        $result_create_readmost = $this->db->select($query_createReadmost);
    }
    //update title url
    public function edit_readmost($id, $title_url)
    {
        $query = "UPDATE `readmost` SET `title_url_blogs`=? WHERE `id_blogs`=?";
        $result = $this->db->p_statement($query, "si", [$title_url, $id]);
    }
    // delete read most
    public function deleteReadmost($id_blog)
    {
        $query = "DELETE FROM `readmost` WHERE `id_blogs` = ?";
        $result = $this->db->p_statement($query, "i", [$id_blog]);
    }
    // //count read blog 
    public function countRead($title_url)
    {
        $query_number = "SELECT `count`  FROM `readmost` WHERE `title_url_blogs` = ?";
        $result_number = $this->db->p_statement($query_number, "s", [$title_url]);
        $result_number =  $result_number->fetch_assoc()['count'];
        $result_number = $result_number + 1;
        $query = "UPDATE `readmost` SET `count`=? WHERE  `title_url_blogs` = ?";
        $result = $this->db->p_statement($query, "is", [$result_number, $title_url]);
    }
}
