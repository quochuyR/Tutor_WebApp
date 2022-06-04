<?php

namespace Admin;

use Classes\Subject;
use Library\Session;

require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ./errors/404");
}
//  Classes\Subject, Classes\SubjectTopic;
?>

<?php
include_once "../../classes/subjects.php";
?>

<?php
$_subject = new Subject();
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
                                <button class="nav-link active" id="subject-tab" data-bs-toggle="tab" data-bs-target="#subject" type="button" role="tab" aria-controls="subject" aria-selected="true">Môn học</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="subject-topic-tab" data-bs-toggle="tab" data-bs-target="#subject-topic" type="button" role="tab" aria-controls="subject-topic" aria-selected="false">Chủ đề môn học</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="subject" role="tabpanel" aria-labelledby="subject-tab">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <table id="table1" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><input class="form-check-input " id="selectAll" type="checkbox"></th>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Tên môn học</th>
                                                    <th scope="col">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $get_subject = $_subject->getAll();
                                                if ($get_subject) :
                                                    while ($subject = $get_subject->fetch_assoc()) :

                                                ?>
                                                        <tr class="subject-row">
                                                            <th scope="row"><input class="form-check-input check-one" type="checkbox"></th>
                                                            <td scope="row" class="text-start"><?= $subject["id"] ?></td>
                                                            <td scope="row" class="text-start">
                                                                <span class="subject-name"><?= $subject["subject"] ?></span>
                                                                <form class="edit-subject-form d-none">
                                                                    <input type="hidden" class="form-control id-subject-input" name="id-subject" value="<?= $subject["id"] ?>">

                                                                    <input type="text" class="form-control edit-input" name="subject" value="<?= $subject["subject"] ?>">

                                                                </form>
                                                            </td>
                                                            <td scope="row" class="text-start">
                                                                <div class="d-inline-flex cursor-pointer ">
                                                                    <span class="badge badge-light-success m-l-10 edit-subject">
                                                                        <span class="material-symbols-rounded  m-auto" style="color: #3F99EF;font-size: 20px !important;">
                                                                            edit_note
                                                                        </span>
                                                                    </span>
                                                                    <span class="badge badge-light-danger m-l-10 delete-subject">
                                                                        <span class="material-symbols-rounded  m-auto" data-value-id="<?= $subject["id"] ?>" style="color: #E73774;font-size: 20px !important; ">
                                                                            delete
                                                                        </span>
                                                                    </span>

                                                                </div>

                                                            </td>
                                                        </tr>
                                                <?php
                                                    endwhile;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="subject-topic" role="tabpanel" aria-labelledby="subject-topic-tab">...</div>
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
                            table.row(removingRow).remove().draw();$(event.target).toggleClass("d-none")
               
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