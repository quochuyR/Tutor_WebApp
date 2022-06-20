(function() {
    let hasFirstFilter = true; // biến toàn cục dùng để kiểm tra load thứ lần đầu tiên
    let th_id = null; // biến toàn cục dùng để lưu id
    let container_schedule = null; // biến toàn cục dùng để lưu nơi chứa thông tin dạy kèm
    let td_day = null; // biến toàn cục dùng để lưu thư trước khi update mục địch trả về trạng thái thứ còn trống khi đã cập nhật thứ khác
    let td_time = null; // biến toàn cục dùng để lưu thời gian trước khi update  mục địch trả về trạng thái thời gian còn trống khi đã cập nhật thời gian khác
    let td_topic_name = null; // biến toàn cục dùng để lưu chủ đề trước khi update  mục địch trả về trạng thái chủ đề còn trống khi đã cập nhật chủ đề khác

    $(document).ready(() => {
      filer_data_user_schedule();
      $(".form-select").on('change', (e) => {
        filer_data_user_schedule();
      });

      function page_paginator() {

        $(".link-ajax").on('click', (e) => {
          e.preventDefault();
          filer_data_user_schedule(e);
        });
      }


      // lọc dữ liệu
      function filer_data_user_schedule(e = null) {
        if(!document.querySelector("#user-schedule")) return false;

        $("#user-schedule").html(`<div class="spinner-border text-primary d-flex mx-auto" role="status">
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
          url: "../api/scheduleuser/schedule_user",
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

            $("#user-schedule").html(data);
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