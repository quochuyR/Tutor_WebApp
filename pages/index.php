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

$introduction = "active";
$title = "Trang chủ";
include "../inc/header.php";
?>
<!-- carousel silde  -->
<div id="main" class="container-fluid px-0">

    <section>
        <div id="carouselExampleIndicators" class="carousel slide carouselTrangChu" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- nếu sau này không thấy hình thì có thể do lỗi sai đường dẫn   -->
                <?php $db_homepage->ShowImgCarousel($arrayImg); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- bieu tuong chat luong day kem  -->
    <!-- cần chỉnh sửa icon khi thu nhỏ tỉ lệ khung hình -->
    <section class="container">
        <div class="container text-center mt-4">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-12"><img class="rounded-circle" alt="Uy tín" src="https://top1quangnam.com/wp-content/uploads/2021/06/UY-TIN-2.png" width="80" height="80"></div>
                        <div class="col-lg-12 col-12 ml-1 mt-3">
                            <h4>Uy tín</h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-12"><img class="rounded-circle" alt="Tận tâm" src="http://cityhomes.net.vn/wp-content/uploads/2019/06/icon-tan-tam.png" width="80" height="80"></div>
                        <div class="col-lg-12 col-12 ml-1 mt-3">
                            <h4>Tận tâm</h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-lg-12 col-12"><img class="rounded-circle" alt="Chuyên nghiệp" src="https://iweb.tatthanh.com.vn/pic/3/service/images/thiet-ke-website-quang-cao(21).png" width="80" height="80"></div>
                        <div class="col-lg-12 col-12 ml-1 mt-3">
                            <h4>Chuyên nghiệp</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<hr>
    <!-- Lọc trên web -->
    <section class="container">
        <div>
            <h2 class="text-center m-3" >Danh sách gia sư tiêu biểu</h2>
        </div>
        <div class="row justify-content-around">
            <?php
            $result = $db_homepageTutor->getFilter($_POST);
            $_POST["limit"] = 8;
            $tutorOfTopic =  $TTtopic->getFilter($_POST);

            if ($tutorOfTopic->data) :
                while ($result = $tutorOfTopic->data->fetch_assoc()) :
            ?>


                    <div class="col-lg-3 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0">
                        <div class="card card-tutor" onclick=" location.href ='  <?= "tutor_details?id=" . $result['id']  ?> '; ">
                            <div class=" card-img-top img-teacher text-center">
                                <img src=" <?= (isset($result['imagepath']) ? Util::getCurrentURL(1) . "public/" . $result['imagepath'] :  "https://bootdey.com/img/Content/avatar/avatar5.png") ?>" class="rounded" alt="" srcset="">
                            </div>
                            <div class="card-body">
                                <h6 class="font-weight-bold pt-1"><?= $result['lastname'] . ' ' . $result['firstname'] ?></h6>
                                <?php
                                $subjectTutors = "";
                                $subjectList = $subjects->getByTutorId($result['id']);
                                while ($resultSB = $subjectList->fetch_assoc()) :
                                    $subjectTutors .= $resultSB['subject'] . ', ';
                                endwhile;

                                $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                                ?>

                                <div class="text-muted description-intro"><?= $result['teachingarea'] . ' | ' . $subjectTutors ?></div>
                                <div class="text-start description product limit-text">
                                    <?= html_entity_decode($result['introduction']) ?>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-1">
                                    <div class="d-flex flex-row">
                                        <a href="<?= (isset($result['linkfacebook']) ? $result['linkfacebook'] : "") ?>" class="mx-1 social-list-item text-center border-primary text-primary"><i class="mdi mdi-facebook"></i></i></a>
                                        <a href="<?= (isset($result['linktwitter']) ? $result['linktwitter'] : "") ?>" class="mx-1 social-list-item text-center border-info text-info"><i class="mdi mdi-twitter"></i></i></a>
                                    </div>
                                    <!-- <div class="btn btn-primary">Đăng ký</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>
    </section>

    <!-- gioi thieu gia su day kem tai nha la gi -->
    <section class="mt-5 d-flex align-items-center justify-content-center" style="height: 300px; background-color: #A1E3D8;">
        <div class="jumbotron text-center mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Gia sư dạy kèm tại nhà là gì?</h1>
                        <p>Trang "gia sư tại nhà" là trang được xây dựng với nhu cầu có thể giúp con em các phụ huynh có thể học tập đạt thành tích tốt. Sự uy tín trong kiểm duyệt, tính chuyên nghiệp của các gia sư có tại đây là đại diện cho toàn bộ bộ mặt của trang.</p>
                        <p><a id="buttonClickScroll" class="btn btn-primary btn-lg smoothScroll" href="#subInfor" role="button">Xem thêm »</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- thong tin loi ich tu viec hoc day kem  -->
    <section>
        <h2 id="subInfor" class="text-center mt-4 mb-5">LỢI ÍCH VIỆC HỌC DẠY KÈM</h2>
        <div class="container">
            <div class="row">
                <?php
                $result = $db_homepage->showPost();
                $count = 0;

                $NumberElement = $result->num_rows <= 4 ? $result->num_rows : 4; // lấy só lượng phần tử trong đây
                $lenght = 12 / ($NumberElement); // chiều dài chia cột
                while ($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                    $content = $row['content'];
                ?>
                    <div class="col-lg-<?php echo $lenght ?> col-md-<?php echo $lenght ?> col-<?php echo $lenght ?>">
                        <h3 class='text-center' style='height: 90px;'><?php echo $title; ?></h3>
                        <?php echo $content ?>
                    </div>
                <?php
                    if ($count == 3)
                        break;
                    else
                        $count++;
                }
                ?>
            </div>
        </div>
    </section>
    <!-- danh gia cua moi nguoi ve trang gia su day kem  -->
    <section style="background-color: #6a41ed; color: #FFFFFF;">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <h2 class="text-center pt-5">Mọi người nghĩ gì về trang dạy kèm tại nhà?</h2>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://anhdep123.com/wp-content/uploads/2020/05/anh-gai-che-mat-4.jpg" data-holder-rendered="true">
                            <h3 class="mt-3">Nguyễn Văn A</h3>
                            <p>Con tôi học rất tệ môn tiếng anh từ khi được dạy kèm ở đây thì giỏi ngữ văn lắm.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://i.pinimg.com/originals/f7/a5/48/f7a5489830eef765b2ba8bc77f66e25d.png" data-holder-rendered="true">
                            <h3 class="mt-3">Huỳnh Bé Nên</h3>
                            <p>Con tôi khác yếu Anh Văn nhờ thầy cô dạy kèm ở đây cháu nó có thể lấy 10 điểm môn toán dễ dàng.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://haycafe.vn/wp-content/uploads/2022/02/Anh-gai-xinh-Viet-Nam.jpg" data-holder-rendered="true">
                            <h3 class="mt-3">Lâm Gia Huy</h3>
                            <p>Cháu Diễm Mi nhà tôi mất tích 3 năm rồi từ khi tôi thuê gia sư ở đây thì con bé thấy trai đẹp nên tự mò về.</p>
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