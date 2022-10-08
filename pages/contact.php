<?php

namespace Views;

use Classes\HomePage;
use Classes\Tutor, Classes\Subject, Classes\SubjectTopic, Library\Session;
use Helpers\Util;

require_once(__DIR__ . "../../vendor/autoload.php");

// include_once "../classes/topics.php";
// include_once "../classes/subjecttopics.php";
// include_once "../classes/tutors.php";
// include_once "../classes/subjects.php";
// include_once "../classes/paginator.php";
// include_once "../lib/session.php";
// include_once("../helpers/utilities.php");


Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);


$db_homepage  = new HomePage();
$db_homepageTutor = new tutor();
$TTtopic = new Tutor();
$subjects = new Subject();

$contact = "active";
$title = "Liên hệ";
include "../inc/header.php";
?>

<!-- start body page  -->
<section class="contact-section d-flex justify-content-around" data-aos="zoom-in" data-aos-duration="500">
    <div class="container p-3">
        <div class="container">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1200">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">GIA SƯ DTHU EDUCATION LÀ GÌ?</h4>
                                <p>Đây là một trong những trang web tìm kiếm gia sư trực tuyến tốt nhất hiện nay. <a href=""><b>DTHU EDUCATION</b></a> có các môn học đa dạng từ lớp 6 đến 12. Đội ngũ <a href="">gia sư chất lượng</a> đáp ứng đủ nhu cầu học tập của cả học sinh và những người đã đi làm muốn trau dồi thêm kiến thức.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1200">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="card-title">HỌC TẬP TỐT HƠN</h4>
                                <p>Bạn là một bậc phụ huynh mong muốn con mình có thể đạt được kết quả học tập tốt nhất nhưng không biết liên hệ gia sư ở đâu? Thì <b>Gia sư DTHU EDUCATION</b> chính là giải pháp tối ưu cho bạn.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->

                <div class="card card-detail mt-3" data-aos="zoom-in-down" data-aos-duration="2000">
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col-lg-12">
                                <form class="form-wrapper">
                                    <h2 class="text-center">Liên hệ</h2>
                                    <input type="hidden" id="token_homepage" value="<?= Session::get("csrf_token") ?>" />
                                    <p class="fade" id="REMOTE_ADDR"><?php echo $_SERVER['REMOTE_ADDR'] ?></p>
                                    <div class="mb-3">
                                        <label for="fullname" class="fw-600 form-label">Họ và tên</label>
                                        <input type="text" id="fullnamecontact" class="form-control" name="name" placeholder="Họ và tên">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="fw-600 form-label">Email</label>
                                        <input type="email" id="emailcontact" class="form-control" name="email" placeholder="Địa chỉ email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="fw-600 form-label">Số điện thoại</label>
                                        <input type="text" id="phonecontact" class="form-control" name="phone" placeholder="Số điện thoại">
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="fw-600 form-label">Nội dung</label>
                                        <textarea class="form-control" id="contentcontact" rows="4" placeholder="Nội dung"></textarea>
                                    </div>
                                    <div class="validate-input m-b-20 d-flex justify-content-center mb-3">
                                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6Lfw6MkeAAAAADmRhvf__Nri7XkH3dVGsR9v64lM"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" id="sentcontact" class="fw-600 btn btn-tutor-detail m-1 p-1">Gửi tư vấn <i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end page-wrapper -->
        </div>
        <!-- start toast notification sent request success  -->
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">

                    <strong class="me-auto"><i class="fab fa-facebook-messenger"></i> <b>Tin nhắn</b></strong>
                    <small><b>Vừa xong</b></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" id="closetoast"></button>
                </div>
                <div class="toast-body">
                    <p class="toast-content">

                    </p>
                </div>
            </div>
        </div>
        <!-- end toast notification sent request success  -->
    </div><!-- end container -->

</section>

<!-- bootstrap 4 -->
<!-- Smooth Scrolling  -->
<!-- <sript src="js/scroll.js"></sript> -->

<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>