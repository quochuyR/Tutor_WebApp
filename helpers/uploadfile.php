<?php

namespace Helpers;

class UploadFile
{
    public static function upload($name, $upload_directory, $file_extensions_allowed = array("jpeg", "jpg", "png"), $limit_size = 2097152)
    {
        if (isset($_FILES[$name]["name"])) {
            // print_r($_FILES["upload"]["tmp_name"]);
            $extensions = $file_extensions_allowed;
            $new_images = array();
            $errors = array();
            $countfiles = count($_FILES[$name]['name']);
            print_r($_FILES[$name]['name']);
            for ($i = 0; $i < $countfiles; $i++) {
                $file_name = $_FILES[$name]['name'][$i];
                $file_size = $_FILES[$name]['size'][$i];
                $file_tmp = $_FILES[$name]['tmp_name'][$i];
                $file_type = $_FILES[$name]['type'][$i];
                $tmp = explode('.', $_FILES[$name]['name'][$i]);
                $file_ext = strtolower(end($tmp));

                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "Phần mở rộng của file không phù hợp, vui lòng chọn JPEG hoặc PNG file.";
                    return false;
                }
    
                if ($file_size > $limit_size) {
                    $errors[] = "Khích thước file nhỏ hơn hoặc bằng " . ($limit_size / 1048576) . " MB";
                    return false;
                }

                $new_img_name = bin2hex(openssl_random_pseudo_bytes(10)) . '.' . $file_ext;
                move_uploaded_file($file_tmp, $upload_directory . $new_img_name);
                $new_images[] = $new_img_name;
            }

           

            if (empty($errors) == true) {

                return array("fileName" => $new_images, 'uploaded' => 1);
                
            } else {
                print_r($errors);
                return false;
                
            }
        }
    }
}
