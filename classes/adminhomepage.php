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
                $insert = $this->db->select("INSERT INTO calrouselimg (id, name, file_name, uploaded_on, status) VALUES (NULL,'" . $name . "','" . $fileName . "', NOW(),0)");
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

        $fileName = '';
        $targetFilePath = '';
        $fileType = '';
    }

    function EidtStatus($id, $status)
    {
        if ($this->CountNumberImages() < 3 || $status == 0) {
            $query = "UPDATE `calrouselimg` SET `uploaded_on`= CURRENT_TIME(),`status`='$status' WHERE id = $id";
            $result = $this->db->update($query);
        }
    }

    function Delete($idDelete)
    {
        $query = "DELETE FROM calrouselimg WHERE id = ?";
        $result = $this->db->p_statement($query, "i", [$idDelete]);
    }

    //count number images have been done show in homepage
    function CountNumberImages()
    {
        // truy vấn danh sach carousel image 
        $select = "SELECT * FROM calrouselimg WHERE status = 1 ORDER BY uploaded_on desc";
        // $select = "SELECT * FROM `calrouselimg` ";
        $imgList = $this->db->update($select);
        // return number image have been done show in homepage
        return $imgList->num_rows;
    }

    function FillPostToTableResult()
    {
        $querySelect = 'SELECT id, title, content, status, time, kind FROM admin_post ORDER BY time DESC';
        $result = $this->db->select($querySelect);
        return $result;
    }

    //truy vấn cơ sở dữ liệu cho post bài viết trong bản
    function FillPostToTable($linkPostpageEdit, $linkPostpageDelete)
    {
        // //đường dẫn dành cho trang web post bài Viết
        // $linkPostpageEdit = '?idEdit=';
        // // dành cho trang chủ
        // $linkPostpageDelete = '?idDelete='; 
        $result = $this->FillPostToTableResult();
        $countNumber = 1;
        if (($result->num_rows) > 0) {
            while ($row = $result->fetch_assoc()) {
?>
                <tr>
                    <th scope="row">
                        <p>
                            <?php echo $countNumber++ ?>
                        </p>
                    </th>
                    <td>
                        <p class="text-start">
                            <?php echo $row['title'] ?>
                        </p>
                    </td>
                    <td>
                        <p>
                            <?php echo $row['time'] ?>
                        </p>
                    </td>
                    <td>
                        <p>
                            <?php echo $row['status'] == 1 ? "Hiển Thị" : "Ẩn" ?>
                        </p>
                    </td>
                    <td>
                        <p>
                            <?php echo $row['kind'] ?>
                        </p>
                    </td>
                    <td>
                        <!-- Đường dẫn này sẽ có thông tin cơ bản của phương thức get 
                     -->
                        <a href="<?php echo $linkPostpageEdit . $row['id'] ?>">Sửa</a>
                    </td>
                    <td class="text-center">
                        <!-- <input class="form-check-input" type="checkbox" value="" id="checkboxPost"> -->
                        <a href="<?php echo $linkPostpageDelete . $row['id']; ?>">Xóa</a>
                    </td>
                </tr>
<?php
            }
        }
    }


    //trang viết bài viết
    function AddPost($query)
    {
        $result = $this->db->update($query);
    }
    //tìm bài viết
    function SearchPost($query)
    {
        $result = $this->db->select($query);
        return $result;
    }
    //xóa bài Viết
    function DeletePost($idDelete)
    {
        $query = "DELETE FROM admin_post WHERE id = $idDelete ";
        $result = $this->db->update($query);
    }
    //lưu lại chỉnh sửa bài viết
    function SaveEditPost($query)
    {
        $result = $this->db->update($query);
    }
}
