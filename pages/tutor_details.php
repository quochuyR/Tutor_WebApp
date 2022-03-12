<!DOCTYPE html>
<html lang="en">

<?php
$title = "Thông tin gia sư";
include "../inc/head.php";

include_once "../classes/tutors.php";
include_once "../classes/subjects.php";
include_once "../classes/dayofweeks.php";
include_once "../classes/days.php";
include_once "../classes/teachingtimes.php";
include_once "../classes/savedtutors.php";
include_once "../helpers/format.php";
?>

<?php

if (!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] === null) {
    echo "Không có trang này";
} else {
    $id = Format::validation($_GET["id"]);
}

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
            <!-- Hiển thị hình ảnh rõ hơn khi click -->

            <div class="img-float text-center d-none">
                <img src="" alt="" srcset="">
                <div class="full-height"></div>

            </div>

            <!-- Main -->
            <div class="container">
                <div class="row">

                    <?php
                    $tutors = new Tutor();
                    $subjects = new Subject();
                    $dayofweeks = new DayOfWeek();
                    $days = new Day();
                    $teachingtimes = new TeachingTime();
                    $saved_tutor = new SavedTutor();

                    $detail_tutor = $tutors->getTutorDetail($id)->fetch_all(MYSQLI_ASSOC);

                    foreach ($detail_tutor as $result) :


                    ?>
                        <div class="col-xl-4 col-md-5">
                            <div class="card card-detail position-sticky" style="top: 0">
                                <div class="card-body">

                                    <div class="d-flex align-items-start">
                                        <img src="<?= Util::getCurrentURL() ."/../". $result["imagepath"]; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" onclick="ShowImg(this.src);">
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

                                        <h4 class="font-13 text-uppercase">Thông tin gia sư:</h4>
                                        <!-- <p class="text-muted font-13 mb-3">
                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                        </p> -->
                                        <p class="text-muted mb-2 font-13"><strong>Họ và tên: </strong>
                                            <span class="ms-2"><?= $result["lastname"] . ' ' . $result["firstname"]; ?></span>
                                        </p>

                                        <p class="text-muted mb-2 font-13"><strong>Giới tính: </strong> <span class="ms-2"><?= $result["sex"] == 1 ?  "Nam" :  "Nữ"; ?></span></p>

                                        <p class="text-muted mb-2 font-13"><strong>Số điện thoại: </strong><span class="ms-2"> <?= $result["phonenumber"]; ?> (zalo)</span></p>

                                        <p class="text-muted mb-2 font-13"><strong>Email: </strong> <span class="ms-2"> <?= $result["email"]; ?></span></p>

                                        <p class="text-muted mb-2 font-13"><strong>Hiện tại là: </strong> <span class="ms-2"> <?= $result["CURRENTJOB"]; ?></span></p>

                                        <p class="text-muted mb-1 font-13"><strong>Nơi ở hiện tại: </strong> <span class="ms-2"><?= $result["CURRENTADDRESS"]; ?></span></p>
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
                                            <?php
                                                $hasTutor = $saved_tutor->countTutorSavedByUserId(Session::get("userId"), $id)->fetch_assoc();
                                            ?>
                                            <button type="button" class="btn btn-primary" id="save-tutor"><?= $hasTutor["hasTutor"] > 0 ? "Đã lưu" : "Lưu"?></button>
                                            <button type="button" class="btn btn-primary">Đăng ký</button>
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- end card -->





                        </div> <!-- end col-->




                        <div class="col-xl-8 col-md-7">
                            <div class="card card-detail">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-12 border-end border-light">
                                            <h5 class="mt-1 mb-2 fw-normal fw-bold text-start border-bottom pb-2">Giới thiệu chung
                                                và kinh nghiệm gia
                                                sư</h5>
                                            <p class="mb-0 fw-normal font-16 text-start"><?= $result["introduction"]; ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>


                        <div class="card card-detail">
                            <div class="card-body">
                                <h4 class="header-title pb-2 border-bottom">Môn học đang dạy</h4>

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

                                                                $subjectList = $subjects->getByTutorId($result['id']);
                                                                while ($resultSB = $subjectList->fetch_assoc()) {


                                                                ?>
                                                                    <div class="mt-1 mx-1 text-start ">
                                                                        <div class="mb-1">
                                                                            <span class="badge bg-primary">
                                                                                <?= $resultSB["subject"] ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                <?php } ?>

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


                        <div class="card card-detail">
                            <div class="card-body">
                                <h4 class="header-title pb-2 border-bottom">Lịch dạy gia sư</h4>
                                <div class="row g-0">
                                    <?php
                                    $dow_list = $dayofweeks->getAll();
                                    while ($resultDOW = $dow_list->fetch_assoc()) {


                                    ?>
                                        <div class="col-4 col-md-3 col-xl">
                                            <h6 class=" text-center"><?= $resultDOW["day"]  ?></h6>
                                            <ul class="calendar">
                                                <?php
                                                $day_list = $days->getAll();
                                                while ($resultDay = $day_list->fetch_assoc()) {
                                                    $teachingTime_list = $teachingtimes->getAll($id, $resultDOW["id"], $resultDay["id"]);

                                                ?>
                                                    <li class="<?= ($teachingTime_list !== false) ? "calendar-active" : "calendar-normal" ?>" data-toggle="<?= ($teachingTime_list !== false) ? "collapse" : "" ?>" data-target="#collapse<?= $resultDOW["id"] . 'T' . $resultDay["id"] ?>" aria-expanded="false" aria-controls="collapseExample">
                                                        <?= $resultDay["dayname"] ?>

                                                    </li>
                                                    <div class="collapse" id="collapse<?= $resultDOW["id"] . 'T' . $resultDay["id"] ?>">
                                                        <div class="container-fuild p-0">
                                                            <ul class="ps-1 container-time">
                                                                <?php

                                                                if ($teachingTime_list) {
                                                                    $teachingTime_list = $teachingTime_list->fetch_all(MYSQLI_ASSOC);



                                                                    foreach ($teachingTime_list as $resultTeachingTime) {

                                                                ?>
                                                                        <li class="calendar-time font-13"><?= $resultTeachingTime["time"] ?></li>

                                                                <?php }
                                                                }

                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                   
                                                <?php } ?>
                                            </ul>
                                        </div>

                                    <?php } ?>
                                   
                                </div>

                            </div>
                        </div> <!-- end card-->

                        </div> <!-- end col -->
                </div>
                <!-- end row-->

            </div>
        </div>
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>
    </div>



    <?php
    include "../inc/script.php"
    ?>

<script>
        $(document).ready(function() {
            $("#save-tutor").on('click', (e) => {
                const params = new Proxy(new URLSearchParams(window.location.search), {
                    get: (searchParams, prop) => searchParams.get(prop),
                });
                // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
                let tutorId = params.id; // "some_value"

                console.log(tutorId, "save-tutor");
                console.log("<?= Session::get("userId") ?>")
                $.ajax({
                    type: "post",
                    url: "../ajax/savetutor.php",
                    data: {
                        userId: "<?= Session::get("userId") ?>" ,
                        tutorId: tutorId
                    },
                    cache: false,
                    success: function (data) {

                        $("#save-tutor").replaceWith(data);

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