<?php

namespace Views;

use Helpers\Util;
use Library\Session;
use Classes\RegisterUser,
    Classes\AppUser,
    Classes\SubjectTopic,
    Classes\TeachingTime,
    Classes\DayOfWeek,
    Classes\TeachingSubject,
    Classes\TutoringSchedule;

require_once(__DIR__ . "../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));
// include_once $filepath . "../../lib/session.php";
// include_once $filepath . "../../helpers/utilities.php";
// include_once $filepath . "../../helpers/format.php";
// include_once $filepath . "../../classes/registerusers.php";
// include_once $filepath . "../../classes/appusers.php";
// include_once $filepath . "../../classes/dayofweeks.php";
// include_once $filepath . "../../classes/subjecttopics.php";
// include_once $filepath . "../../classes/teachingtimes.php";
// include_once $filepath . "../../classes/teachingsubjects.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (Session::checkRoles(["user", "tutor"]) !== true) {
    header("location: ./");
}

$register_user = new RegisterUser();
$_user = new AppUser();
$_subjecttopic = new SubjectTopic();
$_teaching_time = new TeachingTime();
$_day_of_week = new DayOfWeek();
$_teaching_subject = new TeachingSubject();
$_schedule_tutor = new TutoringSchedule();


$title = "Người dùng đăng ký";

include "../inc/header.php";
?>


<!-- Hiển thị hình ảnh rõ hơn khi click -->

<div class="img-float text-center d-none">
    <div class="img-container">
        <img src="" alt="" srcset="">
    </div>

    <div class="full-height"></div>

</div>
<!--  -->
<div id="main" class="container">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mb-2 mt-2">
                <div class="section-title text-start p-2">
                    <h4 class="top-c-sep ">DANH SÁCH GIA SƯ ĐĂNG KÝ</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <div class="filter-result">
                        <p class="mb-30 ff-montserrat">Tổng cộng: <?= $register_user->countRegisteredTutorByUserId(Session::get("userId"))->fetch_assoc()["sum_register_tutor"] ?></p>
                        <?php
                        if (!$_GET) {
                            $_GET = ["limit" => 3, "page" => 1];
                        }
                        if ($_SERVER["REQUEST_METHOD"] === "GET") {



                            if (isset($_GET) && !empty($_GET)) {
                                $get_register_user = $register_user->getRegisteredTutorByUserId(Session::get("userId"), $_GET);
                                if ($get_register_user) {


                                    while ($_register_user = $get_register_user->data->fetch_assoc()) {

                                        $status_approval = $register_user->GetApprovalRegisteredUser($_register_user["id"], Session::get("tutorId"))->fetch_assoc();
                        ?>
                                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30  position-relative <?= $status_approval["status"] === 1 ? "bg-approval" : "" ?>">
                                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                                <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                    <img src="<?= Util::getCurrentURL(1) . "public/"  . $_register_user["imagepath"] ?>" alt="." class="rounded">
                                                </div>
                                                <div class="job-content">
                                                    <h5 class="text-xs-center text-md-left fw-bold "><?= $_register_user["lastname"] . ' ' . $_register_user["firstname"] ?></h5>
                                                    <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                                    <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                        <li class="d-flex" id="topic-register">
                                                            <span class="material-symbols-rounded " style="color: #00857c">
                                                                menu_book
                                                            </span>
                                                            <!--  -->
                                                            <div class="d-flex flex-wrap flex-md-nowrap w-100">
                                                                <?php
                                                                // $RegisterUserSubject = "";
                                                                $subjectList = $_teaching_subject->GetRegisteredUserTopic(Session::get("userId"), $_register_user["tutorId"]);
                                                                if ($subjectList) :
                                                                    while ($resultSubTopic = $subjectList->fetch_assoc()) :
                                                                ?>

                                                                        <span class="limit-text-subject subject-span m-l-10 fw-500 badge my-1 <?= $resultSubTopic['status'] === 1 ? "bg-cerulean" : "bg-secondary" ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $resultSubTopic['topicName'] ?>" data-id="<?= $resultSubTopic['id'] ?>"><?= $resultSubTopic['topicName'] ?></span>
                                                                <?php
                                                                    endwhile;
                                                                endif;

                                                                // echo $RegisterUserSubject = substr($RegisterUserSubject, 0, strlen(trim($RegisterUserSubject)) - 1);
                                                                ?>
                                                            </div>
                                                            <!--  -->
                                                        </li>

                                                        <li class=" py-1 d-inline-flex">

                                                            <span class="material-symbols-rounded" style="color: #E26A25">
                                                                work
                                                            </span>
                                                            <span class="d-block m-l-10 fw-500"><?= isset($_register_user["currentjob"]) ? $_register_user["currentjob"] : "Chưa có thông tin"; ?></span>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>

                                            <?php

                                            $user = $_user->getInfoByUserId($_register_user["id"])->fetch_assoc();
                                            if ($user !== false) {


                                            ?>
                                                <div class="d-md-none d-block pb-4 pb-md-0">
                                                    <ul class="d-flex justify-content-end align-items-center">
                                                        <li class="d-flex flex-row align-items-center">
                                                            <a class="mx-sm-1 mx-3 text-reset" href="../pages/tutor_details?id=<?= $_register_user["tutorId"] ?>">
                                                                <span class="badge badge-light-success">
                                                                    <span class="material-symbols-rounded" style="color: #FFA500;font-size:28px;">
                                                                        visibility
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="d-flex flex-row align-items-center">
                                                            <div class="mx-sm-1  register-unregister-tutor" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target=".approval-register" style="cursor: pointer; ">
                                                                <span class="badge badge-light-success">
                                                                    <span class="material-symbols-rounded" style="color: #366622;font-size:28px;">
                                                                        library_add_check
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <?php
                                                            $get_tutor_has_schedule_for_user = $_schedule_tutor->count_tutor_has_schedule_for_user(Session::get('userId'), $_register_user["tutorId"], 1)->fetch_assoc()['has_schedule'];
                                                            if($get_tutor_has_schedule_for_user):
                                                        ?>
                                                        <li class="d-flex flex-row align-items-center">
                                                            <div class="dropdown-item d-inline-flex review-bs-modal" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target=".review">
                                                                <span class="badge badge-light-success">
                                                                    <span class="material-symbols-rounded py-1">
                                                                        rate_review
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <?php endif; ?>
                                                        <li class="d-flex flex-row align-items-center">
                                                            <a class="mx-sm-1 text-reset" href="./schedule_user?tuid=<?= $_register_user["tutorId"] ?>&day=all" style="">
                                                                <span class="badge badge-light-success">
                                                                    <span class="material-symbols-rounded" style="color: #075b97;font-size:28px;">
                                                                        today
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span class="material-symbols-rounded">
                                                                more_vert
                                                            </span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li class="">
                                                                <a class="dropdown-item d-inline-flex" href="../pages/tutor_details?id=<?= $_register_user["tutorId"] ?>">
                                                                    <span class="material-symbols-rounded" style="color: #FFA500;font-size:28px;">
                                                                        visibility
                                                                    </span>
                                                                    <span class="d-block m-l-10">Xem</span>
                                                                </a>
                                                            </li>


                                                            <li class=""><a class="dropdown-item d-inline-flex" href="./schedule_user?tuid=<?= $_register_user["tutorId"] ?>&day=all">

                                                                    <span class="material-symbols-rounded" style="color: #075b97;font-size:28px;">
                                                                        today
                                                                    </span>
                                                                    <!-- <img src="../public/images/icons/schedule_48px.png" class="w-24" alt="" srcset=""> -->

                                                                    <span class="d-block m-l-10">Lịch học</span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $get_tutor_has_schedule_for_user = $_schedule_tutor->count_tutor_has_schedule_for_user(Session::get('userId'), $_register_user["tutorId"], 1)->fetch_assoc()['has_schedule'];
                                                            if($get_tutor_has_schedule_for_user):
                                                        ?>
                                                            <li class="">
                                                                <div class="dropdown-item d-inline-flex review-bs-modal" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target=".review">

                                                                    <span class="material-symbols-rounded" style="color: #50CD89;font-size:28px;">
                                                                        rate_review
                                                                    </span>
                                                                    <!-- <img src="../public/images/icons/schedule_48px.png" class="w-24" alt="" srcset=""> -->

                                                                    <span class="d-block m-l-10">Đánh giá</span>
                                                                </div>
                                                            </li>

                                                            <?php endif; ?>
                                                            <li class="">
                                                                <div class="dropdown-item register-unregister-tutor d-inline-flex" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target=".approval-register">
                                                                    <span class="material-symbols-rounded" style="color: #366622;font-size:28px;">
                                                                        library_add_check
                                                                    </span>
                                                                    <span class="d-block m-l-10">Đăng ký/Huỷ đăng ký</span>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                                </div>



                                                <!-- <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i> 2
                                                        tuần trước</div> -->
                                        </div>


                                    <?php } ?>

                    <?php
                                    } //end while
                                }
                            }
                        }
                    ?>
                    </div>
                </div>

                <!-- Modal Approval -->
                <div class="modal fade approval-register" id="approval-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog bg-gray-50">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đăng ký/Huỷ đăng ký môn học</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="row g-0 pt-2 mb-0">
                                <div class="col-12">
                                    <div class="card mx-3">
                                        <div class="card-body">
                                            <div class="form-check form-switch">
                                                <input class="show-topic-register form-check-input" type="checkbox" id="flexSwitchCheck-allowSchedule">
                                                <label class=" form-check-label" for="flexSwitchCheck-allowSchedule">Hiển thị môn đã đăng ký</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-body">
                                <div class="card add-register-user">
                                    <div class="card-body">
                                        <div class="row g-0 ">
                                            <div class="col-12 px-1 pt-2 pb-4 d-flex register-tutor-action">
                                                <div class="form-check mx-2">
                                                    <input class="form-check-input" data-action="1" type="radio" name="flexRadioDefault" id="flexRadioRegister" autocomplete="off" checked>
                                                    <label class="form-check-label" for="flexRadioRegister">
                                                        Đăng ký
                                                    </label>
                                                </div>
                                                <div class="form-check mx-2">
                                                    <input class="form-check-input" data-action="0" type="radio" name="flexRadioDefault" id="flexRadioUnregister" autocomplete="off">
                                                    <label class="form-check-label" for="flexRadioUnregister">
                                                        Huỷ đăng ký
                                                    </label>
                                                </div>
                                            </div>


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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                                <button type="button" class="btn btn-tutor-detail btn-register-add-del" data-action="1">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal review -->
                <div class="modal fade review" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog bg-gray-50">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đánh giá gia sư</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="card add-review-tutor">
                                    <div class="card-body">
                                        <h5 class="card-title">Cảm nhận của bạn về gia sư</h5>
                                        <span class="card-subtitle mb-2 text-muted">Hãy đánh giá khách quan về chất lượng, thái độ, uy tính, học phí, thời gian lên lớp của gia sư.</span>
                                        <div class="row g-0 ">

                                            <div class="col-12 mb-2">
                                                <div class="feedback">
                                                    <div class="rating">
                                                        <input type="radio" name="rating" value="5" id="rating-5">
                                                        <label for="rating-5"></label>
                                                        <input type="radio" name="rating" value="4" id="rating-4">
                                                        <label for="rating-4"></label>
                                                        <input type="radio" name="rating" value="3" id="rating-3">
                                                        <label for="rating-3"></label>
                                                        <input type="radio" name="rating" value="2" id="rating-2">
                                                        <label for="rating-2"></label>
                                                        <input type="radio" name="rating" value="1" id="rating-1">
                                                        <label for="rating-1"></label>
                                                        <div class="emoji-wrapper">
                                                            <div class="emoji">
                                                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                                                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                                                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                                                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                                                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                                                                </svg>
                                                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                    <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347" />
                                                                    <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534" />
                                                                    <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff" />
                                                                    <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347" />
                                                                    <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff" />
                                                                    <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534" />
                                                                    <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff" />
                                                                    <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347" />
                                                                    <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff" />
                                                                </svg>
                                                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                    <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347" />
                                                                    <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff" />
                                                                    <circle cx="340" cy="260.4" r="36.2" fill="#3e4347" />
                                                                    <g fill="#fff">
                                                                        <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10" />
                                                                        <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z" />
                                                                    </g>
                                                                    <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347" />
                                                                    <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff" />
                                                                </svg>
                                                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347" />
                                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                    <g fill="#fff">
                                                                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z" />
                                                                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81" />
                                                                    </g>
                                                                    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                                                    <g fill="#fff">
                                                                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1" />
                                                                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81" />
                                                                    </g>
                                                                    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                                                    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff" />
                                                                </svg>
                                                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                                                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f" />
                                                                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                                                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                                                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f" />
                                                                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                                                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347" />
                                                                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b" />
                                                                </svg>
                                                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                    <g fill="#ffd93b">
                                                                        <circle cx="256" cy="256" r="256" />
                                                                        <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z" />
                                                                    </g>
                                                                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4" />
                                                                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea" />
                                                                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88" />
                                                                    <g fill="#38c0dc">
                                                                        <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z" />
                                                                    </g>
                                                                    <g fill="#d23f77">
                                                                        <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z" />
                                                                    </g>
                                                                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347" />
                                                                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b" />
                                                                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="rating-text" class="form-label">Viết đánh giá</label>
                                                <textarea class="form-control" id="text-rating" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở lại</button>
                                <button type="button" class="btn btn-tutor-detail btn-add-review" data-action="1">Hoàn thành</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- START Pagination -->
                <nav aria-label="Page navigation">
                    <?= $register_user->getPaginatorRegisteredTutor($_GET) ?>
                </nav>
                <!-- END Pagination -->
            </div>
        </div>

    </div>
</div>
<?php


include "../inc/script.php"
?>
<script>

</script>
<?php include '../inc/footer.php' ?>