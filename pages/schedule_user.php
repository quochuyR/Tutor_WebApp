<?php

use Classes\AppUser;
use Classes\DayOfWeek;
use Classes\SubjectTopic;
use Classes\Time;
use Classes\TutoringSchedule;
use Library\Session;

include "../lib/session.php";
include_once "../helpers/utilities.php";
include "../classes/tutoringschedule.php";
include "../classes/appusers.php";
include "../classes/dayofweeks.php";
include "../classes/subjecttopics.php";
include "../classes/times.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);
if (!Session::checkRoles(["user", "tutor"])) {
  header("location: ./");
}
?>


<?php



$_tutoring_schedule = new TutoringSchedule();
$_user = new AppUser();
$_dayofweek = new DayOfWeek();
$_subjecttopic = new SubjectTopic();
$_time = new Time();

?>



<?php
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

  <section id="tutoring-schedule">


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
  (function() {
    let hasFirstFilter = true; // biến toàn cục dùng để kiểm tra load thứ lần đầu tiên
    let th_id = null; // biến toàn cục dùng để lưu id
    let container_schedule = null; // biến toàn cục dùng để lưu nơi chứa thông tin dạy kèm
    let td_day = null; // biến toàn cục dùng để lưu thư trước khi update mục địch trả về trạng thái thứ còn trống khi đã cập nhật thứ khác
    let td_time = null; // biến toàn cục dùng để lưu thời gian trước khi update  mục địch trả về trạng thái thời gian còn trống khi đã cập nhật thời gian khác
    let td_topic_name = null; // biến toàn cục dùng để lưu chủ đề trước khi update  mục địch trả về trạng thái chủ đề còn trống khi đã cập nhật chủ đề khác

    $(document).ready(() => {
      filer_data_tutoringSchedule();
      $(".form-select").on('change', (e) => {
        filer_data_tutoringSchedule();
      });

      function page_paginator() {

        $(".link-ajax").on('click', (e) => {
          e.preventDefault();
          filer_data_tutoringSchedule(e);
        });
      }


      // lọc dữ liệu
      function filer_data_tutoringSchedule(e = null) {
        $("#tutoring-schedule").html(`<div class="spinner-border text-primary d-flex mx-auto" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
        const params = new Proxy(new URLSearchParams(window.location.search), {
          get: (searchParams, prop) => searchParams.get(prop),
        });
        // get uid param
        // dùng để lấy lịch dạy của một user duy nhất
        let tuid = params.tuid; // "some_value"
        let subid = params.subid;
        let url = $(e?.target).attr('href') ? $(e.target).attr('href') : "3&1"; // check có thẻ a chưa
        let [limit, page] = url.split("&");
        console.log(limit, page, url, subid, "params")
        let day = null;

        // có nhiệm vụ xem lịch học khi chọn ở trang gia sư đã đăng ký
        if (params.day) {
          day = params.day
        } else {
          if (hasFirstFilter) {
            if ($(`#dayofweek option[value="${ new Date().getDay()}"]`).prop("selected", true).length === 0)
              day = 8; // không có ngày thứ 8 mục đích là trả về "không có lịch dạy hôm nay."
            hasFirstFilter = false;
          }
          //    console.log($(`#dayofweek option[value="${ 3}"]`).prop("selected", true), "dayofweek");
          if (!hasFirstFilter) {
            day = $("#dayofweek").val();

          }
        }

        let subjectTopic = undefined;
        // áp dụng vừa lọc và tạo thông báo
        if (subid) {
          subjectTopic = subid;
        } else {
          subjectTopic = $("#subject-topic").val();
        }

        let startTime = $("#time-start").val();
        let endTime = $("#time-end").val();
        console.log([day, subjectTopic, startTime, endTime], "get value ")


        $.ajax({
          type: "post",
          url: "../api/schedule_user",
          data: {
            day,
            subjectTopic,
            startTime,
            endTime,
            tuid,
            limit,
            page,
          },
          cache: false,
          success: function(data) {

            $("#tutoring-schedule").html(data);
            page_paginator();

            console.log(data)
            /**/


            /* */

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