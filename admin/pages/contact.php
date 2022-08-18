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
            <div class="container">
                <!-- table start  -->
                <table class="table table-success table-striped" id="contactstable">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">trạng thái</th>
                            <th scope="col">Khác</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php include"../api/contact/getcontact.php" ?>
                    </tbody>
                </table>
                <!-- table end  -->
                xin chào

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