<?php

namespace Api;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\Tutor,
    Classes\TeachingSubject,
    Classes\Day,
    Classes\DayOfWeek,
    Classes\TeachingTime,
    Classes\SavedTutor,
    Classes\RegisterUser;

$filepath = realpath(dirname(__FILE__, 4));
require_once($filepath . "/vendor/autoload.php");

// include_once($filepath . "../lib/session.php");
// include_once($filepath . "../../classes/tutors.php");
// include_once($filepath . "../../classes/teachingsubjects.php");
// include_once($filepath . "../../classes/dayofweeks.php");
// include_once($filepath . "../../classes/days.php");
// include_once($filepath . "../../classes/teachingtimes.php");
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../classes/registerusers.php");
// include_once($filepath . "../../helpers/format.php");

Session::init();
if (!Session::checkRoles(['admin'])) {
    header("location:../pages/errors/404");
}
if (!isset($_POST["id"]) || empty($_POST["id"]) || $_POST["id"] === null) {
    header("location:./errors/404");
} else {
    $id = Format::validation($_POST["id"]);
}


?>
<div id="main" class="container pt-2">

    <!-- Hiển thị hình ảnh rõ hơn khi click -->

    <div class="img-float text-center d-none">
        <img class="img-full-screen" src="" alt="" srcset="">
        <div class="full-height"></div>

    </div>







    <!-- Main -->
    <!-- <div class="container"> -->
        <div class="row">

            <?php
            $tutors = new Tutor();
            $teaching_subjects = new TeachingSubject();
            $dayofweeks = new DayOfWeek();
            $days = new Day();
            $teachingtimes = new TeachingTime();
            $saved_tutor = new SavedTutor();
            $register_user = new RegisterUser();

            $detail_tutor = $tutors->getTutorDetailForAdmin($id)->fetch_all(MYSQLI_ASSOC);
            if ($detail_tutor) :

                foreach ($detail_tutor as $result) :


            ?>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-detail position-sticky" style="top: 1rem">
                            <div class="card-body">

                                <div class="d-flex align-items-start">
                                    <img src="<?= isset( $result["imagepath"]) ? Util::getCurrentURL(3) . "public/" . $result["imagepath"] : Util::getCurrentURL(1) . "public/images/avatar5-default.jpg"; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    <div class="w-100 ms-3 align-self-end">
                                        <h4 class="my-1"><?= $result["lastname"] . ' ' . $result["firstname"]; ?></h4>
                                        <p class="text-muted">@id: <?= $result["username"]; ?></p>
                                        <!-- <button type="button"
                                        class="btn btn-soft-primary btn-xs waves-effect mb-2 waves-light">Đăng kí</button> -->
                                        <!-- <button type="button"
                                        class="btn btn-soft-success btn-xs waves-effect mb-2 waves-light">Nhắn tin</button> -->
                                    </div>
                                </div>

                                <div class="mt-3 info-detail">

                                    <h4 class="font-13 text-uppercase fw-bold">Thông tin cá nhân gia sư:</h4>
                                    <!-- <p class="text-muted font-13 mb-3">
                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                            </p> -->
                                    <p class="fw-regular font-13"><strong>Họ và tên: </strong>
                                        <span class="ms-2"><?= $result["lastname"] . ' ' . $result["firstname"]; ?></span>
                                    </p>

                                    <p class="fw-regular font-13"><strong>Giới tính: </strong> <span class="ms-2"><?= $result["sex"] == 1 ?  "Nam" :  "Nữ"; ?></span></p>

                                    <p class="fw-regular font-13"><strong>Số điện thoại: </strong><span class="ms-2"> <?= $result["currentphonenumber"]; ?> (zalo)</span></p>

                                    <p class="fw-regular font-13"><strong>Email: </strong> <span class="ms-2"> <?= $result["currentemail"]; ?></span></p>

                                    <p class="fw-regular font-13"><strong>Hiện tại là: </strong> <span class="ms-2"> <?= $result["currentjob"]; ?></span></p>

                                    <p class="fw-regular mb-1 font-13"><strong>Nơi ở hiện tại: </strong> <span class="ms-2"><?= $result["currentaddress"]; ?></span></p>
                                </div>

                                <div class="mt-4 info-detail" >

                                    <h4 class="font-13 text-uppercase fw-bold">Thông tin giảng dạy gia sư:</h4>


                                    <p class="fw-regular font-13"><strong>Khu vực dạy: </strong> <span class="ms-2"><?= $result["teachingarea"] ?></span></p>

                                    <p class="fw-regular font-13"><strong>Hình thức dạy: </strong><span class="ms-2"> <?php
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

                                    <li class="list-inline-item postion-absolute">

                                        <!-- <button type="button" class="btn  btn-tutor-detail <?= !empty($_SESSION) ? "" : "d-none"  ?>" id="save-tutor"><?= $hasTutor["hasTutor"] > 0 ? "Đã lưu" : "Lưu" ?></button> -->
                                    </li>
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




                    </div> <!-- end col-->




                    <div class="col-xl-8 col-md-7">
                        <div class="card card-detail">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 border-end border-light">
                                        <h5 class="mt-1 mb-2  fw-bold text-start border-bottom pb-2">Giới thiệu chung
                                            và kinh nghiệm gia
                                            sư</h5>
                                        <?= html_entity_decode($result["introduction"]) ?>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="card card-detail">
                            <div class="card-body">
                                <h5 class="header-title fw-bold pb-2 border-bottom">Môn học đang dạy</h5>

                                <div class="inbox-widget" data-simplebar="init" style="max-height: 7rem;">
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
                            <h5 class="header-title fw-bold pb-2 border-bottom">Lịch dạy gia sư</h5>
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

    <!-- </div> -->
</div>