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

$title = "Quản lý môn học";
include_once "../inc/header.php" ?>
<section>

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
                    <div class="card-body">
                        <div class="card mt-4">
                            <div class="card-body row px-md-3 px-1">
                                <div class="d-flex mb-4 col-12">
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

                                </div>


                                <div class="col-md-7">
                                    <table id="subject-table" class="table table-hover table-type-1" style="width: 100% !important">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col"><input class="form-check-input " id="select-all-subject" type="checkbox"></th>
                                                <th scope="col">Id</th>
                                                <th scope="col">Tên môn học</th>
                                                <th scope="col">Hành động</th>
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
        </div>
        <!-- Modal Add subject -->
        <div class="modal fade" id="modalAddSubject" tabindex="-1" aria-labelledby="modalAddSubjectLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalAddSubjectLabel">Thêm môn học</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="add-subject-form" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="control-input-subject" class="form-label">Tên môn học</label>
                                        <!-- <input type="text" class="form-control" id="control-input-subject" placeholder="Ví dụ: Công nghệ thông tin" minlength="3" required> -->
                                        <textarea class="form-control" id="control-input-subject" name="subject-name" placeholder="Ví dụ: Công nghệ thông tin" minlength="3" rows="3" required></textarea>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập môn học nhiều hơn 2 kí tự
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer">
                                <h4 class="fw-bold py-2">Lưu ý:</h4>
                                <ul>
                                    <li>shift + enter: Xuống hàng (nếu muốn thêm nhiều môn học)</li>
                                    <li>enter: Lưu dữ liệu (thêm môn học)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                        <button type="button" class="btn btn-primary" id="save-change-subject">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->
</section>
<?php include_once "../inc/script.php" ?>
<script>
    
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>

    </script>
</body> -->

<!-- </html> -->