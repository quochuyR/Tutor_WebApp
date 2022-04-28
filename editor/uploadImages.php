<?php

namespace Ajax;

?>


<?php
if (isset($_FILES["upload"]["name"])) {
   // print_r($_FILES["upload"]["tmp_name"]);
   $file_name = $_FILES['upload']['name'];
   $file_size = $_FILES['upload']['size'];
   $file_tmp = $_FILES['upload']['tmp_name'];
   $file_type = $_FILES['upload']['type'];
   $tmp = explode('.', $_FILES['upload']['name']);
   $file_ext = strtolower(end($tmp));

   $new_img_name = bin2hex(openssl_random_pseudo_bytes(10)) . '.' . $file_ext;

   $extensions = array("jpeg", "jpg", "png");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "Phần mở rộng của file không phù hợp, vui lòng chọn JPEG hoặc PNG file.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Khích thước file nhỏ hơn hoặc bằng 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "images/" . $new_img_name);
      $url = "../editor/images/" . $new_img_name;
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(["fileName" => $new_img_name, 'uploaded' => 1, 'url' => $url]);
   } else {
      print_r($errors);
   }
}

?>