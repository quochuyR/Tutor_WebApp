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
// $db_adminhomepage  = new Adminhomepage();
// if (isset($_POST["upload_button"]) && !empty($_FILES["file"]["name"]) && !empty($_POST["title"])) {
//     $db_adminhomepage->UploadImage();
// }
// //show or hide in homepage
// if (isset($_GET['imageid']) && isset($_GET['status'])) {

//     $id = $_GET['imageid'];
//     $status = $_GET['status'];
//     //hiển thị ra trên trang chủ
//     $db_adminhomepage->EidtStatus($id, $status);
// }

// if (isset($_GET['idDelete'])) {
//     $idDelete = $_GET['idDelete'];
//     $db_adminhomepage->Delete($idDelete);
// }

// //tự động điền vào bài viết
// if (
//     isset($_POST['blogsid'])
//     && !empty($_POST['blogsid'])
// ) {
//     $id = $_POST['blogsid'];
//     $db_Blogpage = new Blogpage();
//     $result = $db_Blogpage->selectBlog($id);
// }
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
                        <button type="submit" class="btn btn-primary" id="saveArticle">Lưu lại</button>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group">
                            <a href="" class="btn btn-secondary" id="saveNewArticle">Lưu lại và mới</a>
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu mt-5 " aria-labelledby="dropdownMenuReference">
                                <li><a class="dropdown-item" href="article" id="saveCloseArticle">Lưu lại và đóng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="Article" class="btn btn-primary">Trở về</a>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">? Giúp đỡ</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <input type="text" name="titleArticle" id="titleArticle" class="form-control mb-3 p-1" placeholder="Tiêu đề bài viết">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button name="change_post2" class="nav-link active" id="post-homepage-tab2" data-bs-toggle="tab" data-bs-target="#post-homepage2" type="button" role="tab" aria-controls="post-homepage2" aria-selected="true">Bài viết</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button name="loadimg" class="nav-link " id="uploadImage-tab" data-bs-toggle="tab" data-bs-target="#uploadImage" type="button" role="tab" aria-controls="uploadImage" aria-selected="false">Hình ảnh</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="post-homepage2" role="tabpanel" aria-labelledby="post-homepage-tab2">
                                <!-- Đăng bài viết giới thiệu -->
                                <div class="container-fluid">
                                    <form id="post-form">
                                        <div class="row">
                                            <div class="col-8  pt-2 pb-2 mt-4 mb-4 shadow">
                                                <!-- <h3 class="mb-2">Viết bài</h3> -->
                                                <label class="p-2" for="textareaArticle"><b>Nội dung</b></label>
                                                <textarea id="textareaArticle" placeholder="Nội dung..."></textarea>
                                            </div>
                                            <div class="col-4 p-4">
                                                <div class="row text-start">
                                                    <div class="col-12 border shadow rounded-2 p-1 mb-3">
                                                        <div class="text-center p-1 pb-0">
                                                            <h6 id="textip">
                                                                <b>
                                                                    Công bố
                                                                </b>
                                                            </h6>
                                                        </div>
                                                        <hr>
                                                        <div class="ps-3 pe-2 pt-0">
                                                            <div class="row">
                                                                <div class="col-12 mb-3">
                                                                    <div class="row">
                                                                        <label for="status" class="col-5 col-form-label">Trạng thái: </label>
                                                                        <div class="col-7">
                                                                            <select name="statuspost" id="status" class=" form-select">
                                                                                <option value="1">Công bố</option>
                                                                                <option value="0">Chưa xuất bản</option>
                                                                                <option value="-1">Lưu trữ (Đang phát triển)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mb-3">
                                                                    <div class="row">
                                                                        <label for="pre" class="col-5 col-form-label">Quyền riêng tư: </label>
                                                                        <div class="col-7">
                                                                            <select name="pre" id="pre" class="form-select">
                                                                                <option value="1">Công khai</option>
                                                                                <option value="0">(Đang phát triển)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mb-3">
                                                                    <div class="row">
                                                                        <label for="datetime" class="col-5 col-form-label">Thời gian: </label>
                                                                        <div class="col-7">
                                                                            <input type="text" id="datetime" class="form-control" disabled value="<?php
                                                                                                                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                                                                            $date = date('d/m/Y', time());
                                                                                                                                            echo $date;
                                                                                                                                            ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mb-3">
                                                                    <div class="row">
                                                                        <div class="col-auto">
                                                                            <select class="form-select" id="SelectKind" aria-label="Default select example">
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            <div class="btn btn-primary text-center">
                                                                                <a href="category" class="link-light"> <i class="fas fa-plus-circle"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            <div class="btn btn-primary text-center">
                                                                                <a href="category" class="link-light" id="reloadSelectCategory"> <i class="fa-solid fa-rotate-right"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <hr>
                                                        <div class="p-3 pt-0">
                                                            <div class="d-flex justify-content-between">
                                                                <input type="submit" name="savepost" id="savepost" class="btn btn-primary" value="Lưu lại">
                                                                <input type="submit" name="postblog" id="publishpost" class="btn btn-success justyfi" value="Công bố">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="uploadImage" role="tabpanel" aria-labelledby="uploadImage-tab">
                                <div class="mb-3 pt-1 pb-1 text-start">
                                    <label for="imageArticle_small">Hình hiển thị khi thu nhỏ*</label>
                                    <input class="form-control" type="file" id="imageArticle_small" placeholder="Tải hình ảnh">
                                </div>
                                <div class="mb-3 pt-1 pb-1 text-start">
                                    <label for="imageArticle_big">Hình hiển thị trong bài viết (Đang phát triển)</label>
                                    <input class="form-control" type="file" id="imageArticle_big" placeholder="Tải hình ảnh">
                                </div>
                            </div>

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