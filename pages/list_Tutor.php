<?php

namespace Views;

use Classes\Tutor, Classes\Subject, Classes\SubjectTopic, Library\Session;

require_once(__DIR__ . "../../vendor/autoload.php");

// include_once "../classes/topics.php";
// include_once "../classes/subjecttopics.php";
// include_once "../classes/tutors.php";
// include_once "../classes/subjects.php";
// include_once "../classes/paginator.php";
// include_once "../lib/session.php";

Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
?>
<?php
$title = "Danh sách gia sư";
$nav_tutor_active = "active";
include "../inc/header.php";
?>
<div id="main" class="container ">

    <div class="wrapper ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách gia sư</li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-center" style="background-image: linear-gradient(to right, #2C6975, #68B2A0)">
            <div class="fw-bold p-2 text-white">DANH SÁCH GIA SƯ</div>

        </div>
        <!-- <div class="d-lg-flex align-items-lg-center">
                    <div class="form-inline d-flex align-items-center my-2 mr-lg-2 radio bg-light border">
                        <label class="options">Xem nhiều nhất
                            <input type="radio" name="radio" checked>
                            <span class="checkmark"></span>
                        </label>

                        <label class="options">Đánh giá tốt nhất
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>

                        </label>

                        <label class="options">Học phí tốt nhất
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>

                    </div>




                </div> -->
        <!-- Chổ lọc -->
        <input type="hidden" id="token" value="<?= Session::get("csrf_token") ?>" />

        <div class="d-sm-flex align-items-sm-center pt-2 clear" id="filter">
            <div class="text-muted filter-label">Lọc theo:</div>
            <div class="green-label green-label-filter font-weight-bold p-0 px-1 mx-sm-1 mx-0 my-sm-0 my-2" value="Tất cả">Tất cả<span class="px-1 close ">&times;</span> </div>

        </div>
        <div class="filter">

            <button class="btn btn-success d-inline-flex justify-content-center" type="button" data-bs-toggle="collapse" data-bs-target="#mobile-filter" aria-expanded="false" aria-controls="mobile-filter">
                <span class="">Lọc</span>
                <span class="material-symbols-rounded">
                    filter_alt
                </span>
            </button>

        </div>

        <!-- Mobile filter -->
        <div class="collapse " id="mobile-filter">
            <div class="py-3">
                <h5 class="font-weight-bold">Môn học</h5>
                <ul class="list-group " style="max-height: 20rem;overflow-y:scroll;" id="filter-subject">
                    <?php
                    $tutors = new Tutor();
                    $subjects = new Subject();
                    $SBtopic = new SubjectTopic();

                    $SBtopicList = $SBtopic->CountByTutor();
                    if ($SBtopicList) :
                        print_r( $SBtopic->countAllTutorRegisteredTopic()->fetch_row())
                    ?>

                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category subject-active checkbox-filter" subject-id="0" value="Tất cả"> Tất cả
                            <span class="badge badge-primary badge-pill"><?= $SBtopic->countAllTutorRegisteredTopic()->fetch_assoc()["sum_all_tutor"] ?></span>
                        </li>
                        <?php
                        while ($result = $SBtopicList->fetch_assoc()) :
                        ?>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category checkbox-filter" subject-id="<?= $result['id'] ?>" value="<?= $result['subject'] ?>">
                                <?= $result['subject'] ?> <span class="badge badge-primary badge-pill"><?= $result['sum_tutor'] ?></span> </li>
                    <?php
                        endwhile;
                    endif;

                    ?>

                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="py-3">
                        <h5 class="font-weight-bold">Chủ đề</h5>
                        <form class="brand topic-container">

                        </form>
                    </div>
                    <div class="py-3">
                        <h5 class="font-weight-bold">Hình thức dạy</h5>
                        <form class="brand">
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Gặp mặt (Offline)">Gặp mặt (Offline)<input type="checkbox" class="teachingForm checkbox-filter" value="0">
                                    <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Trực tuyến (Online)">Trực tuyến (Online)<input type="checkbox" class="teachingForm checkbox-filter" value="1"> <span class="check"></span> </label> </div>


                        </form>
                    </div>




                    <div class="py-3">
                        <h5 class="font-weight-bold">Giới tính</h5>
                        <form class="brand">
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Nam">Nam<input type="checkbox" value="1" class="sex checkbox-filter"> <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Nữ">Nữ<input type="checkbox" value="0" class="sex checkbox-filter"> <span class="check"></span> </label> </div>

                        </form>
                    </div>


                    <div class="py-3">
                        <h5 class="font-weight-bold">Kiểu</h5>
                        <form class="brand">

                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Giáo viên">Giáo viên<input type="checkbox" class="type checkbox-filter" value="Giáo viên"> <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Sinh viên">Sinh viên<input type="checkbox" class="type checkbox-filter" value="Sinh viên">
                                    <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Chuyên gia">Chuyên gia<input type="checkbox" class="type checkbox-filter" value="Chuyên gia">
                                    <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Người đi làm">Người đi làm<input type="checkbox" class="type checkbox-filter" value="Người đi làm">
                                    <span class="check"></span> </label> </div>
                            <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Người nước ngoài">Người nước ngoài<input type="checkbox" class="type checkbox-filter" value="Người nước ngoài"> <span class="check"></span> </label> </div>



                        </form>
                    </div>
                </div>
            </div>


        </div>

        <!-- Lọc trên web -->
        <div class="content py-md-0 py-3">
            <section id="sidebar">

                <div class="py-3">
                    <h5 class="font-weight-bold mb-1">Môn học</h5>
                    <ul class="list-group" style="max-height: 20rem;overflow-y:scroll;" id="filter-subject">
                        <?php

                        $SBtopicList = $SBtopic->CountByTutor();
                        if ($SBtopicList) :
                        ?>


                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category subject-active checkbox-filter" subject-id="0" value="Tất cả"> Tất cả
                                <span class="badge badge-primary badge-pill">
                                    <?= $SBtopic->countAllTutorRegisteredTopic()->fetch_assoc()["sum_all_tutor"]; ?>
                                </span>
                            </li>
                            <?php
                            while ($result = $SBtopicList->fetch_assoc()) :
                            ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category checkbox-filter" subject-id="<?= $result['id']; ?>" value="<?= $result['subject']; ?>">
                                    <?= $result['subject']; ?>
                                    <span class="badge badge-primary badge-pill"><?= $result['sum_tutor']; ?></span>
                                </li>
                        <?php endwhile;
                        endif;

                        ?>


                    </ul>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="py-3">
                            <h5 class="font-weight-bold">Chủ đề</h5>
                            <form class="brand topic-container">
                                <div>Chọn môn học mới hiện chủ đề</div>
                            </form>
                        </div>

                        <div class="py-3">
                            <h5 class="font-weight-bold">Hình thức dạy</h5>
                            <form class="brand">
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Gặp mặt (Offline)">Gặp mặt (Offline)<input type="checkbox" class="teachingForm checkbox-filter" value="0">
                                        <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Trực tuyến (Online)">Trực tuyến (Online)<input type="checkbox" class="teachingForm checkbox-filter" value="1"> <span class="check"></span> </label> </div>

                            </form>
                        </div>


                        <div class="py-3">
                            <h5 class="font-weight-bold">Giới tính</h5>
                            <form class="brand">
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Nam">Nam<input type="checkbox" value="1" class="sex checkbox-filter"> <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Nữ">Nữ<input type="checkbox" value="0" class="sex checkbox-filter"> <span class="check"></span> </label> </div>

                            </form>
                        </div>


                        <div class="py-3">
                            <h5 class="font-weight-bold">Kiểu</h5>
                            <form class="brand">
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Giáo viên">Giáo viên<input type="checkbox" class="type checkbox-filter" value="Giáo viên"> <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Sinh viên">Sinh viên<input type="checkbox" class="type checkbox-filter" value="Sinh viên">
                                        <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Chuyên gia">Chuyên gia<input type="checkbox" class="type checkbox-filter" value="Chuyên gia">
                                        <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Người đi làm">Người đi làm<input type="checkbox" class="type checkbox-filter" value="Người đi làm">
                                        <span class="check"></span> </label> </div>
                                <div class="form-inline d-flex align-items-center py-1"> <label class="tick" data-value="Người nước ngoài">Người nước ngoài<input type="checkbox" class="type checkbox-filter" value="Người nước ngoài"> <span class="check"></span> </label> </div>

                            </form>
                        </div>
                    </div>
                </div>





            </section> <!-- tutors Section -->
            <section id="tutors">
                  <!-- scroll to top -->
                  <div id="top-filter"></div>
                <div class="container py-3">
                  

                    <div class="row g-0">
                        <div class="col-12 pb-4  d-flex justify-content-end">
                            
                            <nav aria-label="Page navigation example " id="pagination-nav" class="mt-3">
                            </nav>
                        </div>
            </section>
        </div>
    </div>

</div>
<?php


include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>