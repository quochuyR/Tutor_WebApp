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


$title = "Tin tức";
$news_active = "active";
include "../inc/header.php";
?>

<!-- start body page  -->
<section id="news_page" class="container   p-sm-5">
    <div class="row ">
        <div class="col-12 col-md-8 row">
            <div class="col-12  col-md-12 row mt-3" id="theme_news_readmore">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <h4 class="category_post col-12 col-md-12 mt-3 mb-4">GIA SƯ NỔI BẬT</h4>
            <?php
            $result = $db_homepageTutor->getFilter($_POST);
            $_POST["limit"] = 5;
            $tutorOfTopic =  $TTtopic->getFilter($_POST);

            if ($tutorOfTopic->data) :
                while ($result = $tutorOfTopic->data->fetch_assoc()) :
            ?>
                    <?php
                    $subjectTutors = "";
                    $subjectList = $subjects->getByTutorId($result['id']);
                    while ($resultSB = $subjectList->fetch_assoc()) :
                        $subjectTutors .= $resultSB['subject'] . ', ';
                    endwhile;

                    $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                    ?>
                    <div class="col-10" style="margin: auto; ">
                        <div class="tab-news" style="border-bottom: 0px;" onclick=" location.href ='  <?= "tutor_details?id=" . $result['id']  ?> '; ">
                            <img src="<?= (isset($result['imagepath']) ? Util::getCurrentURL(1) . "public/" .  $result['imagepath'] : Util::getCurrentURL(1) . "public/images/avatar5-default.jpg") ?>">
                            <a href="<?= "tutor_details?id=" . $result['id']?>"><h5><?= $result['lastname'] . ' ' . $result['firstname'] ?></h5></a>

                            <p>Môn học: <small class="description product limit-text"><?= $subjectTutors ?></small></p>
                            
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            ?>
            <div class="card" style="width: 18rem; margin: auto;">
                <img src="https://pinetree.vn/wp-content/uploads/2020/10/1766-1568x1254.jpg" class="card-img-top" alt="Hỗ trợ">
                <div class="card-body ">
                    <p class="card-text">Liên hệ hỗ trợ qua thư</p>
                    <div class="text-end">
                        <a href="contact" class="btn btn-primary ">Liên hệ</a>
                    </div>
                </div>
            </div>
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