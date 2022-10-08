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
$title = "Hệ thống gia sư, các khóa học chất lượng";
include "../inc/header.php";
?>
<!-- carousel silde  start-->
<section id="main" class="container-fluid px-0">
    <section data-aos="zoom-in-up" data-aos-duration="1500" id="carouselSecction">
        <div id="carouselExampleIndicators" class="carousel slide carouselTrangChu" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" id="carousel_image_background">

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
    <!-- carousel silde  end-->

    <!-- About Second start  -->
    <section class="about-second-background container-fluid">
        <div class="container pt-5 about-second">
            <h4 class="text-center">Hãy tìm cho con một gia sư</h4>
            <h2 class="text-center">Gia Sư - Trợ lý học tập đích thực</h2>
            <div class="row justify-content-around pt-5" data-aos="zoom-in" data-aos-duration="1500">
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="d-flex justify-content-center">
                        <div class="card card-second " style="width: 18rem">
                            <img src="../public/images/Homepage/gia-su-chat-luong.png" class="card-img-top rounded" alt="...">
                            <div class="card-body">
                                <p class="card-title text-center"><b>GIA SƯ CHẤT LƯỢNG CAO</b></p>
                                <p class="card-text card-second-text">Được tuyển chọn từ hơn 40.000 gia sư từ các trường đại học hàng đầu Việt Nam, các gia sư còn trải qua quá trình đào tạo và kiểm tra nghiêm khắc.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pt-5" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="d-flex justify-content-center">
                        <div class="card card-second" style="width:  18rem">
                            <img src="../public/images/Homepage/Hoc-tap-ca-nhan-hoa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-title text-center"><b>HỌC TẬP CÁ NHÂN HOÁ</b></p>
                                <p class="card-text card-second-text">Không chỉ cá nhân hoá lộ trình học mà mỗi học sinh đều được xác định phong cách học riêng và giảng dạy theo phương pháp phù hợp nhất với phong cách đó.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="d-flex justify-content-center">
                        <div class="card card-second" style="width:  18rem">
                            <img src="../public/images/Homepage/gia-su-chuyen-mon.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-title text-center"><b>GIÁO VIÊN CHUYÊN MÔN</b></p>
                                <p class="card-text card-second-text">Mỗi lớp gia sư sẽ có một giáo viên giỏi giám sát và đảm bảo chất lượng dạy và học. Giáo viên chuyên môn sẽ lên lộ trình, theo dõi và trao đổi cùng gia sư và phụ huynh.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pt-5" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="d-flex justify-content-center">
                        <div class="card card-second" style="width: 18rem">
                            <img src="../public/images/Homepage/Huong-dan-quan-tri-web.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-title text-center"><b>WEBSITE QUẢN LÝ</b></p>
                                <p class="card-text card-second-text">Website Gia Sư giúp phụ huynh dễ dàng theo dõi được nội dung học từng buổi học, đọc báo cáo học tập và nhận xét của gia sư, của cô giáo tổ chuyên môn.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center p-4" data-aos="zoom-in-up" data-aos-duration="1500">
                <div class="btn text-light"><a class="link-light h4" href="list_tutor">Xem danh sách gia sư</a></div>
            </div>
        </div>
    </section>
    <!-- About Second end  -->

    <!-- Features Start -->
    <section class="features-background container-fluid">
        <section id="features" class="container pt-5 pb-5">
            <div class="container">
                <div class="row g-5">
                    <div class="features-title col-lg-5 wow fadeInUp align-self-center" data-wow-delay="0.1s">
                        <h2 class="mb-4">TẠI SAO CHỌN GIA SƯ TRÊN WEBSITE?</h2>
                        <p>Lý do để hơn 3000+ phụ huynh toàn quốc lựa chọn Gia Sư giúp con học tốt và cảm thấy hiệu quả hơn bất kỳ hình thức học tập nào khác.</p>
                    </div>
                    <div class="col-lg-7">
                        <div class="row g-5">
                            <div class="col-sm-6 wow fadeIn features-title" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center mb-3 ">
                                    <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                        <i class="fa fa-cubes text-white"></i>
                                    </div>
                                    <h6 class="mb-0">Quản lý chất lượng từ giáo viên giỏi</h6>
                                </div>
                                <span class="features-text">Khác với học gia sư tự do, gia sư sẽ được quản lý chất lượng và định hướng bởi tổ giáo viên giỏi.</span>
                            </div>
                            <div class="col-sm-6 wow fadeIn features-title" data-wow-delay="0.2s">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                        <i class="fa fa-percent text-white"></i>
                                    </div>
                                    <h6 class="mb-0">Cách học mới & Tài liệu độc quyền</h6>
                                </div>
                                <span class="features-text">Học sinh được học theo đúng phong cách của mình nên tiếp thu nhanh hơn, hứng thú hơn. Kho bài giảng được nghiên cứu, giúp học dễ hiểu và hiệu quả hơn.</span>
                            </div>
                            <div class="col-sm-6 wow fadeIn features-title" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                        <i class="fa fa-smile-beam text-white"></i>
                                    </div>
                                    <h6 class="mb-0">Website tiện lợi</h6>
                                </div>
                                <span class="features-text">Website Gia Sư giúp phụ huynh theo dõi được từng buổi học, xem biểu đồ phát triển của con.</span>
                            </div>
                            <div class="col-sm-6 wow fadeIn features-title" data-wow-delay="0.5s">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                        <i class="fa fa-user-tie text-white"></i>
                                    </div>
                                    <h6 class="mb-0">Được hỗ trợ từ trường đại học</h6>
                                </div>
                                <span class="features-text">Trường Đại học Đồng Tháp là đơn vị uy tín.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Features End -->
    <!-- danh sach gia su  -->
    <section class="container" data-aos="zoom-in-up" data-aos-duration="1500">
        <h2 class="tutor_feature text-center m-3">GIA SƯ NỔI BẬT</h2>
        <div class="row justify-content-around">
            <?php
            $result = $db_homepageTutor->getFilter($_POST);
            $_POST["limit"] = 8;
            $tutorOfTopic =  $TTtopic->getFilter($_POST);

            if ($tutorOfTopic->data) :
                while ($result = $tutorOfTopic->data->fetch_assoc()) :
            ?>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 offset-md-0 offset-sm-1 pt-md-0">
                        <div class="card card-tutor" onclick=" location.href ='  <?= "tutor_details?id=" . $result['id']  ?> '; ">
                            <div class=" card-img-top img-teacher text-center">
                                <img src=" <?= (isset($result['imagepath']) ? Util::getCurrentURL(1) . "public/" .  $result['imagepath'] : Util::getCurrentURL(1) . "public/images/avatar5-default.jpg") ?>" class="rounded" alt="" srcset="">
                            </div>
                            <div class="card-body">
                                <h5 class="fw-600 pt-1 pb-2 limit-text-inline"><?= $result['lastname'] . ' ' . $result['firstname'] ?></h5>
                                <?php
                                $subjectTutors = "";
                                $subjectList = $subjects->getByTutorId($result['id']);
                                while ($resultSB = $subjectList->fetch_assoc()) :
                                    $subjectTutors .= $resultSB['subject'] . ', ';
                                endwhile;

                                $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                                ?>

                                <div class=" d-flex pb-2">
                                    <span class="material-symbols-rounded pe-1">
                                        pin_drop
                                    </span>
                                    <span class="description-intro"><?= $result['teachingarea'] . "," . str_replace(["Tỉnh", "Thành phố"], '', $result['currentplace']) ?>
                                    </span>
                                </div>
                                <div class=" d-flex pb-2">
                                    <span class="material-symbols-rounded pe-1">
                                        book
                                    </span>
                                    <span class="description-intro"><?= $subjectTutors ?></span>
                                </div>
                                <div class="text-start description product limit-text mb-5">
                                    <?= html_entity_decode($result['introduction']) ?>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-1 position-absolute" style="bottom: 1rem;">
                                    <div class="d-flex flex-row">
                                        <a href="<?= (isset($result['linkfacebook']) ? $result['linkfacebook'] : "") ?>" class="mx-1 social-list-item text-center border-primary text-primary"><i class="mdi mdi-facebook"></i></i></a>
                                        <a href="<?= (isset($result['linktwitter']) ? $result['linktwitter'] : "") ?>" class="mx-1 social-list-item text-center border-info text-info"><i class="mdi mdi-twitter"></i></i></a>
                                    </div>
                                    <!-- <div class="btn btn-primary">Đăng ký</div> -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>
    </section>
    <!-- About Second strat-->
    <!-- About bl  start -->
    <section class="pt-5">
        <div class="block-content bg-gradient-blue" id="vision">
            <div class="container d-flex justify-content-center">
                <div class="card block-card-about-bl" data-aos="fade-up" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12 image-half-block about-bg1"></div>
                        <div class="col-md-5 col-sm-12 col-xs-12 text-half-block">
                            <h2>SỨ MỆNH GIÁO DỤC</h2>
                            <p>Nền kinh tế Việt Nam đang vươn lên mạnh mẽ. Để đáp ứng được nhu cầu lao động chất lượng cao
                                thì cải cách giáo dục phải được ưu tiên lên hàng đầu. Hưởng ứng lời kêu gọi xã hội hóa giáo dục của chính phủ,
                                Chúng tôi, những con người DTHU EDUCATION đang ngày đêm góp sức mình trong việc nâng cao chất lượng giáo dục tại Việt Nam.
                                Chúng tôi tự hào gọi đó là một <i>"Sứ mệnh giáo dục"</i>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-gradient-pink" id="ketnoi">
            <div class="container d-flex justify-content-center">
                <div class="card block-card-about-bl" data-aos="fade-down" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 text-half-block col-md-pull-7">
                            <h2>KẾT NỐI DẠY VÀ HỌC</h2>
                            <p>Hướng đi của chúng tôi đó là <i>"Kết nối nhu cầu học tập của người học tới những giáo viên,
                                    gia sư, chuyên gia, và trung tâm uy tín"</i>. Việc này có ý nghĩa to lớn trong việc tiết kiệm chi phí
                                thời gian tìm kiếm cũng như tạo ra một nền tảng đánh giá chất lượng khách quan bởi cộng đồng.
                            </p>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 image-half-block about-bg2 col-md-push-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-gradient-blue" id="featuresabout">
            <div class="container d-flex justify-content-center">
                <div class="card block-card-about-bl" data-aos="fade-up" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12 image-half-block about-bg3"></div>
                        <div class="col-md-5 col-sm-12 col-xs-12 text-half-block">
                            <h2>NHANH, ĐƠN GIẢN, TIẾT KIỆM</h2>
                            <p>Sử dụng thành tựu công nghệ thời đại 4.0, chúng tôi tạo ra nền tảng mà người học và người dạy
                                được <i>"kết nối trực tiếp"</i> rất nhanh và chính xác theo đúng những nhu cầu học đã đăng lên.
                                Đặc biệt, các giáo viên sẽ đưa ra các mức giá hợp lý nhất như bạn mong muốn.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-gradient-pink" id="quality">
            <div class="container d-flex justify-content-center">
                <div class="card block-card-about-bl" data-aos="fade-down" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 text-half-block col-md-pull-7">
                            <h2>ĐÁNH GIÁ CHẤT LƯỢNG KHÁCH QUAN</h2>
                            <p>Chúng tôi hiểu rằng <i>"chất lượng dạy học luôn phải đặt lên hàng đầu"</i> bên cạnh chi phí phải chăng.
                                Vì vậy chúng tôi đã tạo ra nền tảng cho phép học viên được đánh giá chất lượng dạy &amp; học. Những thông tin này
                                là vô cùng hữu ích cho những người học tiếp theo.
                            </p>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 image-half-block about-bg4 col-md-push-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-gradient-blue" id="alldemand">
            <div class="container d-flex justify-content-center">
                <div class="card block-card-about-bl" data-aos="fade-up" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12 image-half-block about-bg5"></div>
                        <div class="col-md-5 col-sm-12 col-xs-12 text-half-block">
                            <h2>ĐÁP ỨNG MỌI NHU CẦU HỌC TẬP CỦA BẠN</h2>
                            <p>Giờ đây bạn không phải vất vả tìm kiếm nữa, bởi tất cả mọi nhu cầu học tập của bạn
                                đều rất sẵn sàng trên DTHU EDUCATION. Chúng tôi có thể giúp bạn:
                            </p>
                            <ul style="font-size:16px;">
                                <li>Tìm gia sư, tìm giáo viên dạy kèm</li>
                                <li>Tìm khóa học trung tâm</li>
                                <li>Tư vấn giáo dục</li>
                                <li>Hoạt động giáo dục trải nghiệm</li>
                            </ul>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About bl  End  -->
    <div class="clearfix"></div>
    <!-- tùy chọn thành gia sư - xem danh sách gia sư start  -->
    <section class="trothanhgiasu container-fluid">
        <div class="text-center">
            <h2><b>DÀNH CHO GIÁO VIÊN, SINH VIÊN</b></h2>
            <h3>Trở Thành Gia Sư</h3>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-6">
                    <div data-aos="fade-down" data-aos-duration="1000">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">Khác Biệt và Chuyên Nghiệp</h4>
                                        <p class="card-text">Được đào tạo nghiệp vụ sư phạm, kỹ năng, tâm lý. Dạy có giáo án chuẩn và trả lương theo từng buổi trên ứng dụng BMentor.</p>
                                        <a href="list_Tutor" class="btn btn-primary">Tìm hiểu thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div data-aos="fade-up" data-aos-duration="1000">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">Đăng Ký Trở Thành Gia Sư</h4>
                                        <p class="card-text">Hệ thống lớn nhất Việt Nam với hơn 40.000 gia sư. Đăng ký ngay để nâng cao chuyên môn và gia tăng thu nhập.</p>
                                        <a href="tutor_registration_form" class="btn btn-primary">Đăng kí ngay </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tùy chọn thành gia sư - xem danh sách gia sư end  -->

    <!-- Form đăng kí tư vấn start  -->
    <section id="form-register-tutor" class="form-register-tutor  p-3 d-flex justify-content-center">
        <form name="form-register" data-aos="zoom-in" data-aos-duration="1600">
            <h3>ĐĂNG KÍ TƯ VẤN MIỄN PHÍ</h3>
            <div class="row mb-3">
                <input type="hidden" id="token_homepage" value="<?= Session::get("csrf_token") ?>" />
                <p class="fade" id="REMOTE_ADDR"><?php echo $_SERVER['REMOTE_ADDR'] ?></p>
                <div class="col-6">
                    <input type="text" class="form-control" id="fullnamecontact" name="name" placeholder="Họ và tên">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" id="phonecontact" name="phone" placeholder="Số điện thoại">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" id="emailcontact" name="email" placeholder="Địa chỉ email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <textarea class="form-control" id="contentcontact" name="registercontent" rows="3" placeholder="Nội dung"></textarea>
                </div>
            </div>
            <div class="validate-input m-b-20 d-flex justify-content-center">
                <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6Lfw6MkeAAAAADmRhvf__Nri7XkH3dVGsR9v64lM"></div>
            </div>
            <div class="text-center">
                <button class="btn" type="submit" id="sentcontact">GỬI ĐĂNG KÍ TƯ VẤN</button>
            </div>
        </form>
    </section>
    <!-- Form đăng kí tư vấn End  -->
    <div class="clearfix"></div>
    <!-- danh gia cua moi nguoi ve trang gia su day kem  -->
    <section style="background-color: #6a41ed; color: #FFFFFF;">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="ykienkhachhang">
                <p class="text-center pt-5">Ý KIẾN KHÁCH HÀNG</p>
                <h2 class="text-center">Phụ Huynh và Học Viên Nói Gì?</h2>
            </div>
            <div class="carousel-inner pt-5">
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
    <!-- danh gia cua moi nguoi ve trang gia su day kem End-->
    <!-- bài viết và sự kiện start  -->
    <section class="container">
        <h3 class="block_feature_1_homepage_text text-center mb-3"><b>TIN TỨC GIÁO DỤC</b></h3>
        <div id="block_feature_1_homepage">

        </div>
    </section>
    <!-- bài viết và sự kiện end  -->
    <!-- start - contact -  toast notification sent request success  -->
    <section class="trothanhgiasu container-fluid">
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
    </section>
    <!-- end - contact -  toast notification sent request success  -->
    <!-- bootstrap 4 -->
    <!-- Smooth Scrolling  -->
    <!-- <script src="js/scroll.js"></script> -->
</section>

<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>