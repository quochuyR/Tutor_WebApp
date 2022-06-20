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

        $(".link-ajax").off().on('click', (e) => {
          e.preventDefault();
          filer_data_tutoringSchedule(e);
        });
      }


      // lọc dữ liệu
      function filer_data_tutoringSchedule(e = null) {

        if(!document.querySelector("#tutoring-schedule")) return false;
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
          url: "../api/scheduletutor/schedule_tutor",
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

            $("#tutoring-schedule")?.html(data);
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
        $(".btn-modal-save").off().on('click', (e) => {

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
        $(".delete-schedule").off().on('click', (e) => {

          if (confirm("Bạn có chắn chắn muốn xoá?") === false)
            return 0


          let container_schedule = $(e.target).closest(".container-schedule");
          let th_id = container_schedule.children(".th-id").attr("data-value");

          $(container_schedule).remove();
          /* Xoá lịch dạy ở đây */
          $.ajax({
            type: "post",
            url: "../api/scheduletutor/deleteschudule",
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
        $(".edit-schedule").off().on('click', (e) => {
          referenceDataFromTableToModal(e);
          getDaySchedule(e);
          let id_modal = $(e.target).attr("data-bs-target");
          // $(id_modal).find(`select option[value="${-1}"]`).eq(0).prop("selected", true); // select teaching day in modal
          $(id_modal).find("select").eq(1).html(`<option value="0">-- Buổi học --</option> <option value="${$(td_time).attr("data-value")}" selected> ${$(td_time).text()} </option>`); // select teaching time in modal
          $(id_modal).find("select").eq(2).val($(td_topic_name).attr("data-value")); // select teaching subject topic in modal

        });


      }





      function updateScheduleTutor(id, dayofweek, time, subject_topic, dayofweek_prev, time_prev) {
        $.ajax({
          type: "post",
          url: "../api/scheduletutor/updateschedule",
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
        $(".teaching-day").off().on('change', (e) => {

          getTimeFromDay(e);
        });
      }



      function getTimeFromDay(e) {

        let dayofweek = $(e.target).val();
        let index = $(".teaching-day").index(e.target);

        $.ajax({
          type: "post",
          url: "../api/time/getTimeFromDay",
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
        console.log($(td_day).attr("data-value"), "td day")
        $.ajax({
          type: "post",
          url: "../api/day/getdayschedule",
          data: {
            action: "getDay",

          },
          cache: false,
          success: function(data) {

            dayofweek.html(data);
            $(dayofweek).children(`option[value="${$(td_day).attr("data-value")}"]`).prop("selected", true); // When we click the edit button, we can select a data value.
            console.log(data)
          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });
      }


    });
  })();