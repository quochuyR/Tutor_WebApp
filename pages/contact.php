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
<section class="container w-75 bg-light contact-section d-flex justify-content-around" style="border-left: 6px solid #D3DEDC; border-right: 6px solid #D3DEDC;">
    <div class="p-3 w-80">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h4>Who we are</h4>
                    <p>Markedia is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
                </div>

                <div class="col-lg-6">
                    <h4>How we help?</h4>
                    <p>If you&rsquo;d like to write for us, <a href="#">advertise with us</a> or just say hello, fill out the form below and we’ll get back to you as soon as possible.</p>
                </div>
            </div><!-- end row -->

            <hr class="invis">

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-wrapper">
                        <h2 class="text-center">Liên hệ</h2>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" id="fullnamecontact" class="form-control" placeholder="Họ và tên">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="emailcontact" class="form-control" placeholder="Địa chỉ email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" id="phonecontact" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="contentcontact" placeholder="Nội dung"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="sentcontact" class="btn btn-tutor-detail m-1 p-1">Gửi <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- end page-wrapper -->
        <!-- start toast notification sent request success  -->
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">

                    <strong class="me-auto"><i class="fab fa-facebook-messenger"></i> <b>Tin nhắn</b></strong>
                    <small>Vừa xong</small>
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
<!-- <script src="js/scroll.js"></script> -->

<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>