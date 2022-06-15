<?php

namespace Helpers;

class UploadFile
{
    public static function upload($name, $upload_directory, $file_extensions_allowed = array("jpeg", "jpg", "png"), $limit_size = 2097152)
    {
        if (isset($_FILES[$name]["name"])) {
            // print_r($_FILES["upload"]["tmp_name"]);
            $file_name = $_FILES[$name]['name'];
            $file_size = $_FILES[$name]['size'];
            $file_tmp = $_FILES[$name]['tmp_name'];
            $file_type = $_FILES[$name]['type'];
            $tmp = explode('.', $_FILES[$name]['name']);
            $file_ext = strtolower(end($tmp));

            $new_img_name = bin2hex(openssl_random_pseudo_bytes(10)) . '.' . $file_ext;

            $extensions = $file_extensions_allowed;

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Phần mở rộng của file không phù hợp, vui lòng chọn JPEG hoặc PNG file.";
            }

            if ($file_size > $limit_size) {
                $errors[] = "Khích thước file nhỏ hơn hoặc bằng " . ($limit_size/1048576) . " MB";
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, $upload_directory . $new_img_name);        
               
               return array("fileName" => $new_img_name, 'uploaded' => 1);
                exit();

            } else {
                print_r($errors);
                return false;
                exit();

            }

        }
    }
}
