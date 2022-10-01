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




$title = "Tên bài viết";
include "../inc/header.php";
?>

<!-- start header post  -->
<section id="post-header" class="post-header text-center">
    <!-- <img src="https://wallpaperaccess.com/full/5163201.jpg" alt=""> -->
    <div class="image" data-aos="fade-down" data-aos-duration="3000"></div>
    <h1></h1>
</section>
<!-- end header post  -->
<!-- start body page  -->
<section id="post-body" class="container-fluid col-12 col-md-8 col-lg-8">
    <div id="post-body-content" class="post-body-content"></div>
    <div id="post-body-author" class="post-body-author text-end">
        <p>Được đăng vào ngày: <i><span id="post-body-author-time"></span></i></p>
    </div>
    <div class="lienquan">
        <h3><span>Bài viết liên quan</span></h3>
        <div class="post-new col-12 col-md-6">
            <a href="#">
                <img src="https://i.pinimg.com/736x/0c/26/42/0c26420099a513e1a2c163801e76aada.jpg" alt="Tên bài báo">
            </a>
            <a href="#">
                <h5>Tên bài báo mới nhất Tên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhất</h5>
            </a>
        </div>

    </div>
</section>

<!-- bootstrap 4 -->
<!-- Smooth Scrolling  -->
<!-- <script src="js/scroll.js"></script> -->

<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>