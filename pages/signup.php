<?php

namespace Pages;

use Classes\AdminLogin;
use Library\Session;
use Helpers\Flash;

require_once(__DIR__ . "../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));
// include_once $filepath . "../../classes/adminlogin.php";
// include_once $filepath . "../../lib/session.php";
Session::init();
// include_once $filepath . "../../helpers/utilities.php";
// include_once $filepath . "../../helpers/format.php";

$login = new AdminLogin();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    [$errors, $inputs] = \Helpers\Flash::session_flash('errors', 'inputs');
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
                        <?php Flash::flash(); ?>
                        <form class="pt-3 px-md-4" id="signup-form">
                            <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />

                            <div class="form-row mb-md-5">
                                <!-- <div class="name">Họ và tên</div> -->
                                <div class="value">
                                    <div class="row row-space">
                                        <div class="col-6">
                                            <label for="first_name" class=" form-label">Họ</label>
                                            <div class="input-group-desc ">
                                                <input class="input--style-5" type="text" id="last_name" name="first_name">

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-desc">
                                                <label for="last_name" class="form-label">Tên</label>
                                                <input class="input--style-5" type="text" id="first_name" name="last_name">

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
   
</script>

<?php include '../inc/footer.php' ?>