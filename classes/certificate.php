<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Certificate 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }
    
    /**
     * Hàm có nhiệm vụ lấy thông tin bằng cấp
     * @return object thông tin bằng cấp
     */
    public function getAll(): object
    {
        $query = "SELECT  * FROM `certificates`; ";

        $result = $this->db->select($query);
        return $result;
    }

    public function insert_certificates($tutorId, $upload_image)
    {
        $imageCount = count($upload_image);
        // create a array with question marks
        $imageMarks = array_fill(0, $imageCount, '(NULL, ?, ?)');
        $imageMarks =  implode(",", $imageMarks);
        $dataTypes = str_repeat('ss', $imageCount);

        $vars = array();

        foreach ($upload_image as $image) {
            array_push($vars, $tutorId, $image);
        }
        // print_r($subjectMarks);
        // print_r($dataTypes);
        $query = "INSERT INTO `certificates` (`id`, `tutorId`, `image`) VALUES $imageMarks;";

        // print_r($query);
        $result = $this->db->p_statement($query, $dataTypes, $vars);
        return $result;
    }

}