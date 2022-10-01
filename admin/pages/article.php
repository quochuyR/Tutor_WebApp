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

$title = "Bài viết";

// include "../../classes/adminhomepage.php";

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
                <div class="row  align-items-center pb-4">
                    <div class="col-auto">
                        <a href="articleinsert"><button type="submit" class="btn btn-primary">Thêm mới</button></a>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="actionArticle" data-bs-toggle="dropdown" aria-expanded="false">
                                Tùy chọn
                            </a>
                            <ul class="dropdown-menu bg-secondary" aria-labelledby="actionArticle">
                                <li><a class="dropdown-item" id="publishedArticle" href="#">Công bố</a></li>
                                <li><a class="dropdown-item" id="unPublishedArticle" href="#">Hủy xuất bản</a></li>
                                <li><a class="dropdown-item" id="deleteArticle" href="#">Xóa</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" id="reloadTableArticle">Làm mới</a>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">? Giúp đỡ</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center m-4">Danh sách bài đăng</h3>
                        <div class="text-center">
                            <div class="spinner-border spinnertable text-success fade" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <table class="table  mt-4" id="tableblogs">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Modal succes post-->
        <div class="modal fade gb-primary" id="modalPostStatus" tabindex="-1" aria-labelledby="modalPostStatusLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPostStatusLabel">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Thêm bài viết thành công</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal succes post -->
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