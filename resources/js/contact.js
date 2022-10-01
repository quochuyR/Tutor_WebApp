(function() {
    $(document).ready(function() {
        //string
        function ValidateEmail(mail) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true)
            }
            return (false)
        }

        //string
        function ValidatePhone(phonenumber) {
            if (/(84|0[3|5|7|8|9])+([0-9]{8})\b/.test(phonenumber)) {
                return (true)
            }
            return (false)
        }

        //show message - close message
        function ShowMessage(message) {
            $('.toast-content').html('<p class="toast-content">' + message + '</p>');

            let toast = $('.toast');
            toast.show();
            //đếm ngược thời gian ẩn
            //biến đếm thời gian
            let count = 10;
            let messagertTime = setInterval(() => {
                if (count === -1) {
                    let toastA = $('.toast');
                    toastA.hide();
                    clearInterval(messagertTime);
                }
                $('.toast-header small b').html(count + " giây");
                count--;
            }, 1000)

        }

        // sự kiện ấn submit trang contact
        $("#sentcontact").on('click', function(event) {
            event.preventDefault();
            let fullname = $("#fullnamecontact").val();
            let email = $("#emailcontact").val();
            let phone = $("#phonecontact").val();
            let content = $("#contentcontact").val();
            //kiểm tra tính hợp lệ của dữ liệu và báo lỗi
            let checkfullname = (fullname.length < 30 && fullname.length > 0) ? true : false;
            let checkemail = ValidateEmail(email);
            let checkphone = ValidatePhone(phone);
            let checkcontent = (content.length < 500) ? true : false;

            if (!checkfullname) {
                let fullnameError = "";
                if (fullname.length == 0)
                    fullnameError = 'Vui lòng nhập tên của bạn!';
                else
                    fullnameError = 'Tên của bạn của bạn quá dài!';
                ShowMessage(fullnameError);
            } else if (!checkemail) {
                let emailError = "Vui lòng nhập đúng địa chỉ email.<br>Ví dụ <b>GiaSu123@gmail.com</b>";
                ShowMessage(emailError);
            } else if (!checkphone) {
                let phoneError = "Vui lòng nhập chính xác số điện thoại của bạn để chúng tôi có thể liên hệ giải quyết nhanh chóng vấn đề bạn gặp phải.<br><i>Số điện thoại gồm 10 số, không có kí tự đặt biệt</i>";
                ShowMessage(phoneError);
            } else if (!checkcontent) {
                let contentError = "Giới hạn tối đa nhập 500 kí tự";
                ShowMessage(contentError);
            } else {
                let success = "Yêu cầu của bạn đã được thực hiện. Vui lòng chờ điện thoại chúng tôi sẽ liên hệ bạn.";

                //dữ liệu hợp lệ tiến hành post qua file contact.php
                $.ajax({
                    url: "../api/contactsent/contactsent",
                    type: "post",
                    dataType: "text",
                    data: {
                        fullname: fullname,
                        email: email,
                        phone: phone,
                        content: content
                    },
                    success: function() {
                        //Làm trông - làm trống thông tin nhập
                        $('#fullnamecontact').val("");
                        $('#emailcontact').val("");
                        $('#phonecontact').val("");
                        $('#contentcontact').val("");

                        //mở notification - thong bao gửi yêu cầu thành công
                        ShowMessage(success);
                    }
                });

            }
        })

        //đóng notification
        $('#closetoast').on('click', function() {
            let toast = $('.toast');
            toast.hide();
        })

    });
})();