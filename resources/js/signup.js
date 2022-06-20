(function() {
    $(document).ready(() => {
        $.validator.addMethod('phoneVI', function(value) {
            return /^(84|0[3|5|7|8|9])+([0-9]{8})$/.test(value);
        });
        $.validator.addMethod('Password', function(value) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}$/.test(value);
        });

        $("#signup-form").validate({
            ignore: [],
            rules: {
                "first_name": {
                    required: true,
                    minlength: 5
                },
                "last_name": {
                    required: true,
                    minlength: 2
                },
                "email": {
                    required: true,
                    email: true,
                    remote: {
                        url: "../api/validation/checkunique",
                        type: "post",
                        data: {
                            value: function() {
                                return $("#email").val();
                            },
                            column: function() {
                                return 'email';
                            }
                        },
                    },
                },
                "phone": {
                    required: true,
                    phoneVI: true,
                    rangelength: [10, 10],
                    remote: {
                        url: "../api/validation/checkunique",
                        type: "post",
                        data: {
                            value: function() {
                                return $("#phone_number").val();
                            },
                            column: function() {
                                return 'phonenumber';
                            }
                        },
                    },
                },
                "username": {
                    required: true,
                    minlength: 5,
                    remote: {
                        url: "../api/validation/checkunique",
                        type: "post",
                        data: {
                            value: function() {
                                return $("#username").val();
                            },
                            column: function() {
                                return 'username';
                            }
                        },
                    },
                },
                "pass": {
                    required: true,
                    Password: true
                },
                "repass": {
                    required: true,
                    minlength: 5,
                    equalTo: '#pass'
                },
            },
            messages: {
                first_name: "Họ từ 5 kí tự trở lên.",
                last_name: "Tên từ 2 kí tự trở lên.",
                email: {
                    required: "Vui lòng nhập email.",
                    email: "Email sai định dạng",
                    remote: $.validator.format("{0} đã tồn tại.")
                },
                phone: {
                    required: "Vui lòng nhập số điện thoại",
                    phoneVI: "Đầu số điện thoại phải là 03, 05, 07, 08, 09.",
                    rangelength: "Số điện thoại phải đủ 10 kí tự.",
                    remote: $.validator.format("{0} đã tồn tại.")
                },
                username: {
                    required: "Vui lòng nhập tài khoản.",
                    minlength: "Phải nhập từ 5 kí tự trở lên.",
                    remote: $.validator.format("{0} đã tồn tại.")
                },
                pass: "Mật khẩu phải chứa từ 10 kí tự, ít nhất 1 kí tự viết hoa, thường, số, kí tự đặc biệt.",
                repass: "Mật khẩu nhập lại không đúng.",

            },
            errorPlacement: function(label, element) {
                label.insertAfter($(element).parent()).addClass('mb-2 text-danger');
            },
            success: function(label, element) {


            },
            submitHandler: (form) => {
                // submitRegisterForm();
                // form.submit();
                console.log("1huy2k")
            }
        });

        $("#signup-form").on('submit', (e) => {
            e.preventDefault();
            let $form = $(e.target);

            if (!$form.valid()) return false;
            let token = $("#token").val();
            let first_name = $("#first_name").val();
            let last_name = $("#last_name").val();
            let email = $("#email").val();
            let phone_number = $("#phone_number").val();
            let username = $("#username").val();
            let password = $("#pass").val();


            console.log(first_name, last_name, email, phone_number, username, password)
            // add loading
            $("#main-container").append(`<div class="loading">
                                            <div class="spinner-grow text-light d-flex mx-auto" style="width: 3rem; height: 3rem;" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>`);
            $.ajax({
                type: "post",
                url: "../api/appuser/signup",
                data: {
                    token,
                    first_name,
                    last_name,
                    email,
                    phone_number,
                    username,
                    password

                },
                cache: false,
                success: function(data) {
                    if (data.sign_up === "successful") {
                        $(".loading")?.remove();

                        if (confirm("Vui lòng kiểm tra email của bạn để kích hoạt tài khoản của bạn trước khi đăng nhập.") === true) {
                            Toastify({
                                text: "Đăng kí tài khoản thành công.",
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

                            new Promise(res => setTimeout(res, 1000)).then(() => {
                                window.location.href = data.url;
                            });
                        }
                    }

                    if (data.sign_up === "fail") {
                        Toastify({
                            text: "Tài khoản đã tồn tại!",
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

                    console.log(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr, error, status, "Lỗi");
                }
            });
        });

    });
})();