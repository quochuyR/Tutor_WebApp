<?php

namespace Views;

use Library\Session;

include_once "../lib/session.php";

Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);

?>

<?php
$introduction = "active";
$title = "Trang chủ";

include "../inc/header.php";
?>

<div id="main" class="container ">
    <div id="carouselExampleControls" class="carousel slide carouselTrangChu" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleControls" data-slide-to="1"></li>
            <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner img-fluid">
            <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo $arrayImg[0]['imageURL'] ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $arrayImg[1]['imageURL'] ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $arrayImg[2]['imageURL'] ?>" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container  text-center mt-4">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-12"><img class="rounded-circle" alt="Uy tín"
                            src="https://top1quangnam.com/wp-content/uploads/2021/06/UY-TIN-2.png" width="80"
                            height="80"></div>
                    <div class="col-lg-12 col-12 ml-1">
                        <h4>Uy tín</h4>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12"><img class="rounded-circle" alt="Tận tâm"
                            src="http://cityhomes.net.vn/wp-content/uploads/2019/06/icon-tan-tam.png" width="80"
                            height="80"></div>
                    <div class="col-lg-12 col-12 ml-1">
                        <h4>Tận tâm</h4>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-lg-12 col-12"><img class="rounded-circle" alt="Chuyên nghiệp"
                            src="https://binbrand.vn/upload/images/1Thiet%20ke%20Logo/top%20c%C3%B4ng%20ty%20thi%E1%BA%BFt%20k%E1%BA%BF%20logo%20chuy%C3%AAn%20nghi%E1%BB%87p.png"
                            width="80" height="80"></div>
                    <div class="col-lg-12 col-12 ml-1">
                        <h4>Chuyên nghiệp</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h2 class="text-center mb-5">Lớp gia sư hiện có mới nhất</h2>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center mt-4">
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                    <img class="card-img-top" src="../public/images/400X200.gif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
<<<<<<< HEAD
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
    <section id="tutors">
        <div class="container py-3">
            <div class="row">
                <div class="col-12 pb-4  g-0 d-flex justify-content-end">

                    <nav aria-label="Page navigation example " id="pagination-nav" class="mt-3">

                    </nav>
                </div>
    </section>
    <!-- gioi thieu gia su day kem tai nha la gi -->
    <section class="mt-5 d-flex align-items-center justify-content-center" style="height: 300px; background-color: #A1E3D8;">
=======
>>>>>>> origin/master
        <div class="jumbotron text-center mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Gia sư dạy kèm tại nhà là gì?</h1>
                        <p>Trang "gia sư tại nhà" là trang được xây dựng với nhu cầu có thể giúp con em các phụ huynh có
                            thể học tập đạt thành tích tốt. Sự uy tín trong kiểm duyệt, tính chuyên nghiệp của các gia
                            sư có tại đây là đại diện cho toàn bộ bộ mặt của trang.</p>
                        <p><a id="buttonClickScroll" class="btn btn-primary btn-lg smoothScroll" href="#subInfor"
                                role="button">Xem thêm »</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<<<<<<< HEAD
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
                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://anhdep123.com/wp-content/uploads/2020/05/anh-gai-che-mat-4.jpg" data-holder-rendered="true">
                            <h3>Nguyễn Văn A</h3>
                            <p>Con tôi học rất tệ môn tiếng anh từ khi được dạy kèm ở đây thì giỏi ngữ văn lắm.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://anhdep123.com/wp-content/uploads/2020/05/anh-gai-che-mat-4.jpg" data-holder-rendered="true">
                            <h3>Cờ rờ u ết hắt</h3>
                            <p>Con tôi khác yếu Anh Văn nhờ thầy cô dạy kèm ở đây cháu nó có thể lấy 10 điểm môn toán dễ dàng.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="row d-block w-100 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://anhdep123.com/wp-content/uploads/2020/05/anh-gai-che-mat-4.jpg" data-holder-rendered="true">
                            <h3>Huỳnh Lí Thị Bê</h3>
                            <p>Cháu Diễm Mi nhà tôi mất tích 3 năm rồi từ khi tôi thuê gia sư ở đây thì con bé thấy trai đẹp nên tự mò về.</p>
                        </div>
=======
    <h2 id="subInfor" class="text-center mb-5">LỢI ÍCH VIỆC HỌC DẠY KÈM</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <h3 class='text-center mb-5'>dạy học một-một</h3>
                <p class="text-justify">Một điểm tích cực từ việc học gia sư là khoảng thời gian một học sinh sẽ nhận
                    được từ một giáo viên. Vì học gia sư thường trên cơ sở một-một, giáo viên có thể tập trung sự chú ý
                    của họ vào một học sinh. Điều này rõ ràng là một lợi thế rất lớn so với các lớp học từ 20 - 30 học
                    sinh, nơi mà thời gian của giáo viên được chia ra và cá nhân có thể dễ dàng bị lạc trong đám đông.
                    Với ít phiền nhiễu, người dạy kèm có thể đánh giá tốt hơn và tập trung cải thiện các điểm yếu của
                    học sinh.</p>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <h3 class='text-center mb-5'>học sinh tự tin hơn</h3>
                <p class="text-justify">Vì học gia sư thường là một-một, nên những người dạy kèm và học sinh có thể làm
                    việc chặt chẽ hơn và phát triển mối quan hệ tốt hơn. Đối với những học sinh nhút nhát, trong môi
                    trường học tập với ít người hơn cũng có thể giúp họ chứng tỏ bản thân vì ít chịu áp lực từ bạn bè.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <h3 class='text-center mb-3'>hoàn thành hiệu quả bài tập</h3>
                <p class="text-justify">Bài tập ở nhà có thể rất nhàm chán và đôi khi gây khó chịu cho học sinh. Gia sư
                    dạy kèm có thể giúp học sinh tập trung và sẽ đảm bảo rằng bài tập về nhà không chỉ được hoàn thành
                    tốt hơn mà còn giúp học sinh hiểu được những điều cần học từ những bài tập đó. Tương tự, gia sư có
                    thể mang lại hiệu quả trong việc chuẩn bị bài kiểm tra. Những lời khuyên và sự hỗ trợ mà họ cung cấp
                    có thể khắc phục những điểm yếu trong kiến thức của học sinh.</p>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <h3 class='text-center mb-3'>linh hoạt và dễ dàng</h3>
                <p class="text-justify">Dạy kèm tại nhà ngày càng trở nên linh hoạt và thuận tiện. Người dạy kèm thường
                    có thể đến nhà học sinh, giúp tiết kiệm rất nhiều thời gian di chuyển cho cả học sinh và phụ huynh.
                    Việc tổ chức một thời khóa biểu thích hợp cũng dễ dàng đạt được. Ngoài ra, với sự ra đời của hình
                    thức gia sư trực tuyến, học sinh có thể học ở bất cứ đâu và mọi lúc họ muốn.</p>
            </div>
        </div>
    </div>
    <div id="carouselDanhGiaPhuHuynh" class="carousel slide carouselDanhGiaPhuHuynh" data-ride="carousel">
        <h2 class="text-center pt-5">Mọi người nghĩ gì về trang dạy kèm tại nhà?</h2>
        <div class="carousel-inner">
            <div class="carousel-item active mt-2">
                <div class="row d-block w-100 ">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;"
                            src="<?php echo $link ?>" data-holder-rendered="true">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item mt-2">
                <div class="row d-block w-100 ">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;"
                            src="<?php echo $link ?>" data-holder-rendered="true">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item mt-2">
                <div class="row d-block w-100 ">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;"
                            src="<?php echo $link ?>" data-holder-rendered="true">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
>>>>>>> origin/master
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include "../inc/script.php"
?>
<?php include '../inc/footer.php'?>