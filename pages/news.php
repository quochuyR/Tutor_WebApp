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




$title = "Tin tức";
$news_active = "active";
include "../inc/header.php";
?>

<!-- start body page  -->
<section id="news_page" class="container  p-sm-3">

    <div class="row">
        <div class="col-12 col-md-8 row">
            <!-- feature_news -->
            <div class="col-12 col-md-12 Bm_" id="feature_news">
            </div>
            <!-- feature_1 -->
            <div id="block_feature_1">
            </div>
            <!-- theme_news -->

            <div class="col-12  col-md-12 row mt-3" id="theme_news">
            </div>
            <!--  /Traffic -->
            <div class="clearfix"></div>
        </div>

        <div class="col-12 col-md-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#Tab_news">Mới nhất</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#Tab_hots">Đọc nhiều</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="Tab_news">
                    <!-- hot_news -->
                    <div id="hot_news">
                        <!-- <div class="tab-news">
                            <a href="#">
                                <img src="https://i.pinimg.com/736x/0c/26/42/0c26420099a513e1a2c163801e76aada.jpg" alt="Tên bài báo">
                            </a>
                            <a href="#">
                                <h5>Tên bài báo mới nhất Tên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhấtTên bài báo mới nhất</h5>
                            </a>
                            <p>Thời gian <small>11 phút trước</small></p>
                        </div> -->

                        <div class="tab-news">
                            <a href="#">
                                <img src="https://i.pinimg.com/736x/0c/26/42/0c26420099a513e1a2c163801e76aada.jpg" alt="Tên bài báo">
                            </a>
                            <a href="#">
                                <h5>Tên bài báo mới nhất báo mới nhấtt báo mới nhấtt báo mới nhấtt báo mới nhất</h5>
                            </a>
                            <p>Thời gian <small>11 phút trước</small></p>
                        </div>
                    </div>
                    <!-- hot_news_1 -->

                    <!-- tab-news-catogory -->
                    <h4 class="tab-news-catogory"><span id="name_hot_news_1">VIDEO</span></h4>

                    <div id="hot_news_1">
                        <div class="block-news-catogory">
                            <!-- bài báo 1  -->
                            <div class="category-post">
                                <a href="#">
                                    <img src="https://i.pinimg.com/736x/0c/26/42/0c26420099a513e1a2c163801e76aada.jpg" alt="Tên bài báo">
                                </a>
                                <a href="#">
                                    <h5>Tên bài báo mới nhất báo mới nhấtt báo mới nhấtt báo mới nhấtt báo mới nhất</h5>
                                </a>
                                <p class="text-end">Thời gian <small>11 phút trước</small></p>
                            </div>
                            <!-- bài báo 2  -->
                            <div class="category-post">
                                <a href="#">
                                    <img src="https://i.pinimg.com/736x/0c/26/42/0c26420099a513e1a2c163801e76aada.jpg" alt="Tên bài báo">
                                </a>
                                <a href="#">
                                    <h5>Tên bài báo mới nhất báo mới nhấtt báo mới nhấtt báo mới nhấtt báo mới nhất</h5>
                                </a>
                                <p class="text-end">Thời gian <small>11 phút trước</small></p>
                            </div>
                        </div>
                    </div>
                    <!-- hot_news_2 -->
                    <h4 class="tab-news-catogory"><span id="name_hot_news_2">PHOTO</span></h4>
                    <div id="hot_news_2">
                        <div class="block-news-catogory">
                        </div>
                    </div>

                    <h4 class="tab-news-catogory"><span>TIN TỨC MỚI</span></h4>
                    <div class="block-news-catogory">
                    </div>
                </div>
                <div class="tab-pane container fade" id="Tab_hots">
                    <p>Bài viết đọc nhiều</p>
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
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