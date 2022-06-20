<?php

use Classes\AppUser;
use Classes\DayOfWeek;
use Classes\SubjectTopic;
use Classes\Time;
use Classes\TutoringSchedule;
use Library\Session;
require_once(__DIR__ . "../../vendor/autoload.php");

// include "../lib/session.php";
// include_once "../helpers/utilities.php";
// include "../classes/tutoringschedule.php";
// include "../classes/appusers.php";
// include "../classes/dayofweeks.php";
// include "../classes/subjecttopics.php";
// include "../classes/times.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (!Session::checkRoles(["user", "tutor"])) {
  header("location: ./");
}

$_tutoring_schedule = new TutoringSchedule();
$_user = new AppUser();
$_dayofweek = new DayOfWeek();
$_subjecttopic = new SubjectTopic();
$_time = new Time();

$title = "Lịch dạy";

include "../inc/header.php"
?>


<div id="main" class="container-lg mt-4">

  <section>
    <form action="" id="filter-schedule">
      <div class="row">
        <div class="col-md-3 col-6">
          <div class="card">
            <div class="form-group">
              <div class="py-2 px-3">
                <label for="select-DOW" class="form-label">Thứ</label>
                <select class="form-select select-DOW" id="dayofweek">
                  <option value="all">-- Tất cả --</option>
                  <?php
                  $get_DoW = $_dayofweek->GetDayOfWeek_UserSchedule(Session::get("userId"), 1);
                  if ($get_DoW):
                    while ($dayofweek = $get_DoW->fetch_assoc()):
                  ?>
                      <option value="<?= $dayofweek["id"] ?>"><?= $dayofweek["day"] ?></option>
                  <?php
                    endwhile;
                  endif;
                  ?>
                </select>
              </div>
            </div>


          </div>
        </div>
        <div class="col-md-3 col-6">

          <div class="card">
            <div class="form-group">
              <div class="py-2 px-3">
                <label for="select-subject" class="form-label">Môn học</label>
                <select class="form-select select-subject" id="subject-topic">
                  <option value="all">-- Tất cả --</option>
                  <?php

                  // SbT stand for subject topic
                  $get_SbT = $_subjecttopic->getTopic_UserSchedule(Session::get("userId"), 1);
                  if ($get_SbT):
                    while ($subjecttopic = $get_SbT->fetch_assoc()):
                  ?>
                      <option value="<?= $subjecttopic["id"] ?>"><?= $subjecttopic["topicName"] ?></option>


                  <?php
                    endwhile;
                  endif;
                  ?>


                </select>
              </div>
            </div>

          </div>

        </div>
        <div class="col-md-3 col-6">


          <div class="card">
            <div class="form-group">
              <div class="py-2 px-3">
                <label for="time-start" class="form-label">Thời gian bắt đầu</label>
                <select class="form-select select-subject" id="time-start">
                  <option value="all">-- Tất cả --</option>
                  <?php

                  $get_time = $_time->getTimes_UserSchedule(Session::get("userId"), 1);
                  if ($get_time):
                    while ($time = $get_time->fetch_assoc()):
                  ?>
                      <option value="<?= $time["id"] ?>"><?= $time["time"] ?></option>


                  <?php
                    endwhile;
                  endif;
                  ?>


                </select>
              </div>
            </div>
          </div>




        </div>
        <div class="col-md-3 col-6">

          <div class="card">
            <div class="form-group">
              <div class="py-2 px-3">
                <label for="time-end" class="form-label">Thời gian kết thúc</label>
                <select class="form-select select-subject" id="time-end">
                  <option value="all">-- Tất cả --</option>
                  <?php

                  $get_time = $_time->getTimes_UserSchedule(Session::get("userId"), 1);
                  if ($get_time):
                    while ($time = $get_time->fetch_assoc()):
                  ?>
                      <option value="<?= $time["id"] ?>"><?= $time["time"] ?></option>


                  <?php
                    endwhile;
                  endif;
                  ?>


                </select>
              </div>
            </div>



          </div>

        </div>
    </form>
  </section>

  <section id="user-schedule">


  </section>
  <!-- START Pagination -->
  <!-- <nav aria-label="Page navigation">
          <?php //$_tutoring_schedule->getPaginatorTutoringSchedule($_GET)
          ?>
        </nav> -->
  <!-- END Pagination -->
</div>







<?php include "../inc/script.php" ?>

<script>
 
</script>
<?php include '../inc/footer.php' ?>