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

//tự động điền vào bài viết
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
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane show active" id="carousel" role="tabpanel" aria-labelledby="carousel-tab">
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
            </div>
        </div>
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