<?php

namespace Views;

use Helpers\Util;
use Library\Session;
use Classes\RegisterUser,
    Classes\AppUser,
    Classes\SubjectTopic,
    Classes\TeachingTime,
    Classes\DayOfWeek;


$filepath = realpath(dirname(__FILE__));
include_once $filepath . "../../lib/session.php";
include_once $filepath . "../../helpers/utilities.php";
include_once $filepath . "../../helpers/format.php";
include_once $filepath . "../../classes/registerusers.php";
include_once $filepath . "../../classes/appusers.php";
include_once $filepath . "../../classes/dayofweeks.php";
include_once $filepath . "../../classes/subjecttopics.php";
include_once $filepath . "../../classes/teachingtimes.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (Session::checkRoles(["tutor"]) !== true) {
    header("location: ./");
}
?>


<?php


$register_user = new RegisterUser();
$_user = new AppUser();
$_subjecttopic = new SubjectTopic();
$_teaching_time = new TeachingTime();
$_day_of_week = new DayOfWeek();

?>



<!-- Hiển thị hình ảnh rõ hơn khi click -->


<!--  -->


<?php
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
                                                    <img src="<?= Util::getCurrentURL(1) . "public/"  . $_register_user["imagepath"] ?>" alt="." class="rounded">
                                                </div>
                                                <div class="job-content">
                                                    <h5 class="text-xs-center text-md-left fw-bold"><?= $_register_user["lastname"] . ' ' . $_register_user["firstname"] ?></h5>
                                                    <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                                    <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                        <li class="text-sub d-inline-flex">
                                                            <span class="material-symbols-rounded " style="color: #00857c">
                                                                menu_book
                                                            </span>
                                                            <!--  -->
                                                            <?php 
                                                            $RegisterUserSubject = "";
                                                            $subjectList = $register_user->GetRegisteredUserTopic($_register_user["id"], Session::get(("tutorId")));
                                                            while ($resultSubTopic = $subjectList->fetch_assoc()) :
                                                            ?>

                                                                <span class="subject-span m-l-10 fw-500 badge <?= $resultSubTopic['approval'] === 1 ? "bg-cerulean" : "bg-secondary" ?>" data-id="<?= $resultSubTopic['id'] ?>"><?= $resultSubTopic['topicName'] ?></span>
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
                                                                            <img src="<?= Util::getCurrentURL(1) . "public/"  . $user["imagepath"]; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
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
    (function() {
        $(document).ready(() => {
            OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký
            OnchangeSelectDoW(); // khi thứ thay đổi (được chọn)

            $(".allow-schedule.form-check-input").on('change', (e) => { // disable input checkbox khi thay đổi
                if (!e.currentTarget.checked) {
                    $(e.currentTarget).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                    // và disable nó 
                } else {
                    $(e.currentTarget).closest(".modal-content").find("select").prop("disabled", false)
                }
            });


            //

            function onChangeTopic(event_approval) {
                $(".teaching-subject").off();
                $(".teaching-subject").on('change', (event_target) => {
                    getIdRegisterUser(event_approval, event_target);
                })
            }


            //

            // thay đổi hiển thị môn học duyệt hay chưa
            function onChangeStatusApproval(event_approval) {
                $(".show-status-topic").off();
                $(".show-status-topic").on('click', () => {
                    getSubjectRegisterUser(event_approval);
                });
            }

            //

            function OnchangeSelectDoW() {
                $(".teaching-day").on('change', (e) => {

                    getTimeFromDay(e);
                });
            }

            function onChangeFlexSwitch() {
                $(".allow-schedule.form-check-input").off();
                $(".allow-schedule.form-check-input").each((i, select) => { // disable input checkbox khi thay đổi
                    if (!$(select).prop("checked")) {
                        $(select).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                        // và disable nó 
                    } else {
                        $(select).closest(".modal-content").find("select").prop("disabled", false)
                    }
                });
            }

            function OnClickApprovalRegisterUser() {
                $(".approval-register-user").on('click', (e) => {
                    getSubjectRegisterUser(e);
                    getStatusRegisterUser(e);
                    onChangeFlexSwitch(e);
                    onChangeTopic(e);
                    onChangeStatusApproval(e);
                    onClickSave(e);
                });
            }

            function onClickSave(event_approval) {
                $(".btn-save").off();
                $(".btn-save").on('click', () => {
                    addSchedule(event_approval);
                });
            }

            function getStatusRegisterUser(e) {
                let id_modal = $(e.currentTarget).attr("data-bs-target");
                let switch_status = $(id_modal).find(`.allow-schedule.form-check-input`);
                let id = $(e.currentTarget).attr("data-id");
                // console.log(switch_status, id_modal)

                if (!$(switch_status).prop("checked")) {
                    $(switch_status).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                    // và disable nó 
                } else {
                    $(switch_status).closest(".modal-content").find("select").prop("disabled", false)
                }

                $.ajax({
                    type: "post",
                    url: "../api/getstatusregisteruser",
                    data: {
                        id,

                    },
                    cache: false,
                    success: function(data) {

                        $(switch_status).prop("checked", data.status === 1 ? true : false)

                        console.log(data, "dât")
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }

            function getIdRegisterUser(event_approval, event_target) {
                let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
                let id_register = $(id_modal).find(`.id-register`);
                let id = $(event_approval.currentTarget).attr("data-id");
                let topicId = $(event_target.currentTarget).val();

                let status = $(id_modal).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

                // console.log(id, topicId, "id")
                console.log(id_register, "id_register")


                $.ajax({
                    type: "post",
                    url: "../api/getregisteridbytopicid",
                    data: {
                        id,
                        topicId,
                        status

                    },
                    cache: false,
                    success: function(data) {
                        if (data.registerId) {
                            $(id_register).html("@id: " + data.registerId);
                            $(id_register).attr("data-id", data.registerId);
                        } else $(id_register).html("@id: không có");

                        console.log(data, "dât2")
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }


            function getTimeFromDay(e) {

                let dayofweek = $(e.currentTarget).val();
                let index = $(".teaching-day").index(e.currentTarget);

                $.ajax({
                    type: "post",
                    url: "../api/getTimeFromDay",
                    data: {
                        dayofweek,

                    },
                    cache: false,
                    success: function(data) {

                        $(".teaching-time").eq(index).html(data);

                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }

            function getDaySchedule(e) {
                let id_modal = $(e.currentTarget).attr("data-bs-target");
                let dayofweek = $(id_modal).find(`select`).eq(0);


                $.ajax({
                    type: "post",
                    url: "../api/getdayschedule",
                    data: {
                        action: "getDay",

                    },
                    cache: false,
                    success: function(data) {

                        dayofweek.html(data);

                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }

            function getSubjectRegisterUser(e) {
                let userId = $(e.currentTarget).attr("data-id");
                let id_approval = $(e.currentTarget).attr("data-bs-target");
                let subject = $(id_approval).find(`select`).eq(2);

                let status = $(id_approval).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

                $.ajax({
                    type: "post",
                    url: "../api/getsubjectregisteruser",
                    data: {
                        userId,
                        status

                    },
                    cache: false,
                    success: function(data) {

                        subject.html(data);

                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }

            function addSchedule(event_approval) {
                let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
                let id = $(id_modal).find(".id-register").attr("data-id");
                let status = $(id_modal).find(`input[type="checkbox"]`).prop("checked") ? 1 : 0;
                let DoW_id = $(id_modal).find(`select`).eq(0).val();
                let timeId = $(id_modal).find(`select`).eq(1).val();
                let topicId = $(id_modal).find(`select`).eq(2).val();

                // console.log([id, status, DoW_id, timeId, topicId])

                $.ajax({
                    type: "post",
                    url: "../api/addscheduleuser",
                    data: {
                        id,
                        status,
                        DoW_id,
                        topicId,
                        timeId

                    },
                    cache: false,
                    success: function(data) {
                        // if (data.registerId) {
                        //     $(id_register).html("@id: " + data.registerId);
                        //     $(id_register).attr("data-id", data.registerId);
                        // } else $(id_register).html("@id: không có");
                        if (data.status === '1') {
                            $(id_modal).closest(".job-box").addClass("bg-approval");
                            // 
                            Toastify({
                                text: `Duyệt thành công. Bạn đã duyệt thành công môn ${$(id_modal).find(`select option:selected`).eq(2).text()}`,
                                duration: 3000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "linear-gradient(to right, #C73866, #FE676E)",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();

                        } else if (data.status === '0') {
                            $(id_modal).closest(".job-box").removeClass("bg-approval");

                            // 
                            Toastify({
                                text: `Huỷ duyệt thành công.`,
                                duration: 3000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "linear-gradient(to right, #C73866, #FE676E)",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        }

                        if (data.action === "successful") {
                            $(id_modal).closest(".job-box").find(".subject-span").each((i, span) => {
                                if ($(span).attr("data-id") === topicId) {
                                    $(span).addClass("text-success");
                                }
                            });
                            //
                            Toastify({
                                text: `Thêm lịch dạy thành công.`,
                                duration: 3000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "linear-gradient(to right, #C73866, #FE676E)",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        }


                        console.log(data, "update2")
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }
        });
    })();
</script>
<?php include '../inc/footer.php' ?>