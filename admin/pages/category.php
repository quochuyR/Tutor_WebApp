<?php

namespace Admin;

use Classes\Adminhomepage;
use Classes\Blogpage;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ./errors/404");
}
//  Classes\Subject, Classes\SubjectTopic;

$title = "Danh mục";


?>


<?php include_once "../inc/header.php" ?>

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
                        <div class="row g-3 align-items-center pb-4">
                            <div class="col-auto">
                                <a href="categorynew">
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="actionCategory" data-bs-toggle="dropdown" aria-expanded="false">
                                        Tùy chọn
                                    </a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="actionCategory">
                                        <li><a class="dropdown-item" id="publishedCategory" href="#">Công bố</a></li>
                                        <li><a class="dropdown-item" id="unPublishedCategory" href="#">Hủy xuất bản</a></li>
                                        <li><a class="dropdown-item" id="deleteCategory" href="#">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" id="reloadTableCategory">Làm mới</a>
                            </div>
                            <div class="col-auto">
                                <a type="submit" class="btn btn-primary">? Giúp đỡ</a>
                            </div>
                        </div>
                        <!-- danh sách category -->
                        <div class="">
                            <h3 class="text-center m-4"></h3>
                            <div class="text-center">
                                <div class="spinner-border spinnertable text-success fade" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <table class="table  mt-4" id="tableCategory">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Vị trí</th>
                                        <th scope="col">Công bố</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

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
<script>

</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>
        
    </script>
</body> -->

<!-- </html> -->