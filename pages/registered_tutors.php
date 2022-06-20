<?php

namespace Views;

use Helpers\Util;
use Library\Session;
use Classes\RegisterUser,
    Classes\AppUser,
    Classes\SubjectTopic,
    Classes\TeachingTime,
    Classes\DayOfWeek,
    Classes\TeachingSubject;

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
                                                        <li class="text-sub d-inline-flex" id="topic-register">
                                                            <span class="material-symbols-rounded " style="color: #00857c">
                                                                menu_book
                                                            </span>
                                                            <!--  -->
                                                            <?php
                                                            // $RegisterUserSubject = "";
                                                            $subjectList = $_teaching_subject->GetRegisteredUserTopic(Session::get("userId"), $_register_user["tutorId"]);
                                                            if ($subjectList) :
                                                                while ($resultSubTopic = $subjectList->fetch_assoc()) :
                                                            ?>

                                                                    <span class="subject-span m-l-10 fw-500 badge <?= $resultSubTopic['status'] === 1 ? "bg-cerulean" : "bg-secondary" ?>" data-id="<?= $resultSubTopic['id'] ?>"><?= $resultSubTopic['topicName'] ?></span>
                                                            <?php
                                                                endwhile;
                                                            endif;

                                                            // echo $RegisterUserSubject = substr($RegisterUserSubject, 0, strlen(trim($RegisterUserSubject)) - 1);
                                                            ?>
                                                            <!--  -->
                                                        </li>

                                                        <li class=" py-1 d-inline-flex">
                                                            <span class="material-symbols-rounded" style="color: #3e4359">
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
                                                                <span class="material-symbols-rounded">
                                                                    visibility
                                                                </span>

                                                            </a>
                                                        </li>
                                                        <li class="d-flex flex-row align-items-center">
                                                            <div class="mx-sm-1  register-unregister-tutor" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>" style="cursor: pointer; padding: 0.25rem 1rem !important;">

                                                                <span class="material-symbols-rounded">
                                                                    library_add_check
                                                                </span>

                                                            </div>
                                                        </li>
                                                        <li class="d-flex flex-row align-items-center">
                                                            <a class="mx-sm-1 text-reset" href="./schedule_user?tuid=<?= $_register_user["tutorId"] ?>&day=all" style="padding: 0.25rem 1rem !important;">

                                                                <span class="material-symbols-rounded">
                                                                    today
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
                                                                    <span class="material-symbols-rounded">
                                                                        visibility
                                                                    </span>
                                                                    <span class="d-block m-l-10">Xem</span>
                                                                </a>
                                                            </li>


                                                            <li class=""><a class="dropdown-item d-inline-flex" href="./schedule_user?tuid=<?= $_register_user["tutorId"] ?>&day=all">

                                                                    <span class="material-symbols-rounded">
                                                                        today
                                                                    </span>
                                                                    <!-- <img src="../public/images/icons/schedule_48px.png" class="w-24" alt="" srcset=""> -->

                                                                    <span class="d-block m-l-10">Lịch học</span>
                                                                </a></li>

                                                            <li class="">
                                                                <div class="dropdown-item register-unregister-tutor d-inline-flex" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>">
                                                                    <span class="material-symbols-rounded">
                                                                        library_add_check
                                                                    </span>
                                                                    <span class="d-block m-l-10">Đăng ký/Huỷ đăng ký</span>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                                </div>

                                                <!-- Modal Approval -->
                                                <div class="modal fade" id="approval-register-<?= $user["username"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                <input class="show-topic-register form-check-input" type="checkbox" id="flexSwitchCheck-allowSchedule-<?= $user["username"]; ?>">
                                                                                <label class=" form-check-label" for="flexSwitchCheck-allowSchedule-<?= $user["username"]; ?>">Hiển thị môn đã đăng ký</label>
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
                                                                                    <input class="form-check-input" data-action="1" type="radio" name="flexRadioDefault-<?= $user["username"]; ?>" id="flexRadioRegister-<?= $user["username"]; ?>" autocomplete="off" checked>
                                                                                    <label class="form-check-label" for="flexRadioRegister-<?= $user["username"]; ?>">
                                                                                        Đăng ký
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check mx-2">
                                                                                    <input class="form-check-input" data-action="0" type="radio" name="flexRadioDefault-<?= $user["username"]; ?>" id="flexRadioUnregister-<?= $user["username"]; ?>" autocomplete="off">
                                                                                    <label class="form-check-label" for="flexRadioUnregister-<?= $user["username"]; ?>">
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
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                                                <button type="button" class="btn btn-primary btn-register-add-del" data-action="1">Đăng ký</button>
                                                            </div>
                                                        </div>
                                                    </div>
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