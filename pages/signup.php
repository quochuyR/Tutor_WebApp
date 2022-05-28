<?php

namespace Pages;

use Classes\AdminLogin;
use Library\Session;

$filepath = realpath(dirname(__FILE__));
include_once $filepath . "../../classes/adminlogin.php";
include_once $filepath . "../../lib/session.php";
Session::init();
include_once $filepath . "../../helpers/utilities.php";
include_once $filepath . "../../helpers/format.php";

$login = new AdminLogin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
}

?>

<!DOCTYPE html>
<html lang="en">

<?php

$title = "Đăng ký";
include "../inc/head.php";

?>

<body>

    <div class="container-fluid px-0">
        <header class="row g-0 m-0">

            <?php
            $nav_tutor_active = "active";
            include "../inc/header.php";
            ?>

        </header>
        <div id="main" class="container ">
            <section class="ftco-section">
                <div class="row page-wrapper  p-t-45 p-b-50">
                    <div class="col-md-7 col-lg-6 sign-up wrapper wrapper--w790">
                        <div class=" card card-5">

                            <div class="card-body">
                                <form class="pt-3 px-md-4" id="signup-form">
                                <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />

                                    <div class="form-row mb-md-5">
                                        <!-- <div class="name">Họ và tên</div> -->
                                        <div class="value">
                                            <div class="row row-space">
                                                <div class="col-6">
                                                    <label for="first_name" class=" form-label">Họ</label>
                                                    <div class="input-group-desc ">
                                                        <input class="input--style-5" type="text" id="first_name" name="first_name">

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group-desc">
                                                        <label for="last_name" class="form-label">Tên</label>
                                                        <input class="input--style-5" type="text" id="last_name" name="last_name">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-md-5">
                                        <div class="value">
                                            <div class="input-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="input--style-5" type="email" id="email" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-md-5">
                                        <div class="value">
                                            <div class="row row-refine">

                                                <div class="col-12">
                                                    <div class="input-group-desc">
                                                        <label for="phone" class="form-label">Số điện thoại</label>
                                                        <input class="input--style-5" type="text" name="phone" id="phone_number">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-md-5">
                                        <div class="value">
                                            <div class="input-group mb-md-5">
                                                <label for="username" class="form-label">Tài khoản</label>
                                                <input class="input--style-5" type="text" id="username" name="username">
                                            </div>

                                            <div class="form-row mb-md-5">
                                                <div class="value">
                                                    <div class="input-group">
                                                        <label for="pass" class="form-label">Mật khẩu</label>
                                                        <input class="input--style-5" type="password" id="pass" name="pass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mb-md-5">

                                                <div class="value">
                                                    <div class="input-group">
                                                        <label for="repass" class="form-label">Nhập lại mật khẩu</label>
                                                        <input class="input--style-5" type="password" id="repass" name="repass">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-sign-up btn btn--radius-2 btn--red" type="submit">Tạo tài khoản</button>
                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    </session>
                </div>

        </div>

    </div>


    <?php include '../inc/footer.php' ?>



    </div>

    <?php

    include "../inc/script.php"
    ?>

    <script>
        (function() {
            $(document).ready(() => {
                $.validator.addMethod('phoneVI', function(value) {
                    return /^(84|0[3|5|7|8|9])+([0-9]{8})$/.test(value);
                });
                $.validator.addMethod('Password', function(value) {
                    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}$/.test(value);
                });

                $("#signup-form").validate({
                    ignore: [],
                    rules: {
                        "first_name": {
                            required: true,
                            minlength: 5
                        },
                        "last_name": {
                            required: true,
                            minlength: 2
                        },
                        "email": {
                            required: true,
                            email: true
                        },
                        "phone": {
                            required: true,
                            phoneVI: true,
                            rangelength: [10, 10]
                        },
                        "username": {
                            required: true,
                            minlength: 5,
                        },
                        "pass": {
                            required: true,
                            Password: true
                        },
                        "repass": {
                            required: true,
                            minlength: 5,
                            equalTo: '#pass'
                        },
                    },
                    messages: {
                        "first_name": "Họ từ 5 kí tự trở lên.",
                        "last_name": "Tên từ 2 kí tự trở lên.",
                        "email": "Email sai định dạng.",
                        "phone": "Số điện thoại phải đủ 10 kí tự.",
                        "username": "Phải nhập từ 5 kí tự trở lên.",
                        "pass": "Mật khẩu phải chứa từ 10 kí tự, ít nhất 1 kí tự viết hoa, thường, số, kí tự đặc biệt.",
                        "repass": "Mật khẩu nhập lại không đúng.",

                    },
                    errorPlacement: function(label, element) {
                        label.insertAfter($(element).parent()).addClass('mb-2 text-danger');
                    },
                    success: function(label, element) {


                    },
                    submitHandler: (form) => {
                        // submitRegisterForm();
                        // form.submit();
                        console.log("1huy2k")
                    }
                });

                $("#signup-form").on('submit', (e) => {
                    e.preventDefault();
                    let $form = $(e.target);

                    if (!$form.valid()) return false;
                    let token = $("#token").val();
                    let first_name = $("#first_name").val();
                    let last_name = $("#last_name").val();
                    let email = $("#email").val();
                    let phone_number = $("#phone_number").val();
                    let username = $("#username").val();
                    let password = $("#pass").val();
                  
                    console.log(first_name, last_name, email, phone_number, username, password)
                    $.ajax({
                        type: "post",
                        url: "../api/signup",
                        data: {
                            token,
                            first_name,
                            last_name,
                            email,
                            phone_number,
                            username,
                            password

                        },
                        cache: false,
                        success: function(data) {

                            console.log(data)
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr, error, status, "Lỗi");
                        }
                    });
                });

            });
        })();
    </script>

</body>

</html>