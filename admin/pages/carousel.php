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
include "../../classes/adminhomepage.php";
$db_adminhomepage  = new db_adminhomepage();
if (isset($_POST["upload_button"]) && !empty($_FILES["file"]["name"]) && !empty($_POST["title"])) {
    $db_adminhomepage->UploadImage();
}else {
    $statusMsg = 'Please select a file to upload.';
    print_r($statusMsg);
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
                                <button class="nav-link active" id="carousel-tab" data-bs-toggle="tab" data-bs-target="#carousel" type="button" role="tab" aria-controls="carousel" aria-selected="true">Môn học</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="post-homepage-tab" data-bs-toggle="tab" data-bs-target="#post-homepage" type="button" role="tab" aria-controls="post-homepage" aria-selected="false">Chủ đề môn học</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="carousel" role="tabpanel" aria-labelledby="carousel-tab">
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
                                                    <input type="text" name="title" id="title" class="form-control rounded" aria-describedby="titleHelp" />
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="image-upload" class="form-label h-3">Tải hình ảnh lên</label>
                                                        </div>
                                                        <div class="col-6" id="file-area">
                                                            <div id="imgHelp" class="form-text text-end">Nên chọn tệp hình ảnh có kích thước 1400x600</div>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" type="file" id="image-upload" required="required" multiple="multiple" aria-describedby="imgHelp" />
                                                </div>
                                                <!-- <div class="col-12" id="file-dummy">
                                                    <div class="success">Tải thành công</div>
                                                    <div class="default">Vui lòng chọn lại tệp hình ảnh</div>
                                                </div> -->
                                                <div class="col-12 text-center">
                                                    <button id="button_uploadImg" name="upload_button" class="rounded border bg-success text-light" type="submit">Tải lên</button>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- test image have upload yet ! -->
                                        <div class="container mt-3">
                                            <div id="cards" class="card-group row text-center">
                                                <?php
                                                // Get images from the database
                                                $query = $db_adminhomepage->ListImgPost();
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
                                                                        <a href="admin-insert-img.php?imageid=<?php echo $id; ?>&status=<?php echo $changeStatus; ?>" class="btn btn-success"><?php echo $txt ?></a>
                                                                        <a href="admin-insert-img.php?idDelete=<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
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

                                        <link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="post-homepage" role="tabpanel" aria-labelledby="post-homepage-tab">
                                <!-- Đăng bài viết giới thiệu -->

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
        // data table
        jQuery(document).ready(function($) {
            var table = $('#table1').DataTable({
                stateSave: true,
                aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0]
                }],
                orderCellsTop: true,
                fixedHeader: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
                    paginate: {
                        next: '»',
                        previous: '«'
                    }
                }
            });

            $('#table1').on('page.dt', (e) => {
                console.log(table.page.info())
            })
            var allPages = table.rows().nodes();
            // select all 
            $('#selectAll').on('click', function() {
                console.log(allPages)
                if ($(this).hasClass('allChecked')) {
                    $('input[type="checkbox"]', allPages).prop('checked', false);
                } else {
                    $('input[type="checkbox"]', allPages).prop('checked', true);
                }
                $(this).toggleClass('allChecked');
            });

            // Edit subject
            // Toggle Class
            $(".edit-subject").on('click', (e) => {
                // get tr in table
                let row_subject = $(e.currentTarget).closest(".subject-row");
                let edit_form = row_subject.find("td > .edit-subject-form")
                let span_subject_name = row_subject.find("td > .subject-name")
                // show edit form
                edit_form.toggleClass("d-none");
                // hide span subject name
                span_subject_name.toggleClass("d-none");
                console.log(edit_form, span_subject_name)
            });
            // Edit

            $('.edit-subject-form').on("submit", (event) => {
                event.preventDefault();


                console.log($(event.target).serialize())
                $.ajax({
                    type: "post",
                    url: "../api/updatesubject.php",
                    data: $(event.target).serialize(),
                    cache: false,
                    success: function(data) {

                        if (data.update === "success") {
                            $(event.target).toggleClass("d-none")
                            $(event.target).prev().toggleClass("d-none").text(data.subject)
                        }

                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            });

            // Delete subject
            $(".delete-subject").on('click', (e) => {
                let id_subject = $(e.target).attr("data-value-id");
                console.log()

                $.ajax({
                    type: "post",
                    url: "../api/deletesubject.php",
                    data: {
                        id_subject
                    },
                    cache: false,
                    success: function(data) {

                        if (data.delete === "success") {
                            var removingRow = $(e.target).closest('tr');
                            table.row(removingRow).remove().draw();
                            $(event.target).toggleClass("d-none")

                        }

                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            });


        });
    })(jQuery)
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>
        
    </script>
</body> -->

<!-- </html> -->