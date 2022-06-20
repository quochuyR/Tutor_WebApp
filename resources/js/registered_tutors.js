(function () {
    $(document).ready(() => {
        OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký



        function onChangeActionRadio() {

            $(`.form-check-input[type="radio"]`).off().on('change', (e) => { // disable input checkbox khi thay đổi
                if (e.currentTarget.checked) {
                    $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del") // Tìm nơi chứa select thêm lịch dạy cho người dùng
                        .text($(e.currentTarget)
                            .next(".form-check-label").text());

                    $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del")
                        .attr("data-action", $(e.currentTarget).attr("data-action"))


                    // và disable nó 
                }
            });

        }

        function onChangeShowTopic(event_approval) {

            $(".show-topic-register").off().on('change', () => {

                getSubjectRegisterUser(event_approval);
            });

        }









        function OnClickApprovalRegisterUser() {
            $(".register-unregister-tutor").on('click', (e) => {

                getSubjectRegisterUser(e);
                onChangeShowTopic(e);
                onChangeActionRadio();
                onClickAddOrDel(e);
            });
        }

        function onClickAddOrDel(event_approval) {

            $(".btn-register-add-del").off().on('click', (e) => {
                if (confirm("Bạn có chắn chắn muốn " + $(e.target).text().trim()) === true)
                    addOrDelRegisterTutor(event_approval, e);
            });
        }


        function getSubjectRegisterUser(e) {
            let tuId = $(e.currentTarget).attr("data-id");
            let id_approval = $(e.currentTarget).attr("data-bs-target");
            let subject = $(id_approval).find(`.teaching-subject`);

            let status = $(id_approval).find(".show-topic-register.form-check-input").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

            console.log([tuId, id_approval, subject, status])
            $.ajax({
                type: "post",
                url: "../api/teachingsubject/getsubjecttutor",
                data: {
                    tuId,
                    status

                },
                cache: false,
                success: function (data) {

                    subject.html(data);

                    console.log(data)
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        }

        function addOrDelRegisterTutor(event_approval, event_target) {
            let id_modal = $(event_approval.currentTarget).attr("data-bs-target");
            let tuId = $(event_approval.currentTarget).attr("data-id");
            let action = $(event_target.currentTarget).attr("data-action");
            let topicId = $(id_modal).find(`select`).val();

            console.log([action, tuId, topicId])

            $.ajax({
                type: "post",
                url: "../api/registertutor/addordeleteregistertutor",
                data: {
                    tuId,
                    action,
                    topicId,

                },
                cache: false,
                success: function (data) {

                    if (data.added === 'added') {
                        alert(`Môn học ${data.topicName} đã đăng ký rồi. Hãy chọn môn học khác.`)
                    }

                    if (data.insert === 'successful') {
                        alert(`Đăng ký môn học ${data.topicName} thành công. Hãy chờ gia sư liên hệ với bạn.`)
                        getSubjectRegisterUser(event_approval); // refresh topic when insert success

                        // When inserting the topic success, include a badge containing the topic name.
                        $("#topic-register").append(`<span class="subject-span m-l-10 fw-500 badge bg-secondary data-id="${data.topicId}">${data.topicName}</span>`);
                    } else if (data.delete === 'successful') {
                        alert(`Huỷ đăng ký môn học ${data.topicName} thành công.`);
                        getSubjectRegisterUser(event_approval); // refresh topic when delete success

                        $("ul li span[data-id=" + data.topicId + "]").remove();
                    } else if (data.delete === 'fail') {
                        alert(data.message);

                    }


                    console.log(data, "insert3")
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        }


        var review_modal = document.getElementById('review');
        var tuid, review_modal ;
        review_modal?.addEventListener('shown.bs.modal', function (event) {
            console.log(event.relatedTarget)
            tuid = $(event.relatedTarget).attr("data-id");
            review_modal = $(event.target);

            
        });

        $(".btn-add-review").on('click', (e) => {
            let star_review = $(review_modal).find("input[type='radio'][name='rating']:checked").val();
            let text_rating = $(review_modal).find("#text-rating").val();
            // console.log(star_review, tuid, text_rating)

            $.ajax({
                type: "post",
                url: "../api/review/addreviewtutor",
                data: {
                    tuid,
                    star_review,
                    text_rating,

                },
                cache: false,
                success: function (data) {
                    if(data.add === "successful"){
                        Toastify({
                            text: data.message,
                            duration: 5000,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "linear-gradient(to right, #56C596, #7BE495)",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();
                    }
                    else{
                        Toastify({
                            text: data.message,
                            duration: 5000,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "linear-gradient(to right, #F082AC, #b91c1c)",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();
                    }
                    console.log(data, "add review")
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
        review_modal?.addEventListener('hidden.bs.modal', function (event) {
            $(event.target).find("input[type='radio'][name='rating']:checked").prop("checked", false);
            $(event.target).find("#text-rating").val('');

        
        });
        


    });
})();