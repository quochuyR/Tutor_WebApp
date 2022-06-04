<?php

namespace Classes;

use Library\Database;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class db_adminhomepage
{
    private $db;

    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    // truy vấn hình ảnh hiển thị ở trang chủ 
    function ListImgPost()
    {
        $select = "SELECT * FROM calrouselimg ORDER BY uploaded_on DESC";
        $result = $this->db->select($select);
        return $result;
    }

    function UploadImage()
    {
        $statusMsg = '';
        // File upload path
        $targetDir = "../assets/images/carousel/";
        $fileName = '';
        $targetFilePath = '';
        $fileType = '';

        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $name = $_POST["title"];
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload fiile to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $insert = $this->db->select("INSERT into calrouselimg (id, name, file_name, uploaded_on, status) VALUES (NULL,'" . $name . "','" . $fileName . "', NOW(),0)");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    $insert = '';
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        $statusMsg = '';
        $fileName = '';
        $targetFilePath = '';
        $fileType = '';
    }
}
#truy van thong tin gia su

#demo link danh gia cua phu huynh
