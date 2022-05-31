<?php

namespace Views;

use Classes\db_homepage;

include '../classes/queryphp.php';
$db_homepage  = new db_homepage();

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
                        <div class="col-lg-12 col-12 ml-1">
                            <h4>Uy tín</h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-12"><img class="rounded-circle" alt="Tận tâm" src="http://cityhomes.net.vn/wp-content/uploads/2019/06/icon-tan-tam.png" width="80" height="80"></div>
                        <div class="col-lg-12 col-12 ml-1">
                            <h4>Tận tâm</h4>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-lg-12 col-12"><img class="rounded-circle" alt="Chuyên nghiệp" src="https://iweb.tatthanh.com.vn/pic/3/service/images/thiet-ke-website-quang-cao(21).png" width="80" height="80"></div>
                        <div class="col-lg-12 col-12 ml-1">
                            <h4>Chuyên nghiệp</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- lop gia su hien co moi nhat  -->
    <section>
        <hr>
        <h2 class="text-center mb-5">Lớp gia sư hiện có mới nhất</h2>
        <div class="container">
            <div class="row">
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img" src="https://vcdn-vnexpress.vnecdn.net/2021/11/23/3f5a6625-jpeg-9062-1637677284-8914-2910-1637686227.jpg" alt="Card image cap" style="height: 150px">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pb-1 pb-md-0">
                    <div class="card">
                        <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center ">Card title</h5>
                            <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                $NumberElement = $result->num_rows; // lấy só lượng phần tử trong đây
                $lenght = 12 / $NumberElement; // chiều dài chia cột
                while ($row = $result->fetch_assoc()) {
                    if ($count == 4)
                        break;
                    else
                        $count++;
                    $title = $row['title'];
                    $content = $row['content'];
                ?>
                    <div class="col-lg-<?php echo $lenght ?> col-md-<?php echo $lenght ?> col-<?php echo $lenght ?>">
                        <h3 class='text-center' style='height: 75px;'><?php echo $title; ?></h3>
                        <?php echo $content ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- danh gia cua moi nguoi ve trang gia su day kem  -->
    <section style="background-color: #6a41ed; color: #FFFFFF;">
        <div id="carouselDanhGiaPhuHuynh" class="carousel slide carouselDanhGiaPhuHuynh" data-ride="carousel">
            <h2 class="text-center pt-5">Mọi người nghĩ gì về trang dạy kèm tại nhà?</h2>
            <div class="carousel-inner">
                <div class="carousel-item active mt-2">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="<?php echo $link ?>" data-holder-rendered="true">
                            <h3>Lorem ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item mt-2">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="<?php echo $link ?>" data-holder-rendered="true">
                            <h3>Lorem ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item mt-2">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="<?php echo $link ?>" data-holder-rendered="true">
                            <h3>Lorem ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
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