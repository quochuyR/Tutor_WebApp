<?php

use Classes\TutoringSchedule,
  Classes\AppUser,
  Classes\DayOfWeek,
  Classes\SubjectTopic,
  Classes\Time;
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
if (Session::checkRoles(["tutor"]) !== true) {
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

                  $get_DoW = $_dayofweek->GetDayOfWeek_TutoringSchedule(Session::get("tutorId"), 1);
                  if ($get_DoW) :
                    while ($dayofweek = $get_DoW->fetch_assoc()) :
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
                  $get_SbT = $_subjecttopic->getTopic_TutoringSchedule(Session::get("tutorId"), 1);
                  if ($get_SbT) :
                    while ($subjecttopic = $get_SbT->fetch_assoc()) :
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


                  $get_time = $_time->getTimes_TutoringSchedule(Session::get("tutorId"), 1);
                  if ($get_time) :
                    while ($time = $get_time->fetch_assoc()) :
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


                  $get_time = $_time->getTimes_TutoringSchedule(Session::get("tutorId"), 1);
                  if ($get_time) :
                    while ($time = $get_time->fetch_assoc()) :
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
        let uid = params.uid; // "some_value"

        let url = $(e?.target).attr('href') ? $(e.target).attr('href') : "3&1"; // check có thẻ a chưa 
        let [limit, page] = url.split("&");
        console.log(limit, page, url)
        let day = null;

        if (hasFirstFilter) {
          if ($(`#dayofweek option[value="${ new Date().getDay()}"]`).prop("selected", true).length === 0)
            day = 8; // không có ngày thứ 8 mục đích là trả về "không có lịch dạy hôm nay."
          hasFirstFilter = false;
        }
        //    console.log($(`#dayofweek option[value="${ 3}"]`).prop("selected", true), "dayofweek");
        if (!hasFirstFilter) {
          day = $("#dayofweek").val();

        }
        let subjectTopic = $("#subject-topic").val();
        let startTime = $("#time-start").val();
        let endTime = $("#time-end").val();
        console.log([day, subjectTopic, startTime, endTime], "get value ")


        $.ajax({
          type: "post",
          url: "../api/schedule_tutor",
          data: {
            day,
            subjectTopic,
            startTime,
            endTime,
            uid,
            limit,
            page,
          },
          cache: false,
          success: function(data) {

            $("#tutoring-schedule").html(data);
            page_paginator();
            OnchangeSelectDoW();
            console.log(data)
            /**/
            onClickBtnEdit();

            /* */

            onClickUpdateSchedule();


            /* */

            /* */
            onClickDeleteSchedule();
            /* */
            console.log($(".container-schedule"), "container-schedule")
          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });

      }

      function onClickUpdateSchedule() {
        $(".btn-modal-save").on('click', (e) => {

          let main_body_modal = $(e.target).closest(".modal-footer").prev(".modal-body");
          let dayofweek = $(main_body_modal).find("select").eq(0).val();
          let time = $(main_body_modal).find("select").eq(1).val();
          let subjecttopic = $(main_body_modal).find("select").eq(2).val();
          /* Update lịch dạy ở đây */

          // console.log([td_day ,dayofweek , $(td_time).attr("data-value") , time , td_topic_name , subjecttopic])
          // if(td_day !== dayofweek || $(td_time).attr("data-value") !== time || td_topic_name !== subjecttopic)

          updateScheduleTutor(th_id, dayofweek, time, subjecttopic, $(td_day).attr("data-value"), $(td_time).attr("data-value"));

          /* */
        });
      }

      function onClickDeleteSchedule() {
        $(".delete-schedule").on('click', (e) => {

          if (confirm("Bạn có chắn chắn muốn xoá?") === false)
            return 0


          let container_schedule = $(e.target).closest(".container-schedule");
          let th_id = container_schedule.children(".th-id").attr("data-value");

          $(container_schedule).remove();
          /* Xoá lịch dạy ở đây */
          $.ajax({
            type: "post",
            url: "../api/deleteschudule",
            data: {
              id: th_id

            },
            cache: false,
            success: function(data) {

              if (data.action === "success") {
                $(container_schedule).remove();
                Toastify({
                  text: "Xoá thành công!",
                  duration: 5000,
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
              // console.log($(td_options).html());

              // page_paginator();

              console.log(data)
            },
            error: function(xhr, status, error) {
              console.error(xhr);
            }
          });

          /* */
        });
      }

      function referenceDataFromTableToModal(e) {
        container_schedule = $(e.target).closest(".container-schedule");
        th_id = container_schedule.children(".th-id").attr("data-value");
        td_day = container_schedule.children(".td-day");
        td_time = container_schedule.children(".td-time");
        td_topic_name = container_schedule.children(".td-topic-name");
      }

      function onClickBtnEdit() {
        $(".edit-schedule").on('click', (e) => {
          referenceDataFromTableToModal(e);
          getDaySchedule(e);
          let id_modal = $(e.target).attr("data-bs-target");
          $(id_modal).find(`select option[value="${-1}"]`).eq(0).prop("selected", true); // select teaching day in modal
          $(id_modal).find("select").eq(1).html(`<option value="0">-- Buổi học --</option> <option value="${$(td_time).attr("data-value")}" selected> ${$(td_time).text()} </option>`); // select teaching time in modal
          $(id_modal).find("select").eq(2).val($(td_topic_name).attr("data-value")); // select teaching subject topic in modal

        });


      }





      function updateScheduleTutor(id, dayofweek, time, subject_topic, dayofweek_prev, time_prev) {
        $.ajax({
          type: "post",
          url: "../api/updateschedule",
          data: {
            id,
            dayofweek,
            time,
            subject_topic,
            dayofweek_prev,
            time_prev

          },
          cache: false,
          success: function(data) {

            let td_options = $(container_schedule).children(".td-options");
            // console.log($(td_options).html());
            // $(container_schedule).html(`${data} <td scope="row" class="text-start td-options">${$(td_options).html()}</td>`);
            // page_paginator();
            [...data].forEach(row => {
              $(td_day).attr("data-value", row.dayofweekId);
              $(td_day).text(row.day);
              $(td_time).attr("data-value", row.timeId);
              $(td_time).text(row.time);
              $(td_topic_name).attr("data-value", row.subject_topicId);
              $(td_topic_name).text(row.topicName);
            });
            if (data) {
              Toastify({
                text: `Sửa thành công.`,
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
            console.log(data)
          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });
      }

      function OnchangeSelectDoW() {
        $(".teaching-day").on('change', (e) => {

          getTimeFromDay(e);
        });
      }



      function getTimeFromDay(e) {

        let dayofweek = $(e.target).val();
        let index = $(".teaching-day").index(e.target);

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
        let id_modal = $(e.target).attr("data-bs-target");
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


    });
  })();
</script>
<?php include '../inc/footer.php' ?>