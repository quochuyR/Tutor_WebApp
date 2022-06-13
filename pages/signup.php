<?php

namespace Pages;

use Classes\AdminLogin;
use Library\Session;

require_once(__DIR__ . "../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));
// include_once $filepath . "../../classes/adminlogin.php";
// include_once $filepath . "../../lib/session.php";
Session::init();
// include_once $filepath . "../../helpers/utilities.php";
// include_once $filepath . "../../helpers/format.php";

$login = new AdminLogin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
}


$title = "Đăng ký";

            $nav_tutor_active = "active";
            include "../inc/header.php";
            ?>

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
                                            <div class="input-group">
                                                <label for="username" class="form-label">Tài khoản</label>
                                                <input class="input--style-5" type="text" id="username" name="username">
                                            </div>
                                        </div>
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

                                    <div>
                                        <button class="btn-sign-up btn btn--radius-2 btn--red" type="submit">Tạo tài khoản</button>
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                    </session>
                </div>

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
                            email: true,
                            remote: {
                                url: "../api/validation/checkunique",
                                type: "post",
                                data: {
                                    value: function() {
                                        return $("#email").val();
                                    },
                                    column: function() {
                                        return 'email';
                                    }
                                },
                            },
                        },
                        "phone": {
                            required: true,
                            phoneVI: true,
                            rangelength: [10, 10],
                            remote: {
                                url: "../api/validation/checkunique",
                                type: "post",
                                data: {
                                    value: function() {
                                        return $("#phone_number").val();
                                    },
                                    column: function() {
                                        return 'phonenumber';
                                    }
                                },
                            },
                        },
                        "username": {
                            required: true,
                            minlength: 5,
                            remote: {
                                url: "../api/validation/checkunique",
                                type: "post",
                                data: {
                                    value: function() {
                                        return $("#username").val();
                                    },
                                    column: function() {
                                        return 'username';
                                    }
                                },
                            },
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
                        first_name: "Họ từ 5 kí tự trở lên.",
                        last_name: "Tên từ 2 kí tự trở lên.",
                        email: {
                            required: "Vui lòng nhập email.",
                            email: "Email sai định dạng",
                            remote: $.validator.format("{0} đã tồn tại.")
                        },
                        phone: {
                            required: "Vui lòng nhập số điện thoại",
                            phoneVI: "Đầu số điện thoại phải là 03, 05, 07, 08, 09.",
                            rangelength: "Số điện thoại phải đủ 10 kí tự.",
                            remote: $.validator.format("{0} đã tồn tại.")
                        },
                        username: {
                            required: "Vui lòng nhập tài khoản.",
                            minlength: "Phải nhập từ 5 kí tự trở lên.",
                            remote: $.validator.format("{0} đã tồn tại.")
                        },
                        pass: "Mật khẩu phải chứa từ 10 kí tự, ít nhất 1 kí tự viết hoa, thường, số, kí tự đặc biệt.",
                        repass: "Mật khẩu nhập lại không đúng.",

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
                        url: "../api/appuser/signup",
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
                            if (data.sign_up === "successful") {
                                Toastify({
                                    text: "Đăng kí tài khoản thành công!",
                                    duration: 5000,
                                    close: true,
                                    gravity: "top", // `top` or `bottom`
                                    position: "right", // `left`, `center` or `right`
                                    stopOnFocus: true, // Prevents dismissing of toast on hover
                                    style: {
                                        background: "linear-gradient(to right, #56C596, #7BE495)",
                                    },
                                    onClick: function() {} // Callback after click
                                }).showToast();
                            }

                            if (data.sign_up === "fail")
                                {
                                    Toastify({
                                    text: "Tài khoản đã tồn tại!",
                                    duration: 5000,
                                    close: true,
                                    gravity: "top", // `top` or `bottom`
                                    position: "right", // `left`, `center` or `right`
                                    stopOnFocus: true, // Prevents dismissing of toast on hover
                                    style: {
                                        background: "linear-gradient(to right, #F082AC, #b91c1c)",
                                    },
                                    onClick: function() {} // Callback after click
                                }).showToast();
                                }

                                console.log(data);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr, error, status, "Lỗi");
                        }
                    });
                });

            });
        })();
    </script>

<?php include '../inc/footer.php' ?>
