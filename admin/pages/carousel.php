<?php

namespace Admin;

use Classes\Adminhomepage;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ./errors/404");
}
//  Classes\Subject, Classes\SubjectTopic;

$title = "Tải hình ảnh";

// include "../../classes/adminhomepage.php";
$db_adminhomepage  = new Adminhomepage();
if (isset($_POST["upload_button"]) && !empty($_FILES["file"]["name"]) && !empty($_POST["title"])) {
    $db_adminhomepage->UploadImage();
}
//show or hide in homepage
if (isset($_GET['imageid']) && isset($_GET['status'])) {

    $id = $_GET['imageid'];
    $status = $_GET['status'];
    //hiển thị ra trên trang chủ
    $db_adminhomepage->EidtStatus($id, $status);
}

if (isset($_GET['idDelete'])) {
    $idDelete = $_GET['idDelete'];
    $db_adminhomepage->Delete($idDelete);
}

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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button name="loadimg" class="nav-link " id="carousel-tab" data-bs-toggle="tab" data-bs-target="#carousel" type="button" role="tab" aria-controls="carousel" aria-selected="false">Tải hình ảnh</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button name="change_post" class="nav-link" id="post-homepage-tab" data-bs-toggle="tab" data-bs-target="#post-homepage" type="button" role="tab" aria-controls="post-homepage" aria-selected="false">Viết bài viết</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button name="change_post2" class="nav-link active" id="post-homepage-tab2" data-bs-toggle="tab" data-bs-target="#post-homepage2" type="button" role="tab" aria-controls="post-homepage2" aria-selected="true">Viết bài viết 2</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="carousel" role="tabpanel" aria-labelledby="carousel-tab">
                                <!-- hình ảnh trang chủ  -->
                                <div class="container">
                                    <h1 id="carousel-h1" class="m-3 text-center"><strong>Tải hình ảnh trang chủ</strong></h1>
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            <form class="row g-3" action method="post" enctype="multipart/form-data">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label id="carousel-title" for="title" class="form-label">Tên hình</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <div id="titleHelp" class="form-text text-end">Tên hình gồm các kí tự: *, _, -, chữ và số</div>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="title" id="title" class="form-control rounded" aria-describedby="titleHelp" required="required" placeholder="Tên hình của ảnh" />
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="image-upload" class="form-label h-3">Tải hình ảnh lên</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <div id="imgHelp" class="form-text text-end">Nên chọn tệp hình ảnh có kích thước 1400x600</div>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" type="file" name="file" id="image-upload" required="required" multiple="multiple" aria-describedby="imgHelp" />
                                                </div>
                                                <!-- <div class="col-12" id="file-dummy">
                                                    <div class="success">Tải thành công</div>
                                                    <div class="default">Vui lòng chọn lại tệp hình ảnh</div>
                                                </div> -->
                                                <div class="col-12 text-center">
                                                    <button id="button_uploadImg" name="upload_button" class="btn rounded border bg-success text-light" type="submit">Tải lên</button>
                                                </div>
                                            </form>

                                        </div>
                                        <link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>
                                    </div>
                                    <!-- test image have upload yet ! -->
                                    <hr>
                                    <div class="m-3 mt-4 ms-5">
                                        <h3 id="carousel-h1" class="text-start" aria-describedby="ListImages"><strong>Danh sách hình ảnh</strong></h3>
                                        <div id="ListImages" class="form-text text-start">*Chỉ hiển thị được tối đa 3 hình ảnh cùng 1 lúc</div>
                                    </div>
                                    <div class="d-flex justify-content-around p-4">
                                        <div id="cards" class="card-group row text-center">
                                            <?php
                                            // Get images from the database
                                            $query = $db_adminhomepage->ListImgPost();
                                            $filepath  = realpath(dirname(__FILE__));

                                            if ($query->num_rows > 0) {
                                                while ($row = $query->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $imageURL = '../public/images/carousel/' . $row["file_name"];
                                                    $imageName = $row["name"];
                                                    $status = $row["status"];
                                                    //dùng để ẩn hoặc hiện hình này ở trang chủ
                                                    $txt = "Hiển thị";
                                                    $changeStatus = 1;
                                                    if ($status == 1) {
                                                        $txt = "Ẩn";
                                                        $changeStatus = 0;
                                                    }
                                            ?>
                                                    <div class="col mb-3">
                                                        <div class="card" style="width: 18rem;"><img class="card-img-top" src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>">
                                                            <div class="card-body">
                                                                <h5 class="card-title" name="imageName"><?php echo $imageName; ?></h5>
                                                                <div class="d-flex justify-content-around">
                                                                    <a href="?imageid=<?php echo $id; ?>&status=<?php echo $changeStatus; ?>" class="btn btn-success"><?php echo $txt ?></a>
                                                                    <a href="?idDelete=<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else { ?>
                                                <h3>Chưa có hình ảnh nào được tải lên!</h3>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="post-homepage" role="tabpanel" aria-labelledby="post-homepage-tab">
                                <!-- Đăng bài viết giới thiệu -->
                                <div class="container-fluid d-flex justify-content-center text-center">
                                    <form action="" method="POST" id="post-form">
                                        <div class="row container">
                                            <div class="col-8  p-5 mb-4 shadow">
                                                <div class="row">
                                                    <input name="titlepost" class="col-12 rounded-3" type="text" placeholder="Thêm tiêu đề" required="required">
                                                </div>
                                                <div class="row mt-3">
                                                    <!-- <div id="editor" class="col-12" name="editor"></div> -->

                                                </div>
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
                                                        <div class="p-3 pt-0">
                                                            <div class="d-flex justify-content-between pb-2">
                                                                <input type="submit" name="savepost" class="btn btn-primary" value="Lưu lại">
                                                                <input type="button" name="review" class="btn btn-primary" value="Xem trước">
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <p>
                                                                        Trạng thái:
                                                                        <b>
                                                                            <snap>
                                                                                <input type="checkbox" name="statuspost" id="status" value="1">
                                                                                <label for="status">Hiểu thị ở trang chủ</label>
                                                                            </snap>
                                                                        </b>
                                                                    <p>Quyền riêng tư: <b>
                                                                            <snap>Công khai</snap>
                                                                        </b>
                                                                        <a href="#">chỉnh sửa</a>
                                                                    </p>
                                                                    <p>Ngày công bố: <b>
                                                                            <snap>
                                                                                <?php
                                                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                $date = date('d/m/Y', time());
                                                                                echo $date;
                                                                                ?>
                                                                            </snap>
                                                                        </b><a href="#">chỉnh sửa</a></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="d-flex justify-content-end">
                                                                <input type="submit" value="Công bố" name="posts" class="btn btn-success justyfi">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 p-1 rounded-2 border shadow">
                                                        <h6 class="text-center"><b>Loại danh sách bài viết</b></h6>
                                                        <hr>
                                                        <ul class="list-unstyled p-3 pt-0">
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Trích dẫn" id="radioKind1" checked>
                                                                <label class="form-check-label" for="radioKind1">Trích dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Bài viết" id="radioKind2">
                                                                <label class="form-check-label" for="radioKind2">Bài viết</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Hướng dẫn" id="radioKind3">
                                                                <label class="form-check-label" for="radioKind3">Hướng dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Thông tin chung" id="radioKind4">
                                                                <label class="form-check-label" for="radioKind4">Thông tin chung</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Giới thiệu" id="radioKind5">
                                                                <label class="form-check-label" for="radioKind5">Giới thiệu</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border shadow p-1 rounded-2">
                                                <!-- DOM cái này bằng PHP -->
                                                <div class="container w-70">
                                                    <h4 class="text-center">Danh sách bài đăng</h4>
                                                    <table class="table  mt-4">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Số thứ tự</th>
                                                                <th scope="col">Tiêu đề</th>
                                                                <th scope="col">Thời gian</th>
                                                                <th scope="col">Trạng thái</th>
                                                                <th scope="col">Thể loại</th>
                                                                </th>
                                                                <th scope="col"></th>
                                                                <th scope="col">Chọn</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            //đường dẫn chuyển qua trang chỉnh sửa
                                                            $linkPostpageEdit = './page_editpost?idEditPost=';
                                                            // đường dẫn chuyển qua trang xóa
                                                            $linkPostpageDelete = './page_editpost?idDeletePost=';
                                                            $db_adminhomepage->FillPostToTable($linkPostpageEdit, $linkPostpageDelete);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="d-flex justify-content-end pb-3">
                                                        <input class="m-1 btn btn-success" type="button" value="Xóa" name="delete">
                                                        <input class="m-1 btn btn-success" type="button" value="Hiển thị" name="showInfo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="tab-pane fade show active" id="post-homepage2" role="tabpanel" aria-labelledby="post-homepage-tab2">
                                <!-- Đăng bài viết giới thiệu -->
                                <div class="container-fluid d-flex justify-content-center text-center">
                                    <form id="post-form">
                                        <div class="row container">
                                            <div class="col-8  pt-2 pb-2 mt-4 mb-4 shadow">
                                                <!-- <h3 class="mb-2">Viết bài</h3> -->
                                                <input type="text" name="titlepost" id="titlepost" class="form-control mb-3 p-1" placeholder="Tiêu đề bài viết">
                                                <div class="mb-3 pt-1 pb-1 text-start">
                                                    <label for="imagepost">Hình ảnh đại diện trên bài viết</label>
                                                    <input class="form-control" type="file" id="imagepost" placeholder="Tải hình ảnh">
                                                </div>
                                                <textarea id="mytextareapost">Hello, World!</textarea>
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
                                                        <div class="p-3 pt-0">
                                                            <div class="d-flex justify-content-between pb-2">
                                                                <!-- <input type="submit" name="savepost" id="savepost" class="btn btn-primary" value="Lưu lại"> -->
                                                                <!-- <input type="button" name="review" class="btn btn-primary" value="Xem trước"> -->
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <p>
                                                                        Trạng thái:
                                                                        <b>
                                                                            <snap>
                                                                                <input type="checkbox" name="statuspost" id="status" value="1">
                                                                                <label for="status">Hiểu thị ở trang chủ</label>
                                                                            </snap>
                                                                        </b>
                                                                    <p>Quyền riêng tư: <b>
                                                                            <snap>Công khai</snap>
                                                                        </b>
                                                                        <a href="#">chỉnh sửa</a>
                                                                    </p>
                                                                    <p>Ngày công bố: <b>
                                                                            <snap>
                                                                                <?php
                                                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                $date = date('d/m/Y', time());
                                                                                echo $date;
                                                                                ?>
                                                                            </snap>
                                                                        </b><a href="#">chỉnh sửa</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6 class="text-center"><b>Chủ đề</b></h6>
                                                        <hr>
                                                        <ul class="list-unstyled p-3 pt-0 mt-0">
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Trích dẫn" id="radioKind1" checked>
                                                                <label class="form-check-label" for="radioKind1">Trích dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Bài viết" id="radioKind2">
                                                                <label class="form-check-label" for="radioKind2">Bài viết</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Hướng dẫn" id="radioKind3">
                                                                <label class="form-check-label" for="radioKind3">Hướng dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Thông tin chung" id="radioKind4">
                                                                <label class="form-check-label" for="radioKind4">Thông tin chung</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Giới thiệu" id="radioKind5">
                                                                <label class="form-check-label" for="radioKind5">Giới thiệu</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <div class="text-decoration-underline">
                                                                    <a href="#" id="addKind">Thêm mới... </a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <hr>
                                                        <div class="p-3 pt-0">
                                                            <div class="d-flex justify-content-between">
                                                                <input type="submit" name="savepost" id="savepost" class="btn btn-primary" value="Lưu lại">

                                                                <input type="submit" name="postblog" id="publishpost" class="btn btn-success justyfi" value="Công bố">
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="border shadow p-1 rounded-2">
                                                <!-- DOM cái này bằng PHP -->
                                                <div class="container w-70">
                                                    <h4 class="text-center">Danh sách bài đăng</h4>
                                                    <table class="table  mt-4">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Số thứ tự</th>
                                                                <th scope="col">Tiêu đề</th>
                                                                <th scope="col">Thời gian</th>
                                                                <th scope="col">Trạng thái</th>
                                                                <th scope="col">Thể loại</th>
                                                                </th>
                                                                <th scope="col"></th>
                                                                <th scope="col">Chọn</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            //đường dẫn chuyển qua trang chỉnh sửa
                                                            $linkPostpageEdit = './page_editpost?idEditPost=';
                                                            // đường dẫn chuyển qua trang xóa
                                                            $linkPostpageDelete = './page_editpost?idDeletePost=';
                                                            $db_adminhomepage->FillPostToTable($linkPostpageEdit, $linkPostpageDelete);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="d-flex justify-content-end pb-3">
                                                        <input class="m-1 btn btn-success" type="button" value="Xóa" name="delete">
                                                        <input class="m-1 btn btn-success" type="button" value="Hiển thị" name="showInfo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- modal start thêm thể loại bài viết  -->
            <div>
                <div class="modal" id="kindModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Thêm chủ đề bài viết</h5>
                                <button type="button" class="btn-close closeKindModal" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button name="loadimg" class="nav-link " id="navaddthemepost" data-bs-toggle="tab" data-bs-target="#addthemepost" type="button" role="tab" aria-controls="carousel" aria-selected="false">Thêm</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button name="loadimg" class="nav-link " id="naveditthemepost" data-bs-toggle="tab" data-bs-target="#editthemepost" type="button" role="tab" aria-controls="carousel" aria-selected="false">Chỉnh sửa</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-3" id="myTabContent">
                                    <div class="tab-pane show active" id="addthemepost" role="tabpanel" aria-labelledby="carousel-tab">
                                        <label for="themepost">Tên chủ đề</label>
                                        <input type="text" class="form-control" name="themepost" id="themepost">
                                        <p id="errorThemePostInput" class="text-danger ps-1 "><Small></Small></p>
                                        <div class="text-end p-3">
                                            <button type="submit" class="btn btn-primary" id="btnSaveKind">Lưu lại</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="editthemepost" role="tabpanel" aria-labelledby="carousel-tab">
                                        <table class="table w-100" id="kindtable">
                                            <thead>
                                                <th></th>
                                                <th class="text-center">Tên chủ đề</th>
                                                <th class="text-center">Khác</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger closeKindModal" data-bs-dismiss="modal" aria-label="Close">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal end thêm thể thoại bài viết  -->
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