<?php

namespace Admin;

use Classes\db_adminhomepage;
use Library\Session;

require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ./errors/404");
}
//  Classes\Subject, Classes\SubjectTopic;
?>

<?php
$title = "Viết bài viết";

include "../../classes/adminhomepage.php";
$db_adminhomepage  = new db_adminhomepage();
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

//tải bài viết lên trang chủ
if (
    isset($_POST['posts'])
    && isset($_POST["titlepost"]) && !empty($_POST["titlepost"])
    && isset($_POST["editor"]) && !empty($_POST["editor"])
) {
    $titlepost = $_POST["titlepost"];
    $editor = $_POST["editor"];
    $kind = $_POST["radioKind"];
    $statuspost = (isset($_POST['statuspost'])) ? 1 : 0;
    $Insert  = "INSERT INTO admin_post(id, title, content, status, time, kind) VALUES (NULL,'" . $titlepost . "','" . $editor . "'," . $statuspost . ",CURRENT_TIMESTAMP(),'" . $kind . "');";
    $db_adminhomepage->AddPost($Insert);
}

//lưu lại bài viết
if (
    isset($_POST['savepost'])
    && isset($_POST["titlepost"]) && !empty($_POST["titlepost"])
    && isset($_POST["editor"]) && !empty($_POST["editor"])
) {
    $title = $_POST["titlepost"];
    $editor = $_POST["editor"];
    $kind = $_POST["radioKind"];
    $statuspost = 0;
    $Insert  = "INSERT INTO admin_post(id, title, content, status, time, kind) VALUES (NULL,'" . $titlepost . "','" . $editor . "'," . $statuspost . ",CURRENT_TIMESTAMP(),'" . $kind . "');";
    $db_adminhomepage->AddPost($Insert);
}

//chức năng edit
$id = "";
$titlepost = "";
$editor = "";
$kind = "";
$statuspost = "";

//điền dữ liệu lên bài viết
if (isset($_GET['idEditPost'])) {
    $id = $_GET['idEditPost'];
    $query = "SELECT * FROM `admin_post` WHERE id = $id";
    $result = $db_adminhomepage->SearchPost($query);
    //gán giá trị cho từng biến để dễ truy vấn hơn
    $row = $result->fetch_assoc();
    $titlepost = $row['title'];
    $editor = $row['content'];
    $kind = $row['kind'];
    $statuspost = $row['status'];
}

//chức năng xóa bài viết
if (isset($_GET['idDeletePost'])) {
    $idDelete = $_GET['idDeletePost'];
    $db_adminhomepage->DeletePost($idDelete);
}
//lưu lại bài viết
if (
    isset($_POST['SavePostEdit'])
    && isset($_GET['idEditPost'])
) {
    $id = $_GET['idEditPost'];
    $titlepost = $_POST["titlepost"];
    $editor = $_POST["editor"];
    $kind = $_POST["radioKind"];
    $statuspost = (isset($_POST['statuspost'])) ? 1 : 0;
    $update = "UPDATE `admin_post` SET `title`='$titlepost',`content`='$editor',`status`='$statuspost',`time`= CURRENT_TIMESTAMP(),`kind`='$kind' WHERE id = $id;";
    $db_adminhomepage->SaveEditPost($update);
    header('location: ./carousel.php');
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
                                <button name="loadimg" class="nav-link active" id="carousel-tab" data-bs-toggle="tab" data-bs-target="#carousel" type="button" role="tab" aria-controls="carousel" aria-selected="false">Tải hình ảnh</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button name="change_post" class="nav-link" id="post-homepage-tab" data-bs-toggle="tab" data-bs-target="#post-homepage" type="button" role="tab" aria-controls="post-homepage" aria-selected="true">Viết bài viết</button>
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
                                                    $imageURL = '../assets/images/carousel/' . $row["file_name"];
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
                                                <p>No image(s) found...</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="post-homepage" role="tabpanel" aria-labelledby="post-homepage-tab">
                                <!-- Đăng bài viết giới thiệu -->
                                <div class="container-fluid d-flex justify-content-center text-center">
                                    <form action="" method="POST" id="post-form">
                                        <div class="row container">
                                            <div class="col-8  p-5 mb-4 shadow">
                                                <div class="row">
                                                    <input name="titlepost" class="col-12 rounded-3 form-control" type="text" placeholder="Thêm tiêu đề" required="required" value="<?php echo $titlepost ?>">
                                                </div>
                                                <div class="row mt-3">
                                                    <!-- <div id="editor" class="col-12" name="editor"></div> -->
                                                    <textarea name="editor" id="editor">
                                                        <?php echo $editor ?>
                                                    </textarea>
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
                                                            <div class="d-flex justify-content-end pb-2">
                                                                <input type="button" name="review" class="btn btn-primary " value="Xem trước">
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <p>
                                                                        Trạng thái:
                                                                        <b>
                                                                            <snap>
                                                                                <input type="checkbox" name="statuspost" id="status" value="1" <?php if ($statuspost == 1) echo 'checked="checked"' ?>>
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
                                                                <input type="submit" value="Lưu lại" name="SavePostEdit" class="btn btn-success">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 p-1 rounded-2 border shadow">
                                                        <h6 class="text-center"><b>Loại danh sách bài viết</b></h6>
                                                        <hr>
                                                        <ul class="list-unstyled p-3 pt-0">
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Trích dẫn" id="radioKind1" <?php if(($kind != "")){ if ($kind == 'Trích dẫn') {echo 'checked';}} else echo "checked"; ?>>
                                                                <label class="form-check-label" for="radioKind1">Trích dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Bài viết" id="radioKind2" <?php if ($kind == 'Bài viết') echo 'checked' ?>>
                                                                <label class="form-check-label" for="radioKind2">Bài viết</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Hướng dẫn" id="radioKind3" <?php if ($kind == 'Hướng dẫn') echo 'checked' ?>>
                                                                <label class="form-check-label" for="radioKind3">Hướng dẫn</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Thông tin chung" id="radioKind4" <?php if ($kind == 'Thông tin chung') echo 'checked' ?>>
                                                                <label class="form-check-label" for="radioKind4">Thông tin chung</label>
                                                            </li>
                                                            <li class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioKind" value="Giới thiệu" id="radioKind5" <?php if ($kind == 'Giới thiệu') echo 'checked' ?>>
                                                                <label class="form-check-label" for="radioKind5">Giới thiệu</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border shadow p-1 rounded-2">
                                                <!-- DOM cái này bằng PHP -->
                                                <div class="container w-70">
                                                    <h3 class="text-center"><b>Danh sách bài đăng</b></h3>
                                                    <table class="table mt-4">
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
                                                            $linkPostpageEdit = '?idEditPost=';
                                                            // đường dẫn chuyển qua trang xóa
                                                            $linkPostpageDelete = '?idDeletePost=';
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
    (function() {
        let MyEditor;
        // data table
        jQuery(document).ready(function($) {

            ClassicEditor
                .create(document.querySelector('#editor'), {
                    placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết!',

                })
                .then(editor => {
                    const toolbarContainer = document.querySelector('#toolbar-container');

                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    MyEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        });
        $.validator.addMethod("ck_editor", function() {
            var content_length = MyEditor.getData().trim().length;
            return content_length > 0;
        }, "Please insert content for the page.");


    })(jQuery)
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>
        
    </script>
</body> -->

<!-- </html> -->