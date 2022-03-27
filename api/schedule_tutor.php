<?php

namespace Ajax;

use Classes\AppUser,
    Classes\TutoringSchedule,
    Classes\SubjectTopic,
    Classes\TeachingTime,
    Classes\DayOfWeek;
use Helpers\Util;
use Library\Session;

$filepath = realpath(dirname(__FILE__));
include_once $filepath . "../../lib/session.php";

if(!Session::checkRoles(['tutor'])){
    header("location:../pages/errors/404.php");
}
include_once $filepath . "../../classes/tutoringschedule.php";
include_once $filepath . "../../classes/appusers.php";
include_once $filepath . "../../classes/teachingtimes.php";
include_once $filepath . "../../classes/dayofweeks.php";
include "../classes/subjecttopics.php";

include_once $filepath . "../../helpers/utilities.php";
include_once $filepath . "../../helpers/format.php";

$_tutoring_schedule = new TutoringSchedule();
$_user = new AppUser();
$_subjecttopic = new SubjectTopic();
$_teaching_time = new TeachingTime();
$_day_of_week = new DayOfWeek();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {
        $get_tutoring_schedule = $_tutoring_schedule->getTutoringScheduleByTutorId(1, Session::get("tutorId"), $_POST);

        if ($get_tutoring_schedule->data->num_rows > 0) {

?>

            <div class="card">
                <div class="card-body py-md-4 px-md-4 ">
                    <div class="accordion" id="accordion-tutoring-schedule">

                        <?php

                        while ($tutoring_schedule = $get_tutoring_schedule->data->fetch_assoc()) {
                            $user = $_user->getInfoByUserId($tutoring_schedule["userId"])->fetch_assoc();
                        ?>


                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading-<?= $user["username"]; ?>">
                                    <button class="accordion-button bg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $user["username"]; ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php

                                        if ($user !== false) {
                                        ?>

                                            <div class="d-flex align-items-start">
                                                <img src="<?= Util::getCurrentURL() . "/../public/"  . $user["imagepath"]; ?>" class="rounded-circle avatar-sm img-thumbnail" alt="profile-image" onclick="ShowImg(this.src);">
                                                <div class="w-100 ms-3 align-self-end">
                                                    <h6 class="my-1"><?= $user["lastname"] . ' ' . $user["firstname"]; ?></h6>
                                                    <p class="text-muted">@id: <?= $user["username"]; ?></p>

                                                </div>
                                            </div>


                                    </button>
                                </div>
                                <div id="collapse<?= $user["username"]; ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $user["username"]; ?>" data-bs-parent="#accordion-tutoring-schedule">
                                    <div class="accordion-body">

                                        <div class="table-responsive">
                                            <table class="table table-striped table-schedule-tutor">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Thứ</th>
                                                        <th scope="col">Thời gian</th>
                                                        <th scope="col">Môn học</th>
                                                        <th scope="col">Tuỳ chọn</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $get_schedule = $_tutoring_schedule->GetTutoringSchedule_Tutor(Session::get("tutorId"), $tutoring_schedule["userId"], 1, $_POST);
                                                    if ($get_schedule) {
                                                        while ($schedule = $get_schedule->fetch_assoc()) {

                                                    ?>
                                                            <tr class="container-schedule">
                                                                
                                                                    <th scope="row" class="text-start th-id" data-value="<?= $schedule["id"] ?>"><?= $schedule["id"] ?></th>
                                                                    <td scope="row" class="text-start td-day" data-value="<?= $schedule["dayofweekId"] ?>"><?= $schedule["day"] ?></td>
                                                                    <td scope="row" class="text-start td-time" data-value="<?= $schedule["timeId"] ?>"><?= $schedule["time"] ?></td>
                                                                    <td scope="row" class="text-start td-topic-name" data-value="<?= $schedule["subject_topicId"] ?>"><?= $schedule["topicName"] ?></td>
                                                                
                                                                <td scope="row" class="text-start td-options">
                                                                    <div class="d-flex py-2 cursor-pointer">
                                                                        <i class="fa-regular fa-pen-to-square fa-lg mx-2 edit-schedule" style="color: #3F99EF;" data-bs-toggle="modal" data-bs-target="#<?= $user["username"] . '-' . $schedule["subject_topicId"] ?>"></i>
                                                                        <i class="fa-regular fa-trash-can fa-lg delete-schedule ms-2" style="color: #E73774;"></i>
                                                                    </div>


                                                                </td>


                                                            </tr>

                                                            <!-- Modal -->

                                                            <div class="modal fade" id="<?= $user["username"] . '-' . $schedule["subject_topicId"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="card ">
                                                                                <div class="d-flex align-items-start p-2">
                                                                                    <img src="<?= Util::getCurrentURL() . "/../public/"  . $user["imagepath"]; ?>" class="rounded-circle avatar-sm img-thumbnail" alt="profile-image" onclick="ShowImg(this.src);">
                                                                                    <div class="w-100 ms-3 align-self-end">
                                                                                        <h6 class="my-1"><?= $user["lastname"] . ' ' . $user["firstname"]; ?></h6>
                                                                                        <p class="text-muted">@id: <?= $user["username"]; ?></p>

                                                                                    </div>
                                                                                </div>
                                                                                <hr class="w-75 d-block mx-auto">
                                                                                <div class="card-body">
                                                                                    <div class="row g-0 ">

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
                                                                                                    <?php
                                                                                                    $subject_topic_register_user = $_subjecttopic->getTopic_registerUser(Session::get("tutorId"), $user["id"]);
                                                                                                    if ($subject_topic_register_user) {
                                                                                                        while ($topic = $subject_topic_register_user->fetch_assoc()) {
                                                                                                    ?>
                                                                                                            <option value="<?= $topic["id"] ?>"><?= $topic["topicName"] ?></option>

                                                                                                    <?php }
                                                                                                    } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                                                            <button type="button" class="btn btn-primary btn-modal-save">Lưu</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        <?php

                        }

                        ?>
                    </div>
                </div>
            </div>


        <?php

            echo ' <nav aria-label="Page navigation example " id="pagination-nav" class="mt-3">';
            echo $_tutoring_schedule->getPaginatorTutoringSchedule($_POST);
            echo '</div>';
        } else {
        ?>
            <div class="card">

                <div class="card-body py-md-2 px-md-2">
                    <h4 class="text-center py-1">Không có lịch dạy vào hôm nay.</h4>
                </div>
            </div>


<?php

        }
    }
}
