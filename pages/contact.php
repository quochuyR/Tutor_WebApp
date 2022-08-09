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

$arrayImg = array();

$arrayImg = $db_homepage->loadImageToArray();

$contact = "active";
$title = "Liên hệ";
include "../inc/header.php";
?>

<section class="container">
    <div class="p-3">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h4>Who we are</h4>
                    <p>Markedia is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
                </div>

                <div class="col-lg-6">
                    <h4>How we help?</h4>
                    <p>If you’d like to write for us, <a href="#">advertise with us</a> or just say hello, fill out the form below and we’ll get back to you as soon as possible.</p>
                </div>
            </div><!-- end row -->

            <hr class="invis">

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-wrapper">
                        <h4>Contact form</h4>
                        <input type="text" class="form-control" placeholder="Your name">
                        <input type="text" class="form-control" placeholder="Email address">
                        <input type="text" class="form-control" placeholder="Phone">
                        <input type="text" class="form-control" placeholder="Subject">
                        <textarea class="form-control" placeholder="Your message"></textarea>
                        <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                    </form>
                </div>
            </div>
        </div><!-- end page-wrapper -->
    </div><!-- end container -->
</section>

<!-- bootstrap 4 -->
<!-- Smooth Scrolling  -->
<!-- <script src="js/scroll.js"></script> -->

<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>