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
                        <div class="row  align-items-center pb-4">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" id="saveEditCategory">Lưu lại</button>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group">
                                    <a href="categorynew" class="btn btn-secondary" id="saveEditNewCategory">Lưu lại và mới</a>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu mt-5 " aria-labelledby="dropdownMenuReference">
                                        <li><a class="dropdown-item" href="category" id="saveEditCloseCategory">Lưu lại và đóng</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="category" class="btn btn-primary">Trở về</a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">? Giúp đỡ</button>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="litleEditCategory" class="form-label"><h4><b>Tên danh mục</b></h4></label>
                                <input type="text" class="form-control" id="titleEditCategory">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h4><b>Mô tả về danh mục</b></h4>
                                <textarea id="aboutEditCategory" placeholder="Nội dung..."></textarea>
                            </div>
                            <div class="col-4">
                                <h4 class="text-center mb-2"><b>Tùy chỉnh</b></h4>
                                <div class="mb-3">
                                    <label for="eidtPosition_show" class="form-label">Vị trí hiển thị</label>
                                    <select id="eidtPosition_show" class="form-select">
                                        <option value="none">Không có</option>
                                        <option value="feature_news">Tin nổi bậc</option>
                                        <option value="feature_1">Tin nổi bậc hàng 1</option>
                                        <option value="theme_Category_1">Hàng 1 theo chủ đề</option>
                                        <option value="theme_Category_2">hàng 2 theo chủ đề</option>
                                        <option value="hot_news_1">Tin mới - hàng 1</option>
                                        <option value="hot_news_2">Tin mới - hàng 2</option>
                                        <!-- DOM html  -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="statusEditCategory" class="form-label">Trạng thái</label>
                                    <select id="statusEditCategory" class="form-select">
                                        <option value="1">Công bố</option>
                                        <option value="0">Chưa xuất bản</option>
                                        <option value="-1">lưu trữ (Đang phát triển)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="parentEditCategory" class="form-label">Danh mục cha</label>
                                    <select id="parentEditCategory" class="form-select">
                                        <option value="0">Không có</option>
                                        <!-- DOM html  -->
                                    </select>
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
<script>

</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>
        
    </script>
</body> -->

<!-- </html> -->