(function() {
    $(document).ready(() => {
        OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký
        OnchangeSelectDoW(); // khi thứ thay đổi (được chọn)

        $(".allow-schedule.form-check-input").on('change', (e) => { // disable input checkbox khi thay đổi
            if (!e.currentTarget.checked) {
                $(e.currentTarget).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                // và disable nó 
            } else {
                $(e.currentTarget).closest(".modal-content").find("select").prop("disabled", false)
            }
        });


        //

        function onChangeTopic(event_approval) {
            $(".teaching-subject").off().on('change', (event_target) => {
                getIdRegisterUser(event_approval, event_target);
            })
        }


        //

        // thay đổi hiển thị môn học duyệt hay chưa
        function onChangeStatusApproval(event_approval) {
            
            $(".show-status-topic").off().on('change', () => {
                getSubjectRegisterUser(event_approval);
            });
        }

        //

        function OnchangeSelectDoW() {
            $(".teaching-day").on('change', (e) => {

                getTimeFromDay(e);
            });
        }

        function onChangeFlexSwitch() {
           
            $(".allow-schedule.form-check-input").each((i, select) => { // disable input checkbox khi thay đổi
                console.log(select)
                if (!$(select).prop("checked")) {
                    $(select).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                    // và disable nó 
                } else {
                    $(select).closest(".modal-content").find("select").prop("disabled", false)
                }
            });
        }

        function OnClickApprovalRegisterUser() {
            $(".approval-register-user").on('click', (e) => {
                onLoadSwitch(e);
                getDaySchedule(e);
                getSubjectRegisterUser(e);
                getStatusRegisterUser(e);
                onChangeFlexSwitch(e);
                onChangeTopic(e);
                onChangeStatusApproval(e);
                onClickSave(e);
            });
        }

        function onClickSave(event_approval) {
           
            $(".btn-save").off().on('click', () => {
                addSchedule(event_approval);
            });
        }

        function onLoadSwitch(e){
            let id_modal = $(e.currentTarget).attr("data-bs-target");
            let data_allow_schedule = $(e.currentTarget).attr("data-allow-schedule");
            let data_show_status_topic = $(e.currentTarget).attr("data-show-status-topic");
            let switch_status_allow_schedule = $(id_modal).find(`.allow-schedule.form-check-input`);
            let switch_status_show_status_topic = $(id_modal).find(`.show-status-topic.form-check-input`);

            Number.parseInt(data_allow_schedule) === 1 && $(switch_status_allow_schedule).attr("checked", true);
            Number.parseInt(data_show_status_topic) === 1 && $(switch_status_show_status_topic).attr("checked", true)
            // console.log( data_show_status_topic === "1", data_allow_schedule, id_modal," switch_status, id_modal")

        }

        function getStatusRegisterUser(e) {
            let id_modal = $(e.currentTarget).attr("data-bs-target");
            let switch_status = $(id_modal).find(`.allow-schedule.form-check-input`);
            let id = $(e.currentTarget).attr("data-id");
            // console.log(switch_status, id_modal)

            if (!$(switch_status).prop("checked")) {
                $(switch_status).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true) // Tìm nơi chứa select thêm lịch dạy cho người dùng
                // và disable nó 
            } else {
                $(switch_status).closest(".modal-content").find("select").prop("disabled", false)
            }

            $.ajax({
                type: "post",
                url: "../api/registeruser/getstatusregisteruser",
                data: {
                    id,

                },
                cache: false,
                success: function(data) {

                    $(switch_status).prop("checked", data.status === 1 ? true : false)

                    console.log(data, "dât")
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }

        function getIdRegisterUser(event_approval, event_target) {
            let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
            let id_register = $(id_modal).find(`.id-register`);
            let id = $(event_approval.currentTarget).attr("data-id");
            let topicId = $(event_target.currentTarget).val();

            let status = $(id_modal).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

            // console.log(id, topicId, "id")
            console.log(id_register, "id_register")


            $.ajax({
                type: "post",
                url: "../api/registeruser/getregisteridbytopicid",
                data: {
                    id,
                    topicId,
                    status

                },
                cache: false,
                success: function(data) {
                    if (data.registerId) {
                        $(id_register).html("@id: " + data.registerId);
                        $(id_register).attr("data-id", data.registerId);
                    } else $(id_register).html("@id: không có");

                    console.log(data, "dât2")
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }


        function getTimeFromDay(e) {

            let dayofweek = $(e.currentTarget).val();
            let index = $(".teaching-day").index(e.currentTarget);

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
            let id_modal = $(e.currentTarget).attr("data-bs-target");
            let dayofweek = $(id_modal).find(`select`).eq(0);


            $.ajax({
                type: "post",
                url: "../api/day/getdayschedule",
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

        function getSubjectRegisterUser(e) {
            let userId = $(e.currentTarget).attr("data-id");
            let id_approval = $(e.currentTarget).attr("data-bs-target");
            let subject = $(id_approval).find(`select`).eq(2);

            let status = $(id_approval).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

            console.log(status)
            $.ajax({
                type: "post",
                url: "../api/registeruser/getsubjectregisteruser",
                data: {
                    userId,
                    status

                },
                cache: false,
                success: function(data) {

                    subject.html(data);

                    console.log(data)
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }

        function addSchedule(event_approval) {
            let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
            let id = $(id_modal).find(".id-register").attr("data-id");
            let status = $(id_modal).find(`input[type="checkbox"]`).prop("checked") ? 1 : 0;
            let DoW_id = $(id_modal).find(`select`).eq(0).val();
            let timeId = $(id_modal).find(`select`).eq(1).val();
            let topicId = $(id_modal).find(`select`).eq(2).val();

            console.log($(id_modal).find(`select`));
            console.log([id, status, DoW_id, timeId, topicId])

            $.ajax({
                type: "post",
                url: "../api/scheduleuser/addscheduleuser",
                data: {
                    id,
                    status,
                    DoW_id,
                    topicId,
                    timeId

                },
                cache: false,
                success: function(data) {
                    // if (data.registerId) {
                    //     $(id_register).html("@id: " + data.registerId);
                    //     $(id_register).attr("data-id", data.registerId);
                    // } else $(id_register).html("@id: không có");
                    if (data.status === '1') {
                        $(id_modal).closest(".job-box").addClass("bg-approval");
                        
                        // 
                        Toastify({
                            text: `Duyệt thành công. Bạn đã duyệt thành công môn ${$(id_modal).find(`select option:selected`).eq(2).text()}`,
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

                    } else if (data.status === '0') {
                        $(id_modal).closest(".job-box").removeClass("bg-approval");

                        // 
                        Toastify({
                            text: `Huỷ duyệt thành công.`,
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

                    if (data.action === "successful") {
                        $(id_modal).closest(".job-box").find(".subject-span").each((i, span) => {
                            if ($(span).attr("data-id") === topicId) {
                                $(span).addClass("text-success");
                            }
                        });
                        //
                        Toastify({
                            text: `Thêm lịch dạy thành công.`,
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


                    console.log(data, "update2")
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }
    });
})();