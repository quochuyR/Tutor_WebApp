<?php

namespace Classes;

use Library\Database;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class HomePage
{
    private $db;

    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }
    #truy van carousel image

    function loadImageToArray()
    {
        $ListImgUrl = array();
        // truy vấn danh sach carousel image 
        $select = "SELECT * FROM calrouselimg WHERE status = 1 ORDER BY uploaded_on desc";
        // $select = "SELECT * FROM `calrouselimg` ";
        //dùng update thay vì dùng select bởi vì select khi truy vấn nếu không có phần tử nào sẽ trả về kiểu bool xảy ra cảnh báo lỗi
        $imgList = $this->db->select($select);
        // print_r($imgList);
        if (($imgList->num_rows) > 0) {
            while ($item = $imgList->fetch_assoc()) {
                $obj = [
                    "id" => $item["id"], "name" => $item["name"],
                    "file_name" => $item["file_name"], "uploaded_on" => $item["uploaded_on"],
                    "status" => $item["status"], "imageURL" => '../public/images/carousel/' . $item["file_name"]
                ];
                //sau này đường dẫn này có thể bị sai
                array_push($ListImgUrl, $obj);
            }
        }
        return $ListImgUrl;
    }
    // truy vấn bài viết hiển thị ở trang chủ 
    function showPost()
    {
        $select = "SELECT id, title, content, status, time, kind FROM admin_post WHERE status = 1 ORDER BY time DESC";
        $result = $this->db->select($select);
        return $result;
    }


    function ShowImgCarousel($arrayImg)
    {
        $count = 1; // đếm để cái đầu tiên sẽ có trạng thái acitve
        $countItem = 1; // đến số lượng item vì giới hạn chỉ có 3 hình được hiển thị
        foreach ($arrayImg as $item) {
            if ($countItem == 4) {
                break;
            } else {
                $countItem++;
            }
            if ($count == 1) {
                $count++;
            ?>
                <div class="carousel-item active">
                    <img src="<?php echo $item['imageURL']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                </div>
            <?php
            } else {
            ?>
                <div class="carousel-item ">
                    <img src="<?php echo $item['imageURL']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                </div>
<?php
            }
        }
    }

}
#truy van thong tin gia su

#demo link danh gia cua phu huynh
$link = 'https://pdp.edu.vn/wp-content/uploads/2021/01/hinh-anh-girl-xinh-toc-ngan-de-thuong.jpg';


    