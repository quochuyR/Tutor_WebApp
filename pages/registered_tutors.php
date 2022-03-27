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
?>
<!DOCTYPE html>
<html lang="en">

<?php

$title = "Người dùng đăng ký";
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "../../inc/head.php";
include_once $filepath . "../../lib/session.php";
include_once $filepath . "../../helpers/utilities.php";
include_once $filepath . "../../helpers/format.php";
include_once $filepath . "../../classes/registerusers.php";
include_once $filepath . "../../classes/appusers.php";
include_once $filepath . "../../classes/dayofweeks.php";
include_once $filepath . "../../classes/subjecttopics.php";
include_once $filepath . "../../classes/teachingtimes.php";
include_once $filepath . "../../classes/teachingsubjects.php";



?>

<?php
if (Session::checkRoles(["user"]) !== true) {
    header("location: errors/404");
}

$register_user = new RegisterUser();
$_user = new AppUser();
$_subjecttopic = new SubjectTopic();
$_teaching_time = new TeachingTime();
$_day_of_week = new DayOfWeek();
$_teaching_subject = new TeachingSubject();

?>


<body>
    <!-- Hiển thị hình ảnh rõ hơn khi click -->

    <div class="img-float text-center d-none">
        <div class="img-container">
            <img src="" alt="" srcset="">
        </div>

        <div class="full-height"></div>

    </div>
    <!--  -->
    <div class="container-fluid d-flex flex-column">
        <header class="row g-0 m-0">

            <?php

            include "../inc/header.php";
            ?>

        </header>
        <div id="main" class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto mb-2 mt-2">
                        <div class="section-title text-start bg-success p-2">
                            <h4 class="top-c-sep text-white">DANH SÁCH GIA SƯ ĐĂNG KÝ</h4>
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
                                                            <img src="<?= Util::getCurrentURL() . "/../public/"  . $_register_user["imagepath"] ?>" alt="." class="rounded">
                                                        </div>
                                                        <div class="job-content">
                                                            <h5 class="text-xs-center text-md-left fw-bold"><?= $_register_user["lastname"] . ' ' . $_register_user["firstname"] ?></h5>
                                                            <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                                            <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                                <li class="text-sub text-muted">
                                                                    <i class="fa-solid fa-book pe-1"></i>
                                                                    <!--  -->
                                                                    <?php
                                                                    // $RegisterUserSubject = "";
                                                                    $subjectList = $_teaching_subject->GetRegisteredUserTopic(Session::get("userId"), $_register_user["tutorId"]);
                                                                    while ($resultSubTopic = $subjectList->fetch_assoc()) {
                                                                    ?>

                                                                        <span class="subject-span <?= $resultSubTopic['status'] === 1 ? "text-success" : "" ?>" data-id="<?= $resultSubTopic['id'] ?>"><?= $resultSubTopic['topicName'] ?></span> |
                                                                    <?php
                                                                    }

                                                                    // echo $RegisterUserSubject = substr($RegisterUserSubject, 0, strlen(trim($RegisterUserSubject)) - 1);
                                                                    ?>
                                                                    <!--  -->
                                                                </li>
                                                                <li class="text-muted py-1">
                                                                    <i class="fa-solid fa-user-graduate"></i> <?= $_register_user["currentjob"] ?>
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
                                                                    <a class="mx-sm-1 mx-3 text-reset" href="../pages/tutor_details.php?id=<?= $_register_user["tutorId"] ?>"><i class="fas fa-eye me-1 fa-lg"></i> </a>
                                                                </li>
                                                                <li>
                                                                    <div class="mx-sm-1  approval-register-user" data-id="<?= $user["id"] ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>" style="cursor: pointer; padding: 0.25rem 1rem !important;"><i class="fa-solid fa-user-check fa-lg"></i> </div>
                                                                </li>
                                                                <li>
                                                                    <a class="mx-sm-1 text-reset" href="./schedule_user.php?tuid=<?= $_register_user["tutorId"] ?>&day=all" style="padding: 0.25rem 1rem !important;"><i class="fa-solid fa-calendar-days fa-lg"></i> </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    <li class="py-1">
                                                                        <a class="dropdown-item" href="../pages/tutor_details.php?id=<?= $_register_user["tutorId"] ?>"><i class="fas fa-eye pe-2"></i> Xem</a>
                                                                    </li>


                                                                    <li class="py-1"><a class="dropdown-item" href="./schedule_user.php?tuid=<?= $_register_user["tutorId"] ?>&day=all"><i class="fa-solid fa-calendar-days pe-3"></i>Lịch học</a></li>
                                                                    <li class="py-1">
                                                                        <div class="dropdown-item register-unregister-tutor" data-id="<?= $_register_user["tutorId"]; ?>" data-bs-toggle="modal" data-bs-target="#approval-register-<?= $user["username"]; ?>"><i class="fa-solid fa-user-plus pe-2"></i>Đăng ký/Huỷ đăng ký</div>
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
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>
    </div>


    <?php include "../inc/script.php" ?>

    <script>
        (function() {
            $(document).ready(() => {
                OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký
                


                function onChangeActionRadio(){
                    $(`.form-check-input[type="radio"]`).on('change', (e) => { // disable input checkbox khi thay đổi
                    if (e.currentTarget.checked) {
                        $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del") // Tìm nơi chứa select thêm lịch dạy cho người dùng
                                                                    .text($(e.currentTarget)
                                                                    .next(".form-check-label").text());

                        $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del")
                                                                    .attr("data-action", $(e.currentTarget).attr("data-action"))

                                                    
                        // và disable nó 
                    }
                });

                }
                
                function onChangeShowTopic(event_approval) {

                    $(".show-topic-register").on('change', () => {

                        getSubjectRegisterUser(event_approval);
                    });

                }

                


                

                
               

                function OnClickApprovalRegisterUser() {
                    $(".register-unregister-tutor").on('click', (e) => {

                        getSubjectRegisterUser(e);
                        onChangeShowTopic(e);
                        onChangeActionRadio();
                        onClickAddOrDel(e);
                    });
                }

                function onClickAddOrDel(event_approval) {
                    $(".btn-register-add-del").on('click', (e) => {
                       
                        addOrDelRegisterTutor(event_approval, e);
                    });
                }

               
                function getSubjectRegisterUser(e) {
                    let tutorId = $(e.currentTarget).attr("data-id");
                    let id_approval = $(e.currentTarget).attr("data-bs-target");
                    let subject = $(id_approval).find(`.teaching-subject`);

                    let status = $(id_approval).find(".show-topic-register.form-check-input").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

                    console.log([tutorId, id_approval, subject, status])
                    $.ajax({
                        type: "post",
                        url: "../api/getsubjecttutor.php",
                        data: {
                            tutorId,
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

                function addOrDelRegisterTutor(event_approval, event_target) {
                    let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
                    let tuId = $(event_approval.currentTarget).attr("data-id");
                    let action = $(event_target.currentTarget).attr("data-action");
                    let topicId = $(id_modal).find(`select`);

                    console.log([action, tuId, topicId])

                    $.ajax({
                        type: "post",
                        url: "../api/addordeleteregistertutor.php",
                        data: {
                            tuId,
                            action,
                            topicId : $(topicId).val(),

                        },
                        cache: false,
                        success: function(data) {
                           
                            if (data.insert === 'successful'){
                                alert(`Đăng ký môn học ${data.topicName } thành công. Hãy chờ gia sư liên hệ với bạn.`)
                                getSubjectRegisterUser(event_approval); // refresh topic when insert success
                            }
                                
                            else if (data.delete === 'successful'){
                                alert(`Huỷ đăng ký môn học ${data.topicName } thành công.`);
                                getSubjectRegisterUser(event_approval); // refresh topic when delete success
                            }


                            console.log(data, "insert3")
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                }
            });
        })();
    </script>

</body>

</html>