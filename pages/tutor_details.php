<?php

namespace Views;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\Tutor,
    Classes\TeachingSubject,
    Classes\Day,
    Classes\DayOfWeek,
    Classes\TeachingTime,
    Classes\SavedTutor,
    Classes\RegisterUser,
    Classes\Review;

require_once(__DIR__ . "../../vendor/autoload.php");

// include_once "../classes/tutors.php";
// include_once "../classes/teachingsubjects.php";
// include_once "../classes/dayofweeks.php";
// include_once "../classes/days.php";
// include_once "../classes/teachingtimes.php";
// // include_once "../classes/savedtutors.php";
// include_once "../classes/registerusers.php";
// include_once "../helpers/format.php";
// include_once "../lib/session.php";

Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] === null) {
    header("location:./errors/404");
} else {
    $id = Format::validation($_GET["id"]);
}


?>
<?php
$title = "Thông tin gia sư";

$nav_tutor_active = "active";
include "../inc/header.php";

?>
<!-- Hiển thị hình ảnh rõ hơn khi click -->

<div class="img-float text-center d-none">
    <img class="img-full-screen" src="" alt="" srcset="">
    <div class="full-height"></div>

</div>





<div id="main" class="container pt-2">


    <!-- Main -->
    <div class="container">
        <div class="row">

            <?php
            $tutors = new Tutor();
            $teaching_subjects = new TeachingSubject();
            $dayofweeks = new DayOfWeek();
            $days = new Day();
            $teachingtimes = new TeachingTime();
            $saved_tutor = new SavedTutor();
            $register_user = new RegisterUser();
            $review = new Review();

            $detail_tutor = $tutors->getTutorDetail($id)->fetch_all(MYSQLI_ASSOC);
            if ($detail_tutor) :

                foreach ($detail_tutor as $result) :


            ?>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-detail">
                            <div class="card-body">

                                <div class="d-flex align-items-start">
                                    <img src="<?= isset($result["imagepath"]) ? Util::getCurrentURL(1) . "public/" . $result["imagepath"] : "https://bootdey.com/img/Content/avatar/avatar5.png"; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    <div class="w-100 ms-3 align-self-end">
                                        <h4 class="my-1"><?= $result["lastname"] . ' ' . $result["firstname"]; ?></h4>
                                        <p class="text-muted">@id: <?= $result["username"]; ?></p>
                                        <!-- <button type="button"
                                        class="btn btn-soft-primary btn-xs waves-effect mb-2 waves-light">Đăng kí</button> -->
                                        <!-- <button type="button"
                                        class="btn btn-soft-success btn-xs waves-effect mb-2 waves-light">Nhắn tin</button> -->
                                    </div>
                                </div>

                                <div class="mt-3">

                                    <h4 class="font-13 text-uppercase fw-bold">Thông tin cá nhân gia sư:</h4>
                                    <!-- <p class="text-muted font-13 mb-3">
                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                            </p> -->
                                    <p class="fw-regular mb-2 font-13"><strong>Họ và tên: </strong>
                                        <span class="ms-2"><?= $result["lastname"] . ' ' . $result["firstname"]; ?></span>
                                    </p>

                                    <p class="fw-regular mb-2 font-13"><strong>Giới tính: </strong> <span class="ms-2"><?= $result["sex"] == 1 ?  "Nam" :  "Nữ"; ?></span></p>

                                    <p class="fw-regular mb-2 font-13"><strong>Số điện thoại: </strong><span class="ms-2"> <?= $result["currentphonenumber"]; ?> (zalo)</span></p>

                                    <p class="fw-regular mb-2 font-13"><strong>Email: </strong> <span class="ms-2"> <?= $result["currentemail"]; ?></span></p>

                                    <p class="fw-regular mb-2 font-13"><strong>Hiện tại là: </strong> <span class="ms-2"> <?= $result["currentjob"]; ?></span></p>

                                    <p class="fw-regular mb-1 font-13"><strong>Nơi ở hiện tại: </strong> <span class="ms-2"><?= $result["currentaddress"]; ?></span></p>
                                </div>

                                <div class="mt-4">

                                    <h4 class="font-13 text-uppercase fw-bold">Thông tin giảng dạy gia sư:</h4>


                                    <p class="fw-regular mb-2 font-13"><strong>Khu vực dạy: </strong> <span class="ms-2"><?= $result["teachingarea"] ?></span></p>

                                    <p class="fw-regular mb-2 font-13"><strong>Hình thức dạy: </strong><span class="ms-2"> <?php
                                                                                                                            foreach (explode(",", $result["teachingform"]) as $teachingForm) :
                                                                                                                                if ($teachingForm == 0)
                                                                                                                                    echo '<span class="badge text-dark me-1" style="background-color: #d5db8b">trực tiếp </span>';
                                                                                                                                else if ($teachingForm == 1)
                                                                                                                                    echo '<span class="badge text-dark me-1" style="background-color: #ffdeab">trực tuyến </span>';
                                                                                                                            endforeach;
                                                                                                                            ?></span></p>
                                </div>

                                <ul class="social-list list-inline mt-3 mb-0">
                                    <li class="list-inline-item">
                                        <a href="<?= $result["linkfacebook"]; ?>" class="social-list-item text-center border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <!-- <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item text-center border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li> -->
                                    <li class="list-inline-item">
                                        <a href="<?= $result["linktwitter"]; ?>" class="social-list-item text-center border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <!-- <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item text-center border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li> -->
                                    <?php
                                    if (Session::checkRoles(['user', 'tutor'])) :
                                        $hasTutor = $saved_tutor->countTutorSavedByUserId(Session::get("userId"), $id)->fetch_assoc();
                                        $get_registered_tutor = $register_user->countRegisteredUsersWithTutor(Session::get("userId"), $id)->fetch_assoc();
                                    ?>
                                        <li class="list-inline-item postion-absolute">

                                            <button type="button" class="btn  btn-tutor-detail" id="save-tutor"><?= $hasTutor["hasTutor"] > 0 ? "Đã lưu" : "Lưu" ?></button>
                                            <button type="button" class="btn  btn-tutor-detail btn-register-show " data-bs-toggle="modal" data-bs-target="#exampleModal"><?= $get_registered_tutor["registered_tutor"] > 0 ? "Đã đăng ký" : "Đăng ký" ?></button>
                                        </li>

                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div> <!-- end card -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Đăng ký môn học</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row g-0 ">

                                                    <div class="col-8 px-1">
                                                        <div class="form-group">

                                                            <select class="form-select teaching-subject">
                                                                <option value="0">-- Môn học --</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="button" class="btn btn-tutor-detail btn-register-add">Đăng ký</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body p-0">


                                <div class="row g-0 d-flex justify-content-center" id="rating-user" style="max-height: 40rem;overflow-y: scroll;">
                                    <div class="col-12">
                                        <div class="pt-4 ps-4 position-sticky" style="top: 0;background-color:#fff;z-index:2;">
                                            <h4 class="mb-0">Đánh giá gần đây</h4>
                                            <p class="fw-light  pb-2">Đánh giá mới nhất của người dùng</p>
                                            <div class="d-flex align-items-center mt-2 mb-4">

                                                <?php
                                                $avg_stars = $review->get_avg_review_by_tuId($id)->fetch_assoc()["average_rating"];
                                                if ($avg_stars) :
                                                ?>
                                                    <div class="ratings">
                                                        <?php
                                                        $count = 1;
                                                        for ($i = 1; $i <= 5; $i++) :
                                                            if (round($avg_stars - .25) >= $i) :
                                                        ?>
                                                                <span class="material-symbols-rounded rating-color">
                                                                    star
                                                                </span>
                                                            <?php
                                                            elseif (round($avg_stars + .25) >= $i) :
                                                            ?>
                                                                <span class="material-symbols-rounded rating-color">
                                                                    star_half
                                                                </span>
                                                            <?php
                                                            else :
                                                            ?>
                                                                <span class="material-symbols-rounded">
                                                                    star
                                                                </span>
                                                        <?php
                                                            endif;
                                                            $count++;
                                                        endfor;

                                                        ?>


                                                    </div>

                                                    <h5 class="review-count"><?= $avg_stars ?> trên 5</h5>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>

                                        <?php

                                        $_review_user = $review->get_review_by_tuId($id);

                                        if ($_review_user->num_rows > 0) :
                                            while ($review_user = $_review_user->fetch_assoc()) :

                                        ?>
                                                <div class="card pb-0 mb-0">
                                                    <div class="card-body p-4">


                                                        <div class="d-flex flex-start">
                                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= Util::getCurrentURL(1) . 'public/' . $review_user["imagepath"] ?>" alt="avatar" width="60" height="60" />
                                                            <div>
                                                                <h6 class="fw-600 mb-1"><?= $review_user['lastname'] . ' ' . $review_user['firstname'] ?></h6>
                                                                <div class="d-flex align-items-center mb-3">
                                                                    <p class="mb-0 text-muted">
                                                                        <?= Format::formatDate(strtotime($review_user['date_rating'])) ?>

                                                                    </p>

                                                                </div>
                                                                <p class="mb-0">
                                                                    <?= $review_user['user_review'] ?>

                                                                </p>
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="ratings">
                                                                        <?php
                                                                        $stars = (float)$review_user['user_rating'];
                                                                        $count = 1;
                                                                        for ($i = 1; $i <= 5; $i++) :
                                                                            if (round($stars - .25) >= $i) :
                                                                        ?>
                                                                                <span class="material-symbols-rounded rating-color">
                                                                                    star
                                                                                </span>
                                                                            <?php
                                                                            elseif (round($stars + .25) >= $i) :
                                                                            ?>
                                                                                <span class="material-symbols-rounded rating-color">
                                                                                    star_half
                                                                                </span>
                                                                            <?php
                                                                            else :
                                                                            ?>
                                                                                <span class="material-symbols-rounded">
                                                                                    star
                                                                                </span>
                                                                        <?php
                                                                            endif;
                                                                            $count++;
                                                                        endfor;

                                                                        ?>


                                                                    </div>
                                                                    <h5 class="review-count"><?= $stars ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-0" />




                                        <?php
                                            endwhile;

                                        else : echo '<span class="mb-4 px-3 d-block fw-bold">Chưa có đánh giá</span>';
                                        endif;
                                        ?>
                                    </div>
                                </div>



                            </div>
                        </div>


                    </div> <!-- end col-->




                    <div class="col-xl-8 col-md-7">
                        <div class="card card-detail">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 border-end border-light">
                                        <h5 class="mt-1 mb-2  fw-600 text-start border-bottom pb-2">Giới thiệu chung
                                            và kinh nghiệm gia
                                            sư</h5>
                                        <?= html_entity_decode($result["introduction"]) ?>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="card card-detail">
                            <div class="card-body">
                                <h5 class="header-title fw-600 pb-2 border-bottom">Môn học đang dạy</h5>

                                <div class="inbox-widget mt-2" data-simplebar="init" style="max-height: 7rem;">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer">

                                            </div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" style="height: 7rem; overflow: hidden scroll ;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <div class="d-flex align-items-center pb-1 " id="tooltips-container">

                                                            <div class="w-100 ms-3 d-flex flex-row flex-wrap">
                                                                <?php

                                                                $topicList = $teaching_subjects->getTopicByTutorId($result['id']);
                                                                while ($resultTopic = $topicList->fetch_assoc()) :

                                                                ?>
                                                                    <div class="mt-1 mx-1 text-start ">
                                                                        <div class="mb-1">
                                                                            <span class="badge p-2" style="background-color: #2A646E;">
                                                                                <?= $resultTopic["topicName"] ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                <?php endwhile; ?>

                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div> <!-- end inbox-widget -->
                            </div>
                        </div> <!-- end card-->


                    <?php endforeach; ?>
                    <div class="card card-detail">
                        <div class="card-body">
                            <h5 class="header-title fw-600 pb-2 mb-3 border-bottom">Lịch dạy gia sư</h5>
                            <div class="row g-0">
                                <?php
                                $dow_list = $dayofweeks->getAll();
                                while ($resultDOW = $dow_list->fetch_assoc()) :


                                ?>
                                    <div class="col-4 col-md-3 col-xl">
                                        <h6 class=" text-center"><?= $resultDOW["day"]  ?></h6>
                                        <ul class="calendar">
                                            <?php
                                            $day_list = $days->getAll();
                                            while ($resultDay = $day_list->fetch_assoc()) :
                                                $get_teachingTime_list = $teachingtimes->getAll($id, $resultDOW["id"], $resultDay["id"]);


                                                // if ($get_teachingTime_list):

                                            ?>
                                                <li class="<?= $get_teachingTime_list ? "calendar-active" : "calendar-normal" ?>" data-bs-toggle="<?= $get_teachingTime_list ? "collapse" : "" ?>" data-bs-target="#collapse<?= $resultDOW["id"] . 'T' . $resultDay["id"] ?>" aria-expanded="false" aria-controls="collapseExample">
                                                    <?= $resultDay["dayname"] ?>

                                                </li>
                                                <div class="collapse" id="collapse<?= $resultDOW["id"] . 'T' . $resultDay["id"] ?>">
                                                    <div class="container-fluid p-0">
                                                        <ul class="ps-1 container-time">
                                                            <?php

                                                            if ($get_teachingTime_list) :
                                                                $teachingTime_list = $get_teachingTime_list->fetch_all(MYSQLI_ASSOC);


                                                                foreach ($teachingTime_list as $resultTeachingTime) :


                                                            ?>
                                                                    <li class="calendar-time font-13"><?= $resultTeachingTime["time"] ?></li>

                                                            <?php endforeach; //resultTeachingTime
                                                            // teachingTime_list
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>

                                            <?php
                                            endwhile;
                                            ?>
                                        </ul>
                                    </div>

                                <?php endwhile; ?>

                            </div>

                        </div>
                    </div> <!-- end card-->

                <?php
            else :
                echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                ID NOT FOUND.
            </div>';
            endif
                ?>


                    </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
</div>





<?php
include "../inc/script.php"
?>

<script>
   
</script>
<?php include '../inc/footer.php' ?>