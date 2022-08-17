<?php

namespace Admin;

use Classes\Subject;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ../../pages/login");
}
//  Classes\Subject, Classes\SubjectTopic;

// include_once "../../classes/subjects.php";

$_subject = new Subject();

$title = "Quản lý gia sư";
include_once "../inc/header.php" ?>
<section>
    <!-- image viewer -->
    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content-viewer" id="full-image">
    </div>
    <!--  -->
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?php include_once "../inc/sliderbar.php" ?>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Content -->
        <div class="content">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-body row px-md-3 px-1">
                        <!-- <div class="d-flex mb-4 col-12">
                            <button type="button" class="btn btn-outline-primary d-inline-flex " data-bs-toggle="modal" data-bs-target="#modalAddSubject">
                                <span class="material-symbols-rounded">
                                    add
                                </span>
                                <span class="d-block">Thêm mới</span>
                            </button>
                            <button type="button" class="btn btn-outline-danger d-inline-flex mx-1" id="multiple-delete-subject">
                                <span class="material-symbols-rounded">
                                    delete
                                </span>
                                <span class="d-block px-1">Xoá nhiều</span>
                            </button>

                        </div> -->


                        <div class="col-12">
                            <div class="table-stats order-table ov-h">
                                <table id="user-table" class="table table-hover table-type-1" style="width: 100% !important">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col"><input class="form-check-input " id="select-all-user" type="checkbox"></th>
                                            <th scope="col">Hình</th>
                                            <th scope="col">Họ</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">username</th>
                                            <th scope="col">Giới tính</th>
                                            <th scope="col">Vai trò</th>
                                            <th scope="col" class="text-center">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       


        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->
</section>
<?php include_once "../inc/script.php" ?>
<script type="module">
    
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>

    </script>
</body> -->

<!-- </html> -->