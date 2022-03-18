<?php
namespace Views;
use Helpers\Util, Helpers\Format;
use Library\Session;
use Classes\SavedTutor, Classes\Subject;
?>
<!DOCTYPE html>
<html lang="en">

<?php



$title = "Gia sư đã lưu";
include "../inc/head.php";
include "../classes/savedtutors.php";
include "../classes/subjects.php";
include "../lib/session.php";
include "../helpers/format.php";
include_once "../helpers/utilities.php";




if (Session::checkRoles(["tutor", "user"]) !== true) {
    header("location: errors/404"); 
}

// echo in_array( ["user"], Session::get("roles")[0]);

?>

<body>
    <div class="container-fluid">
        <header class="row g-0 m-0">

            <?php
            $nav_tutor_active = "active";
            include "../inc/header.php"
            ?>

        </header>
        <div id="main" class="container ">
            <div class="row mt-2 ">
                <div class="col-lg-10 mx-auto  mb-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="./list_Tutor.php">Danh sách gia sư</a></li>
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
                                                        <img src="<?=  Util::getCurrentURL() ."/../" . $tutor["imagepath"] ?>" alt=".">
                                                    </div>
                                                    <div class="job-content">
                                                        <h5 class="text-xs-center text-md-left"><?= $tutor["lastname"] . ' ' . $tutor["firstname"] ?></h5>
                                                        <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                                        <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                            <li class="text-sub">
                                                                <?= $tutor["teachingarea"] ?> | <?php $subjectTutors = "";
                                                                                                $subjectList = $subjects->getByTutorId($tutor['id']);
                                                                                                while ($resultSB = $subjectList->fetch_assoc()) {
                                                                                                    $subjectTutors .= $resultSB['subject'] . ', ';
                                                                                                }

                                                                                                echo $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?= $tutor["job"] ?>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="d-md-none d-block pb-4 pb-md-0">
                                                    <ul class="d-flex justify-content-end ">
                                                        <li><a class="text-reset text-decoration-none" href="tutor_details.php?id=<?= Format::validation($tutor["id"])?>"><i class="fas fa-eye me-1"></i> Xem</a></li>
                                                        <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fas fa-heart-broken"></i> Huỷ lưu</a></li>

                                                    </ul>
                                                </div>
                                                <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item tutor-detail-link"  href="tutor_details.php?id=<?= Format::validation($tutor["id"])?>"><i class="fas fa-eye me-1"></i> Xem</a>
                                                            </li>
                                                            <li><a class="dropdown-item unsave-tutor" data-href="<?= Format::validation($tutor["id"])?>"><i class="fas fa-heart-broken me-1"></i> Huỷ
                                                                    lưu</a></li>

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
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>
    </div>
    <?php include "../inc/script.php" ?>
    <script>
         $(document).ready(function() {
            $(".unsave-tutor").on('click', (e) => {
                e.preventDefault();
    
                const tutorId =  $(e.target).attr("data-href");
                
                console.log(tutorId,  $(e.target).attr("data-href"));
                $.ajax({
                    type: "post",
                    url: "../ajax/unsaved_tutors.php",
                    data: {
                        userId: "<?= Session::get("userId") ?>" ,
                        tutorId: tutorId
                    },
                    cache: false,
                    success: function (data) {

                        // $("#save-tutor").replaceWith(data);
                        $(e.target).closest(".job-box").remove();
                        console.log(data, "data")
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr, error, status, "Lỗi");
                    }
                });
            });
        });
    </script>
    
</body>

</html>