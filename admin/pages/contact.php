<?php

namespace Admin;

// use Classes\Adminhomepage;
use Library\Session;
use Classes\Contact;


require_once(__DIR__ . "../../../vendor/autoload.php");

// require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ./errors/404");
}
//  Classes\Subject, Classes\SubjectTopic;

$title = "Danh sách tư vấn";

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
            <div class="container">
                <!-- table start  -->
                <table class="table table-success table-striped display" style="width:100%" id="contactstable">
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

                    </tbody>
                </table>
                <!-- table end  -->
                <!-- modal start  -->
                <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="contactModalLabel">Thông Tin Liên Hệ</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <p>Họ và tên: <b><span id="showfullname"></span></b></p>
                                    <p>Email: <b><span id="showemail"></span></b></p>
                                    <p>Số điện thoại: <b><span id="showphone"></span></b></p>
                                    <p><u>Nội dung</u></p>
                                    <p id="showcontent" class="justify-content-between"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="seencontact" >Đã xem</button>
                                <button type="button" class="btn btn-success" id="deliveredcontact" >Chưa xem</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal end  -->

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