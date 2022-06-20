(function(){
    $(document).ready(function() {
        onClickToShowModalRegister();

        function onClickToShowModalRegister() {
            $(".btn-register-show").on('click', (e) => {

                getSubjectRegisterUser(e);
                onClickToAddRegister();
            });
        }

        function onClickToAddRegister() {
            $(".btn-register-add").on('click', (e) => {
                addRegisterTutor(e);
            });
        }

        function getSubjectRegisterUser(e) {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
            let tuId = params.id; // "some_value"
            let id_approval = $(e.currentTarget).attr("data-bs-target");
            let subject = $(id_approval).find(`.teaching-subject`);

            let status = 0; // trạng thái đã duyệt môn học hay chưa

            // console.log([tuId, id_approval, subject, status])
            $.ajax({
                type: "post",
                url: "../api/teachingsubject/getsubjecttutor",
                data: {
                    tuId,
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

        function addRegisterTutor(e) {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
            let tuId = params.id; // "some_value"

            let action = 1;
            let topicId = $(e.currentTarget).closest(".modal-content").find("select");

            console.log([action, tuId, topicId, e.currentTarget])

            $.ajax({
                type: "post",
                url: "../api/registertutor/addordeleteregistertutor",
                data: {
                    tuId,
                    action,
                    topicId: $(topicId).val(),

                },
                cache: false,
                success: function(data) {

                    if (data.insert === 'successful') {
                        alert(`Đăng ký môn học ${data.topicName } thành công. Hãy chờ gia sư liên hệ với bạn.`)
                        window.location.href = "./registered_tutors";

                    }


                    console.log(data, "insert3")
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }

        /* Lưu gia sư */



        $("#save-tutor").on('click', (e) => {
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });
            // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
            let tutorId = params.id; // "some_value"

            console.log(tutorId, "save-tutor");
            $.ajax({
                type: "post",
                url: "../api/savedtutor/savetutor",
                data: {
                    tutorId: tutorId
                },
                cache: false,
                success: function(data) {
                    if (data.insert !== "fail")
                        $("#save-tutor").text(data.data);
                    else {
                        Toastify({
                            text: "Lưu không thành công. Bạn đã lưu gia sư này rồi!",
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

                    console.log(data, "data")
                },
                error: function(xhr, status, error) {
                    console.log(xhr, error, status, "Lỗi");
                }
            });
        });
    });
})();