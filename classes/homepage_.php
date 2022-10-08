<?php

namespace Classes;

use Library\Database;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class HomePage_
{
    private $db;

    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }
    #truy van carousel image

    function loadImageToArrayCarousel()
    {
        $ListImgUrl = array();
        // truy vấn danh sach carousel image 
        $select = "SELECT  `name` as `name_image`, `file_name` FROM `calrouselimg` WHERE `status` = 1 ORDER BY `uploaded_on` desc LIMIT 3";
        // $select = "SELECT * FROM `calrouselimg` ";
        //dùng update thay vì dùng select bởi vì select khi truy vấn nếu không có phần tử nào sẽ trả về kiểu bool xảy ra cảnh báo lỗi
        $imgList = $this->db->select($select);
        // if (($imgList->num_rows) > 0) {
        //     while ($item = $imgList->fetch_assoc()) {
        //         $obj = [
        //             "name_image" => $item["name_image"], "file_name" => $item["file_name"],
        //             "imageURL" => '../public/images/carousel/' . $item["file_name"]
        //         ];
        //         //sau này đường dẫn này có thể bị sai
        //         array_push($ListImgUrl, $obj);
        //     }
        // }
        // return $ListImgUrl;
        return $imgList;
    }
    
    public function loadImageInCarosel(){
        $query = "SELECT  `name` as `name_image`, `file_name` FROM `calrouselimg` WHERE `status` = 1 ORDER BY `uploaded_on` desc LIMIT 3";
        $result = $this->db->select($query);
        print_r($result);
    }
}
#truy van thong tin gia su

#demo link danh gia cua phu huynh
$link = 'https://pdp.edu.vn/wp-content/uploads/2021/01/hinh-anh-girl-xinh-toc-ngan-de-thuong.jpg';


    