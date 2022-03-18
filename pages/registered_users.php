<?php

namespace Views;

use Library\Session;
?>
<!DOCTYPE html>
<html lang="en">

<?

$title = "Người dùng đăng ký";
include "../inc/head.php";
include "../lib/session.php";
?>

<?php
if (Session::checkRoles(["tutor", "user"]) !== true) {
    header("location: errors/404");
}

?>


<body>

    <div class="container-fluid">
        <header class="row g-0 m-0">

            <?php
            $nav_tutor_active = "active";
            include "../inc/header.php";
            ?>

        </header>
        <div id="main" class="container ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto mb-4">
                        <div class="section-title text-center ">
                            <h3 class="top-c-sep">Danh sách người dùng đăng ký</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="career-search mb-60">

                            <div class="filter-result">
                                <p class="mb-30 ff-montserrat">Tổng cộng: 3</p>

                                <div class="job-box d-md-flex align-items-center justify-content-between mb-30  position-relative">
                                    <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                        <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                            <img src="images/175337396_2917917531830460_8008229113997594091_n.jpg" alt=".">
                                        </div>
                                        <div class="job-content">
                                            <h5 class="text-xs-center text-md-left">Nguyễn Quốc Huy</h5>
                                            <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                            <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                <li class="text-sub text-muted">
                                                    <i class="fa-solid fa-book pe-1"></i> Lập trình C | Lập trình Python
                                                </li>
                                                <li class="text-muted py-1">
                                                    <i class="fa-solid fa-user-graduate"></i> Sinh viên
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="d-md-none d-block pb-4 pb-md-0">
                                        <ul class="d-flex justify-content-end ">
                                            <li><a class="text-reset text-decoration-none" href="#"><i class="fas fa-eye me-1"></i> Xem</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-user-check"></i> Duyệt</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-calendar-days"></i> Lịch dạy</a></li>

                                        </ul>
                                    </div>
                                    <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye pe-2"></i> Xem</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-check pe-2"></i>Duyệt</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days pe-3"></i>Lịch dạy</a></li>

                                            </ul>
                                        </div>
                                        <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                    </div>

                                    <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i> 2
                                        tuần trước</div>
                                </div>

                                <div class="job-box d-md-flex align-items-center justify-content-between mb-30 position-relative">
                                    <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                        <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                            <img src="images/144185147_462103764917452_5125494602597852051_n.jpg" alt=".">
                                        </div>
                                        <div class="job-content">
                                            <h5 class="text-xs-center text-md-left">Nguyễn Minh Đăng</h5>
                                            <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                            <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                <li class="text-sub text-muted">
                                                    <i class="fa-solid fa-book pe-1"></i> Lập trình C | Lập trình Python
                                                </li>
                                                <li class="text-muted py-1">
                                                    <i class="fa-solid fa-user-graduate"></i> Sinh viên
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="d-md-none d-block pb-4 pb-md-0">
                                        <ul class="d-flex justify-content-end ">
                                            <li><a class="text-reset text-decoration-none" href="#"><i class="fas fa-eye me-1"></i> Xem</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-user-check"></i> Duyệt</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-calendar-days"></i> Lịch dạy</a></li>

                                        </ul>
                                    </div>
                                    <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye pe-2"></i> Xem</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-check pe-2"></i>Duyệt</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days pe-3"></i>Lịch dạy</a></li>

                                            </ul>
                                        </div>
                                        <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                    </div>

                                    <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i> 2
                                        tuần trước</div>
                                </div>

                                <div class="job-box d-md-flex align-items-center justify-content-between mb-30 position-relative">
                                    <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                        <div class="img-holder mx-2 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                            <img src="images/270571222_1426358357761639_675267433749402851_n.jpg" alt=".">
                                        </div>
                                        <div class="job-content">
                                            <h5 class="text-xs-center text-md-left">Nguyễn Khánh</h5>
                                            <!-- <div class="text-muted ms-5 mt-3 mt-md-0"></div>
                                            <div class="text-muted ms-5">Sinh viên</div> -->
                                            <ul class="d-md-flex flex-md-column flex-wrap my-md-2 ff-open-sans p-0">
                                                <li class="text-sub text-muted">
                                                    <i class="fa-solid fa-book pe-1"></i> Lập trình C | Lập trình Python
                                                </li>
                                                <li class="text-muted py-1">
                                                    <i class="fa-solid fa-user-graduate"></i> Sinh viên
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="d-md-none d-block pb-4 pb-md-0">
                                        <ul class="d-flex justify-content-end ">
                                            <li><a class="text-reset text-decoration-none" href="#"><i class="fas fa-eye me-1"></i> Xem</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-user-check"></i> Duyệt</a></li>
                                            <li><a class="ms-3 text-reset text-decoration-none" href="#"><i class="fa-solid fa-calendar-days"></i> Lịch dạy</a></li>

                                        </ul>
                                    </div>
                                    <div class="job-right my-4 flex-shrink-0 d-none d-md-flex">

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye pe-2"></i> Xem</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-check pe-2"></i>Duyệt</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days pe-3"></i>Lịch dạy</a></li>

                                            </ul>
                                        </div>
                                        <!-- <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light mx-1"><i class="fas fa-eye me-1"></i> Xem</a> -->
                                    </div>

                                    <div class="text-muted position-absolute br-2"><i class="far fa-calendar-check me-1"></i> 2
                                        tuần trước</div>

                                </div>

                            </div>
                        </div>

                        <!-- START Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-reset justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="zmdi zmdi-long-arrow-left">Trước</i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a></li>
                                <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="zmdi zmdi-long-arrow-right">Sau</i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- END Pagination -->
                    </div>
                </div>

            </div>
        </div>
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>
    </div>


    <?php include "../inc/script.php" ?>
</body>

</html>