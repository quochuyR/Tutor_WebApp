<!DOCTYPE html>
<html lang="en">

<?php 
$title = "Đăng ký lịch dạy";
include "inc/head.php" 

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-5 ">
                <div class="card position-sticky" style="top: 0">
                    <div class="card-body">

                        <div class="d-flex align-items-start">
                            <img src="images/175337396_2917917531830460_8008229113997594091_n.jpg"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"
                                onclick="ShowImg(this.src);">
                            <div class="w-100 ms-3 align-self-end">
                                <h4 class="my-1">Nguyễn Quốc Huy</h4>
                                <p class="text-muted">@id: huy2k1</p>

                            </div>
                        </div>

                        <div class="mt-3">

                            <h4 class="font-13 text-uppercase">Thông tin người dùng:</h4>
                            <!-- <p class="text-muted font-13 mb-3">
                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                        </p> -->
                            <p class="text-muted mb-2 font-13"><strong>Họ và tên: </strong> <span class="ms-2">Nguyễn
                                    Quốc Huy</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Giới tính: </strong> <span
                                    class="ms-2">Nam</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Số điện thoại: </strong><span class="ms-2">038
                                    614 4385 (zalo)</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email: </strong> <span
                                    class="ms-2">nhokbaby0246@gmail.com</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Hiện tại là: </strong> <span class="ms-2">Sinh
                                    viên</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Nơi ở hiện tại: </strong> <span class="ms-2">Đồng
                                    Tháp</span></p>
                        </div>

                    </div>
                </div> <!-- end card -->
            </div>

            <div class="col-xl-8 col-md-7">
                <form method="post" id="form-submit">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 border-end border-light container-subjects">
                                    <h5 class="mt-1 mb-2 fw-normal fw-bold text-start border-bottom pb-2">Thêm lịch dạy
                                        sư</h5>

                                    <!--  -->
                                    <div class="container border p-2">
                                        <div class="row g-0 ">
                                            <div class="col-md-4 ">
                                                <div class="form-group">

                                                    <select class="form-select select-subject"
                                                        onchange="CheckSameOptionSubject(event);">
                                                        <option value="0">-- Môn học --</option>
                                                        <option value="Toán">Toán</option>
                                                        <option value="Vật lý">Vật lý</option>
                                                        <option value="Hoá học">Hoá học</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-0 py-3 container-dayofweeks">
                                                <div>
                                                    <div class="col-md-12 p-0 dayofweeks">

                                                        <div class="row g-0">
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select select-DOW"
                                                                        onchange="CheckSameOptionDOW(event);">
                                                                        <option value="-1">-- Thứ --</option>
                                                                        <option value="1">Thứ 2</option>
                                                                        <option value="2">Thứ 3</option>
                                                                        <option value="3">Thứ 4</option>
                                                                        <option value="4">Thứ 5</option>
                                                                        <option value="5">Thứ 6</option>
                                                                        <option value="6">Thứ 7</option>
                                                                        <option value="0">Chủ nhật</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select morning">
                                                                        <option value="0">-- Buổi sáng --</option>
                                                                        <option value="07:30 - 09:00">07h30 - 09h00
                                                                        </option>
                                                                        <option value="09:30 - 11:00">09h30 - 11h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select afternoon">
                                                                        <option value="0">-- Buổi chiều --</option>
                                                                        <option value="13:30 - 15:00">13h30 - 15h00
                                                                        </option>
                                                                        <option value="15:30 - 17:00">15h30 - 17h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select evening">
                                                                        <option value="0">-- Buổi tối --</option>
                                                                        <option value="18:00 - 19:30">18h00 - 19h30
                                                                        </option>
                                                                        <option value="20:00 - 21:30">20h00 - 21h30
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto mt-3 me-1 ms-auto">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        onclick="AddNewDOW(event);">Thêm buổi dạy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--  -->
<!-- 
                                    <div class="container border p-2">
                                        <div class="row g-0 ">
                                            <div class="col-md-4 ">
                                                <div class="form-group">

                                                    <select class="form-select select-subject"
                                                        onchange="CheckSameOptionSubject(event);">
                                                        <option value="0">-- Môn học --</option>
                                                        <option value="Toán">Toán</option>
                                                        <option value="Vật lý">Vật lý</option>
                                                        <option value="Hoá học">Hoá học</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-0 py-3 container-dayofweeks">
                                                <div>
                                                    <div class="col-md-12 p-0 dayofweeks">

                                                        <div class="row g-0">
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select select-DOW"
                                                                        onchange="CheckSameOptionDOW(event);">
                                                                        <option value="-1">-- Thứ --</option>
                                                                        <option value="1">Thứ 2</option>
                                                                        <option value="2">Thứ 3</option>
                                                                        <option value="3">Thứ 4</option>
                                                                        <option value="4">Thứ 5</option>
                                                                        <option value="5">Thứ 6</option>
                                                                        <option value="6">Thứ 7</option>
                                                                        <option value="0">Chủ nhật</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select morning">
                                                                        <option value="0">-- Buổi sáng --</option>
                                                                        <option value="07:30 - 09:00">07h30 - 09h00
                                                                        </option>
                                                                        <option value="09:30 - 11:00">09h30 - 11h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select afternoon">
                                                                        <option value="0">-- Buổi chiều --</option>
                                                                        <option value="13:30 - 15:00">13h30 - 15h00
                                                                        </option>
                                                                        <option value="15:30 - 17:00">15h30 - 17h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select evening">
                                                                        <option value="0">-- Buổi tối --</option>
                                                                        <option value="18:00 - 19:30">18h00 - 19h30
                                                                        </option>
                                                                        <option value="20:00 - 21:30">20h00 - 21h30
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 p-0 dayofweeks">

                                                        <div class="row g-0">
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select select-DOW"
                                                                        onchange="CheckSameOptionDOW(event);">
                                                                        <option value="-1">-- Thứ --</option>
                                                                        <option value="1">Thứ 2</option>
                                                                        <option value="2">Thứ 3</option>
                                                                        <option value="3">Thứ 4</option>
                                                                        <option value="4">Thứ 5</option>
                                                                        <option value="5">Thứ 6</option>
                                                                        <option value="6">Thứ 7</option>
                                                                        <option value="0">Chủ nhật</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select morning">
                                                                        <option value="0">-- Buổi sáng --</option>
                                                                        <option value="07:30 - 09:00">07h30 - 09h00
                                                                        </option>
                                                                        <option value="09:30 - 11:00">09h30 - 11h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select afternoon">
                                                                        <option value="0">-- Buổi chiều --</option>
                                                                        <option value="13:30 - 15:00">13h30 - 15h00
                                                                        </option>
                                                                        <option value="15:30 - 17:00">15h30 - 17h00
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <div class="form-group">

                                                                    <select class="form-select evening">
                                                                        <option value="0">-- Buổi tối --</option>
                                                                        <option value="18:00 - 19:30">18h00 - 19h30
                                                                        </option>
                                                                        <option value="20:00 - 21:30">20h00 - 21h30
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto mt-3 me-1 ms-auto">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        onclick="AddNewDOW(event);">Thêm buổi dạy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!--  -->
                                </div>


                            </div>

                            <div class="pt-3 text-start">
                                <button type="button" class="btn btn-outline-primary" id="addSubject">Thêm môn
                                    học</button>
                            </div>

                        </div>
                    </div>

                    <div class=" text-end">
                        <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
                    </div>
                </form>



            </div>
        </div>


    </div>

    <?php include "inc/script.php" ?>

    <script>
        $(document).ready(function () {

            $("#form-submit").on('submit', function (e) {

                /*   var subjects = $("#firstName").val();
                   var lastName = $("#lastName").val();
                   var email = $("#email").val();
                   var message = $("#message").val();
   
                   if (firstName == '' || lastName == '' || email == '' || message == '') {
                       alert("Please fill all fields.");
                       return false;
                   }*/
                e.preventDefault();
                let test = { "subjects": [] };
                let i = -1, j = -1;
                $(".container").find("select").each((idx, select) => {
                    if ($(select).hasClass("select-subject")) {

                        test.subjects.push(
                            {"subject": $(select).val(),
                             "dayofweeks": [] });

                        i++;
                        j = -1;
                    }

                    if ($(select).hasClass("select-DOW")) {
                        test.subjects[i].dayofweeks.push({ 
                            "dayofweek": $(select).val(),
                             "morning": null, 
                             "afternoon": null, 
                             "evening": null });
                        j++;


                    }

                    if ($(select).hasClass("morning")) {
                        test.subjects[i].dayofweeks[j].morning = $(select).val();
                    }

                    if ($(select).hasClass("afternoon")) {
                        test.subjects[i].dayofweeks[j].afternoon = $(select).val();
                    }
                    if ($(select).hasClass("evening")) {
                        test.subjects[i].dayofweeks[j].evening = $(select).val();
                    }
                    console.log(i, j)




                    // console.log($(select).hasClass("afternoon"), "afternoon");
                    // console.log($(select).hasClass("evening"), "evening");
                })

                console.log(JSON.stringify(test), "test")

                let data = {
                    "subjects": [{
                        "subject": "Toán",
                        "dayofweeks": [{
                            "dayofweek": 7,
                            "morning": "07:30 - 09:00",
                        }, {
                            "dayofweek": 0,
                            "afternoon": "09:30 - 11:00",
                        }]

                    }, {
                        "subject": "Vật lí",
                        "dayofweeks": [{
                            "dayofweek": 5,
                            "evening": "18:30 - 20:00",
                        }]
                    }]

                };

                console.log(data)

                $.ajax({
                    type: "post",
                    url: "http://localhost:8080/MyPhp/php/schedule_tutors.php",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(test),
                    cache: false,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr);
                    }
                });

            });

        });
    </script>

</body>

</html>