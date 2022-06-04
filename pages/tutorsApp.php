<?php

namespace Views;

use Classes\AppUser, Library\Session, Helpers\Util;
use Helpers\Format;

include_once "../classes/appusers.php";
include_once "../lib/session.php";
include_once "../helpers/format.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);


$_user = new AppUser();
if (isset($_POST['introduction']) != '') {
    $Content = strip_tags(stripslashes($_POST['introduction']));
} else {

    $Content ="";

}
$selector=" SELECT * FROM  tutors INNER JOIN appusers ON appusers.id = tutors.userId WHERE tutors.userId = " . Session::get('userId');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cdn tinymce 6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.3/tinymce.min.js" integrity="sha512-DB4Mu+YChAdaLiuKCybPULuNSoFBZ2flD9vURt7PgU/7pUDnwgZEO+M89GjBLvK9v/NaixpswQtQRPSMRQwYIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jquery cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- code use tinymce  -->
    <script>
        tinymce.init({
            selector: 'textarea', // change this value according to your HTML
            menubar: "",

        });
    </script>

</head>

<body>
    
    <form method="POST" action>
        <div class="container">
            <div class="row">
                <?php
            //   print_r($_POST);
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST) && !empty($_POST)) {
                       if ( (isset($_POST["email"]) && !empty($_POST["email"]))
                        && (isset($_POST["lastname"]) && !empty($_POST["lastname"]))
                        && (isset($_POST["firstname"]) && !empty($_POST["firstname"]))
                        && (isset($_POST["phonenumber"]) && !empty($_POST["phonenumber"]))
                        && (isset($_POST["gioitinh"]) && is_numeric($_POST["gioitinh"]))
                        && (isset($_POST["address"]) && !empty($_POST["address"]))
                        && (isset($_POST["job"]) && !empty($_POST["job"]))
                        && (isset($_POST["dateofbirth"]) && !empty($_POST["dateofbirth"])))
                     
                        {
                            // print_r($_POST); 
                        
                        $email = Format::validation($_POST["email"]);
                        $last_name = Format::validation($_POST["lastname"]);
                        $first_name = Format::validation($_POST["firstname"]);
                        $sex = Format::validation($_POST["gioitinh"]);
                        $phonenumber = Format::validation($_POST["phonenumber"]);
                        $date_of_birth = Format::validation($_POST["dateofbirth"]);
                        $address = Format::validation($_POST["address"]);
                        $job = Format::validation($_POST["job"]);
                        
                        $get_info_user = $_user->update_user_appuser(Session::get("userId"), $email, $last_name, $first_name,  $sex, $phonenumber, $date_of_birth, $address, $job);
                
                        if ($get_info_user ) {
                           
                            }
                        }
                    }
                } 
            
                
                $get_info_user = $_user->getInfoByUserId(Session::get("userId"));
                if ($get_info_user) :

                    while ($person = $get_info_user->fetch_assoc()) :

                ?>
                        <div class="col-3 bg-success text-center p-3">
                            <img src="<?= Util::getCurrentURL() . "/../public/" . $person["imagepath"]; ?>" class="rounded-circle" alt="hình đại diện" style="width:200px; height:200px" value="<?php echo $person['imagepath'] ?>">
                            <div>
                                <h3><?php echo $person['lastname'] . " " . $person['firstname'] ?></h3>
                                <h5><?php echo " ID:" . $person['username'] ?></h5>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="username" class="form-label">Họ </label>
                                    <input type="text" class="text-muted form-control" name="lastname" id="lastname" placeholder="Họ" value="<?php echo $person['lastname']  ?>">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="username" class="form-label">Tên</label>
                                    <input type="text" class="text-muted form-control" name="firstname" id="firstname" placeholder="Tên" value="<?php echo $person['firstname'] ?>">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="text-muted form-control" name="phonenumber" id="phonenumber" placeholder="số điện thoại" value="<?php echo $person['phonenumber'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                <label for="job" class="form-label">Công việc</label>
                                <input type="job" class="text-muted form-control" id="job" name="job" placeholder="job" value="<?php echo $person['job'] ?>">
                               </div>
                               <div class="col-6">
                               <label for="dateofbirth" class="form-label">Ngày sinh</label>
                                <input type="date" class="text-muted form-control" id="dateofbirth" name="dateofbirth" placeholder="dateofbirth" value="<?php echo $person['dateofbirth'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-5 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="text-muted form-control" id="email" name="email" placeholder="Email" value="<?php echo $person['email'] ?>">
                                </div>
                                <div class="col-5 mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="text-muted form-control" id="address" name="address" placeholder="Địa chỉ" value="<?php echo $person['address'] ?>">
                                </div>
                                <div class="col-2 mb-3">
                                    <div class="form">
                                        <label class="form-check-label" for="radio-nam">Giới tính</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gioitinh" id="radio-nam" value="1"<?php if ($person['sex'] == 1) {echo 'checked';} ?>>
                                        <label class="form-check-label" for="radio-nam">
                                            Nam
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input " type="radio" name="gioitinh" id="radio-nu" value="0"<?php if ($person['sex'] == 0) {echo 'checked';} ?>>
                                        <label class="form-check-label" for="radio-nu">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 ">

                                    <textarea id="textarea" placeholder="Giới thiệu bản thân" name="introduction" id="introduction" <?php echo $Content ?>></textarea>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 text-center mt-3">
                                    <!-- link tại trang mặt định lấy giá trị $_GET  -->
                                    <input type="submit" class="btn btn-success btn-inline" name="submit" value="Cập nhật ">
                                    <!-- link qua trang đăng kí làm gia sư -->
                                    <a href="http://localhost/Tutor_WebApp/pages/tutor_registration_form" class="btn btn-primary " name="dangki">Đăng kí làm gia sư</a>
                                </div>
                            </div>
                        </div>

                <?php endwhile;
                endif; ?>
            </div>
        </div>

        </div>
    </form>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>