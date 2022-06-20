<?php

namespace Views;

use Helpers\Util;
use Library\Session;
use Classes\RegisterUser,
    Classes\AppUser,
    Classes\SubjectTopic,
    Classes\TeachingTime,
    Classes\DayOfWeek;
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
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (Session::checkRoles(["tutor"]) !== true) {
    header("location: ./");
}

$register_user = new RegisterUser();
$_user = new AppUser();
$_subjecttopic = new SubjectTopic();
$_teaching_time = new TeachingTime();
$_day_of_week = new DayOfWeek();

$title = "Người dùng đăng ký";

include "../inc/header.php";
?>

<div class="img-float text-center d-none">
    <div class="img-container">
        <img src="" alt="" srcset="">
    </div>

    <div class="full-height"></div>

</div>
<div id="main" class="container">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mb-2 mt-2">
                <div class="section-title text-start p-2">
                    <h4 class="top-c-sep">DANH SÁCH NGƯỜI DÙNG ĐĂNG KÝ</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <div class="filter-result">
                        <p class="mb-30 ff-montserrat">Tổng cộng: <?= $register_user->countRegisteredUserByTutorId(Session::get("tutorId"))->fetch_assoc()["sum_register_user"] ?></p>
                        <?php
                        if (!$_GET) {
                            $_GET = ["limit" => 3, "page" => 1];
                        }
                        if ($_SERVER["REQUEST_METHOD"] === "GET") {



                            if (isset($_GET) && !empty($_GET)) {
                                $get_register_user = $register_user->getRegisteredUserByTutorId(Session::get("tutorId"), $_GET);
                                if ($get_register_user) {


                                    while ($_register_user = $get_register_user->data->fetch_assoc()):

                                        $status_approval = $register_user->GetApprovalRegisteredUser($_register_user["id"], Session::get("tutorId"))->fetch_assoc();
                        ?>
                                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30  position-relative <?= $status_approval["status"] === 1 ? "bg-approval" : "" ?>">
                                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                                <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                    <img src="<?= isset($_register_user["imagepath"]) ? Util::getCurrentURL(1) . "public/" . $_register_user["imagepath"] : "https://bootdey.com/img/Content/avatar/avatar5.png"; ?>" alt="." class="rounded">
                                                </div>
                                                <div class="job-content">
                                                    <h5 class="text-xs-center text-md-left fw-bold mb-md-3"><?= $_register_user["lastname"] . ' ' . $_register_user["firstname"] ?></h5>
                                                    <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                                    <ul class="d-md-flex flex-md-column flex-wrap  ff-open-sans p-0">
                                                        <li class="text-sub d-inline-flex">
                                                            <span class="material-symbols-rounded " style="color: #00857c">
                                                                menu_book
                                                            </span>
                                                            <!--  -->
                                                            <?php 
                                                            $RegisterUserSubject = "";
                                                            $subjectList = $register_user->GetRegisteredUserTopic($_register_user["id"], Session::get(("tutorId")));
                                                            while ($resultSubTopic = $subjectList->fetch_assoc()) :
                                                                // print_r($resultSubTopic);

                                                            ?>
                                                                <span class="subject-span m-l-10 fw-500 badge <?= $resultSubTopic['approval'] == 1 ? "bg-cerulean" : "bg-secondary" ?>" data-id="<?= $resultSubTopic['id'] ?>"><?= $resultSubTopic['topicName'] ?></span>
                                                            <?php
                                                            endwhile;

                                                            // echo $RegisterUserSubject = substr($RegisterUserSubject, 0, strlen(trim($RegisterUserSubject)) - 1);
                                                            ?>
                                                            <!--  -->
                                                        </li>
                                                        <li class="py-1 d-inline-flex">
                                                            <span class="material-symbols-rounded" style="color: <?= $status_approval["status"] === 1 ? "#fff" : "#3e4359" ?>">
                                                                work
                                                            </span>
                                                            <span class="d-block m-l-10 fw-500 "><?= $_register_user["job"] ?></span>
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
                                                        <li>
                                                            <div class="mx-sm-1 mx-3" data-bs-toggle="modal" data-bs-target="#user-detail-<?= $user["username"]; ?>" style="cursor: pointer"><i class="fas fa-eye me-1 fa-lg"></i> </div>
                                                        </li>
                                                        <li>
                                                            <div class="mx-sm-1  approval-register-user" data-id="<?= $user["id"] ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>" style="cursor: pointer; padding: 0.25rem 1rem !important;"><i class="fa-solid fa-user-check fa-lg"></i> </div>
                                                        </li>
                                                        <li>
                                                            <a class="mx-sm-1 text-reset" href="./schedule_tutors.php?uid=<?= $user["id"] ?>" style="padding: 0.25rem 1rem !important;"><i class="fa-solid fa-calendar-days fa-lg"></i> </a>
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
                                                            <li class="py-1">
                                                                <div class="dropdown-item d-inline-flex" data-bs-toggle="modal" data-bs-target="#user-detail-<?= $user["username"] ?>" style="cursor: pointer">
                                                                    <span class="material-symbols-rounded" style="color: #FFA500;">
                                                                        visibility
                                                                    </span>
                                                                    <span class="d-block m-l-10">Xem</span>
                                                                </div>
                                                            </li>
                                                            <li class="py-1">
                                                                <div class="dropdown-item approval-register-user d-inline-flex" data-id="<?= $user["id"] ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>">
                                                                    <span class="material-symbols-rounded" style="color: #366622;">
                                                                        handshake
                                                                    </span>
                                                                    <span class="d-block m-l-10">Duyệt</span>
                                                                </div>
                                                            </li>
                                                            <li class="py-1"><a class="dropdown-item d-inline-flex" href="./schedule_tutors?uid=<?= $user["id"] ?>">
                                                                    <span class="material-symbols-rounded" style="color: #075b97;">
                                                                        today
                                                                    </span>

                                                                    <span class="d-block m-l-10">Lịch dạy</span>
                                                                </a></li>

                                                        </ul>
                                                    </div>
                                                    <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                                </div>

                                                <!-- Modal Approval -->
                                                <div class="modal fade" id="approval-register-<?= $user["username"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg bg-gray-50">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Duyệt người dùng đã đăng ký</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="row g-0 pt-2 mb-0">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="card mx-3">
                                                                        <div class="card-body">
                                                                            <div class="form-check form-switch">
                                                                                <input class="allow-schedule form-check-input" type="checkbox" id="flexSwitchCheck-allowSchedule-<?= $user["username"]; ?>" <?= $status_approval["status"] === 1 ? "checked" : "" ?>>
                                                                                <label class=" form-check-label" for="flexSwitchCheck-allowSchedule-<?= $user["username"]; ?>">Đồng ý duyệt</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="card mx-3">
                                                                        <div class="card-body">
                                                                            <div class="form-check form-switch">
                                                                                <input class="show-status-topic form-check-input" type="checkbox" id="flexSwitchCheck-showStatusTopic-<?= $user["username"]; ?>" <?= $status_approval["status"] === 1 ? "checked" : "" ?>>
                                                                                <label class="form-check-label" for="flexSwitchCheck-showStatusTopic-<?= $user["username"]; ?>">Hiển thị môn đã duyệt</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card add-register-user">
                                                                    <div class="card-body">
                                                                        <div class="row g-0 ">
                                                                            <div class="col-12 px-1 py-2 id-register"></div>
                                                                            <div class="col-md-4 px-1 dayofweeks">


                                                                                <div class="form-group">

                                                                                    <select class="form-select teaching-day ">
                                                                                        <option value="-1">-- Thứ --</option>
                                                                                        <?php
                                                                                        $get_day_of_week = $_day_of_week->GetByTutorId(Session::get("tutorId"), 0);
                                                                                        if ($get_day_of_week) {
                                                                                            while ($day_of_week = $get_day_of_week->fetch_assoc()) {
                                                                                        ?>
                                                                                                <option value="<?= $day_of_week["id"] ?>"><?= $day_of_week["day"] ?></option>

                                                                                        <?php }
                                                                                        } ?>

                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 px-1">
                                                                                <div class="form-group">

                                                                                    <select class="form-select teaching-time">

                                                                                        <option value="0">-- Buổi học --</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 px-1">
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
                                                                <button type="button" class="btn btn-primary btn-save">Lưu</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i> 2
                                                        tuần trước</div> -->
                                        </div>

                                        <!-- Modal user detail -->
                                       
                                        <div class="modal fade" id="user-detail-<?= $user["username"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Thông tin chi tiết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <section class="ftco-section">

                                                        <div class="row justify-content-center">
                                                            <div class="col-md-11 col-lg-10">
                                                                <div class="card card-detail position-sticky" style="top: 1rem">
                                                                    <div class="card-body">

                                                                        <div class="d-flex align-items-start">
                                                                            <img src="<?= isset($user["imagepath"]) ? Util::getCurrentURL(1) . "public/" . $user["imagepath"] : "https://bootdey.com/img/Content/avatar/avatar5.png"; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                                                            <div class="w-100 ms-3 align-self-end">
                                                                                <h4 class="my-1"><?= $user["lastname"] . ' ' . $user["firstname"]; ?></h4>
                                                                                <p class="text-muted">@id: <?= $user["username"]; ?></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mt-3">

                                                                            <h4 class="font-13 text-uppercase">Thông tin người đăng ký:</h4>


                                                                            <p class="text-muted mb-2 font-13"><strong>Họ và tên: </strong>
                                                                                <span class="ms-2"><?= $user["lastname"] . ' ' . $user["firstname"]; ?></span>
                                                                            </p>

                                                                            <p class="text-muted mb-2 font-13"><strong>Giới tính: </strong> <span class="ms-2"><?= $user["sex"] == 1 ?  "Nam" :  "Nữ"; ?></span></p>

                                                                            <p class="text-muted mb-2 font-13"><strong>Số điện thoại: </strong><span class="ms-2"> <?= $user["phonenumber"]; ?> (zalo)</span></p>

                                                                            <p class="text-muted mb-2 font-13"><strong>Email: </strong> <span class="ms-2"> <?= $user["email"]; ?></span></p>

                                                                            <p class="text-muted mb-2 font-13"><strong>Hiện tại là: </strong> <span class="ms-2"> <?= $user["job"]; ?></span></p>

                                                                            <p class="text-muted mb-1 font-13"><strong>Nơi ở hiện tại: </strong> <span class="ms-2"><?= $user["address"]; ?></span></p>

                                                                            <p class="text-muted mb-1 font-13"><strong>Môn học đăng kí: </strong>

                                                                                <span class="ms-2">
                                                                                    <?php
                                                                                    $subjectList = $register_user->GetRegisteredUserTopic($_register_user["id"], Session::get(("tutorId")));
                                                                                    while ($resultSubTopic = $subjectList->fetch_assoc()) {
                                                                                    ?>
                                                                                        <span class="badge bg-dark"><?= $resultSubTopic['topicName'] ?></span>

                                                                                    <?php
                                                                                    }

                                                                                    // echo $RegisterUserSubject = substr($RegisterUserSubject, 0, strlen(trim($RegisterUserSubject)) - 1);
                                                                                    ?>
                                                                                </span>
                                                                            </p>

                                                                        </div>


                                                                    </div>

                                                                </div> <!-- end card -->
                                                            </div>

                                                        </div>
                                                    </section>
                                                </div>
                                            </div>



                                        </div>
                                    <?php } ?>

                    <?php
                                    endwhile;
                                }
                            }
                        }
                    ?>
                    </div>
                </div>




                <!-- START Pagination -->
                <nav aria-label="Page navigation">
                    <?= $register_user->getPaginatorRegisteredUser($_GET) ?>
                </nav>
                <!-- END Pagination -->
            </div>
        </div>

    </div>
</div>







<?php include "../inc/script.php" ?>

<script>
   
</script>
<?php include '../inc/footer.php' ?>