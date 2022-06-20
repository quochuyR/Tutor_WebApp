<?php

namespace Views;

use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\SavedTutor, Classes\Subject;
require_once(__DIR__ . "../../vendor/autoload.php");

// include "../classes/savedtutors.php";
// include "../classes/subjects.php";
// include "../lib/session.php";
// include "../helpers/format.php";
// include_once "../helpers/utilities.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (!Session::checkRoles(["user", "tutor"])) {
    header("location: ./");
    // print_r(Session::get("roles"));
}

$title = "Gia sư đã lưu";

include "../inc/header.php"
?>


<div id="main" class="container ">
    <div class="row mt-2 ">
        <div class="col-lg-10 mx-auto  mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="./list_Tutor">Danh sách gia sư</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gia sư đã lưu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-start ">
                <h3 class="top-c-sep">Danh sách gia sư đã lưu</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">

                <div class="filter-result">
                    <?php
                    $tutor_saved = new SavedTutor();
                    $subjects = new Subject();
                    $userId = Session::get("userId");
                    if (!$_GET) {
                        $_GET = ["limit" => 3, "page" => 1];
                    }
                    if ($_SERVER["REQUEST_METHOD"] === "GET") {



                        if (isset($_GET) && !empty($_GET)) {


                            $_tutor = $tutor_saved->getTutorSavedByUserId($userId, $_GET);
                            if ($_tutor->data) {
                    ?>

                                <p class="mb-30 ff-montserrat">Tổng cộng: <?= $_tutor->data->num_rows ?></p>
                                <?php
                                while ($tutor = $_tutor->data->fetch_assoc()) {
                                ?>

                                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30  position-relative">
                                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                            <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                <img src="<?= Util::getCurrentURL(1) . "public/" . $tutor["imagepath"] ?>" alt=".">
                                            </div>
                                            <div class="job-content">
                                                <h5 class="text-xs-center text-md-left fw-bold"><?= $tutor["lastname"] . ' ' . $tutor["firstname"] ?></h5>

                                                <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                    <li class="text-sub d-inline-flex">
                                                        <span class="material-symbols-rounded" style="color: #131311 !important;">
                                                            house
                                                        </span>
                                                        <span class="text-muted m-l-10 pt-1 fw-500">
                                                            <?= $tutor["teachingarea"] ?> | <?php $subjectTutors = "";
                                                                                            $subjectList = $subjects->getByTutorId($tutor['id']);
                                                                                            while ($resultSB = $subjectList->fetch_assoc()) {
                                                                                                $subjectTutors .= $resultSB['subject'] . ', ';
                                                                                            }

                                                                                            echo $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                                                                                            ?>
                                                        </span>
                                                    </li>
                                                    <li class="d-inline-flex">
                                                        <span class="material-symbols-rounded" style="color: #3e4359">
                                                            work
                                                        </span>
                                                        <span class="text-muted m-l-10 pt-1 fw-500">
                                                            <?= isset($tutor["job"]) ? $tutor["job"]: "Chưa có thông tin"; ?>
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-md-none d-block pb-4 pb-md-0">
                                            <ul class="d-flex justify-content-end ">
                                                <li><a class="text-reset text-decoration-none" href="tutor_details?id=<?= Format::validation($tutor["id"]) ?>"><i class="fas fa-eye me-1"></i> Xem</a></li>
                                                <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fas fa-heart-broken"></i> Huỷ lưu</a></li>

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
                                                    <li>
                                                        <a class="dropdown-item tutor-detail-link d-inline-flex" href="tutor_details?id=<?= Format::validation($tutor["id"]) ?>">
                                                            <span class="material-symbols-rounded">
                                                                visibility
                                                            </span>
                                                            <span class="d-block m-l-10">Xem</span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item unsave-tutor d-inline-flex" data-href="<?= Format::validation($tutor["id"]) ?>">
                                                            <span class="material-symbols-rounded text-danger">
                                                                heart_broken
                                                            </span>
                                                            <span class="d-block m-l-10"> Huỷ lưu</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                        </div>

                                        <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i>
                                            <?= Format::time_elapsed_string($tutor["saveddate"]) ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }

                            ?>

                </div>
            </div>

            <!-- START Pagination -->
            <nav aria-label="Page navigation">
                <?= $tutor_saved->getPaginatorSavedTT($_GET); ?>
            </nav>

    <?php

                        }
                    }
    ?>
    <!-- END Pagination -->
        </div>
    </div>


</div>





<?php include "../inc/script.php" ?>
<script>
   
</script>

<?php include '../inc/footer.php' ?>