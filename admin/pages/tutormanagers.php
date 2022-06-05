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
                    <div class="card-body row px-md-3 px-1">
                        <!-- <div class="d-flex mb-4 col-12">
                            <button type="button" class="btn btn-outline-primary d-inline-flex " data-bs-toggle="modal" data-bs-target="#modalAddSubject">
                                <span class="material-symbols-rounded">
                                    add
                                </span>
                                <span class="d-block">Thêm mới</span>
                            </button>
                            <button type="button" class="btn btn-outline-danger d-inline-flex mx-1" id="multiple-delete-subject">
                                <span class="material-symbols-rounded">
                                    delete
                                </span>
                                <span class="d-block px-1">Xoá nhiều</span>
                            </button>

                        </div> -->


                        <div class="col-12">
                            <div class="table-stats order-table ov-h">
                                <table id="tutor-table" class="table table-striped table-type-1" style="width: 100% !important">
                                    <thead>
                                        <tr>
                                            <th scope="col"><input class="form-check-input " id="select-all-subject" type="checkbox"></th>
                                            <th scope="col">Hình</th>
                                            <th scope="col">Họ</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Nghề nghiệp</th>
                                            <th scope="col">Nơi ở hiện tại</th>
                                            <th scope="col">Nơi dạy</th>
                                            <th scope="col">Hình thức</th>
                                            <th scope="col">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal Add subject -->
        <div class="modal fade" id="modal-tutor-detail" tabindex="-1" aria-labelledby="modal-tutor-detailLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modal-tutor-detailLabel">Thêm môn học</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                        <button type="button" class="btn btn-primary" id="update-approval-tutor">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->


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
        "use-strict"
        jQuery(document).ready(function($) {

            (function() {
                var tutor_table = $('#tutor-table').DataTable({
                    // data: data,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../api/tutors/getdatasubjecttopics.php',
                        dataType: 'json',
                        type: 'get',
                        complete: function(data) {

                            // if (data.add === "success") {
                            //     table.ajax.reload(null, false);

                            // }
                            InitLoadSuccess();
                            console.log(data)
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                        }
                    },
                    drawCallBack: function(settings) {
                        console.log(settings)
                    },
                    createdRow: function(row, data, dataIndex) {
                        $(row).addClass('subject-row');
                    },
                    columns: [{
                            data: "id",
                            className: "",
                            render: function(data, type, row) {
                                return `<input class="form-check-input check-one" type="checkbox" value="${data}">`
                            },
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                if (type === "display") {
                                    return `<div class="round-img">
                                                <a href="#"><img class="rounded" src="../../public/${row.image}" alt=""></a>
                                            </div>`
                                }
                                return data

                            },
                        },
                        {
                            data: "last_name",
                            render: function(data, type, row) {
                                if (type === "display") {
                                    return `<span class="text-dark d-block">${data}</span>`
                                }
                                return data

                            },
                        },
                        {
                            data: "first_name",
                            render: function(data, type, row) {
                                if (type === "display") {
                                    return `<span class="text-dark d-block">${data}</span>`
                                }
                                return data

                            },
                        },
                        {
                            data: "current_job",
                            render: function(data, type, row) {
                                console.log(row, "row")

                                if (type === "display") {
                                    return `<span class="text-dark d-block">${data}</span>`;
                                }
                                return data
                            }
                        },
                        {
                            data: "current_place",
                            render: function(data, type, row) {
                                console.log(row, "row")

                                if (type === "display") {
                                    return `<span class="text-dark d-block">${data}</span>`;
                                }
                                return data
                            }
                        },
                        {
                            data: "teaching_area",
                            render: function(data, type, row) {
                                console.log(row, "row")

                                if (type === "display") {
                                    return `<span class="text-dark d-block">${data}</span>`;
                                }
                                return data
                            }
                        }, {
                            data: "teaching_form",
                            render: function(data, type, row) {
                                // Combine the first and last names into a single table field
                                if (type === "display") {
                                    let teaching_form = "";
                                    let array_teaching_form = data.replace(/\s/g, '').split(",")
                                    array_teaching_form.map(val => {
                                        if (val === '0')
                                            teaching_form += "Trực tiếp" + ', '
                                        if (val === '1')
                                            teaching_form += "Trực tuyến" + ', '
                                    })
                                    // console.log(array_teaching_form)
                                    return `<span class="text-muted fs-6 limit-text p-t-012">
                                                ${teaching_form}                        
                                            </span>`;
                                }
                                return data
                            },
                        }, {
                            data: null,
                            render: function(data, type, row) {
                                // Combine the first and last names into a single table field
                                return `<span class="badge ${ data.tutor_status === 1 ? "badge-light-success" : "badge-light-danger"} approval d-block mx-2" data-value-id=${row.id} data-bs-toggle="modal" data-bs-target="#modal-tutor-detail">${ data.tutor_status === 1 ? "Đã duyệt" : "Chưa duyệt"}</span>`;
                            },
                            // defaultContent:,
                        },
                    ],

                    // initComplete: function(settings, json) {
                    //     InitLoadSuccess(settings, json);
                    // },
                    stateSave: true,
                    responsive: true,
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

                // $('#subject-table').on('page.dt', (e) => {
                //     $("#select-all-subject").prop("checked", false);
                //     $("#select-all-subject").removeClass('allChecked');

                // })

                /*
                                // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
                                // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
                                // nếu không load lại nó sẽ vô hiệu
                                var idx = 0;

                                // console.log(settings)

                                // select all
                                $('#select-all-subject').on('click', function(e) {
                                    // idx++
                                    // console.log("-------------------", idx, "allPage")

                                    let allPages = subject_table.rows().nodes();
                                    console.log(allPages)
                                    if ($(this).hasClass('allChecked')) {
                                        $('input[type="checkbox"]', allPages).prop('checked', false);
                                    } else {
                                        $('input[type="checkbox"]', allPages).prop('checked', true);

                                    }
                                    $(this).toggleClass('allChecked');

                                    return true;
                                });
*/
                function InitLoadSuccess(settings = null, json = null) {

                    $("#update-approval-tutor").off();
                    $(".approval").on('click', (e) => {
                        let id = $(e.target).attr("data-value-id");


                        $.ajax({
                            type: "post",
                            url: "../api/tutors/gettutordetailsforadmin.php",
                            data: {
                                id
                            },
                            cache: false,
                            success: function(data) {

                                // if (data.delete === "success") {
                                //     subject_topic_table.ajax.reload(null, false);


                                // }
                                $("#modal-tutor-detail .modal-body").html(data)
                                $("#update-approval-tutor").attr("data-id", id)
                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    });

                    // update approval tutor
                    $("#update-approval-tutor").on('click', (e) => {
                        let id = $(e.target).attr("data-id");


                        $.ajax({
                            type: "post",
                            url: "../api/tutors/updateapprovaltutor.php",
                            data: {
                                id
                            },
                            cache: false,
                            success: function(data) {

                                if (data.update === "success") {
                                    tutor_table.ajax.reload(null, false);

                                    // 
                                    Toastify({
                                        text: data.message,
                                        duration: 3000,
                                        close: true,
                                        gravity: "top", // `top` or `bottom`
                                        position: "right", // `left`, `center` or `right`
                                        stopOnFocus: true, // Prevents dismissing of toast on hover
                                        style: {
                                            background: "linear-gradient(to right, #56C596, #7BE495)",
                                        },
                                        onClick: function() {} // Callback after click
                                    }).showToast();
                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    })




                }


                /*

                                                // validation form
                                                var forms = document.querySelectorAll('.needs-validation')
                                                console.log(forms, "forms");
                                                // Loop over them and prevent submission
                                                Array.prototype.slice.call(forms)
                                                    .forEach(function(form) {
                                                        form.addEventListener('submit', function(event) {
                                                            if (!form.checkValidity()) {
                                                                event.preventDefault()
                                                                event.stopPropagation()
                                                            }

                                                            form.classList.add('was-validated')
                                                        }, false)
                                                    });

                                                // Add

                                                $('#add-subject-form').on("submit", (event) => {
                                                    event.preventDefault();


                                                    console.log($(event.target).serialize())
                                                    if (confirm("Bạn chắc chắn muốn thêm những môn học này?") === true) {
                                                        $.ajax({
                                                            type: "post",
                                                            url: "../api/subjects/addsubject.php",
                                                            data: $(event.target).serialize(),
                                                            cache: false,
                                                            success: function(data) {

                                                                if (data.add === "success") {
                                                                    subject_table.ajax.reload(null, false);

                                                                }

                                                                console.log(data)
                                                            },
                                                            error: function(xhr, status, error) {
                                                                console.error(xhr);
                                                            }
                                                        });
                                                    }

                                                });

                                                // submit textarea (in modal add new)
                                                $("#control-input-subject").on('keydown', (e) => {
                                                    if (e.which === 13 && !e.shiftKey) {
                                                        e.preventDefault();
                                                        $(e.target).closest("#add-subject-form").submit();
                                                    }
                                                });
                                                // submit button save-change-subject

                                                $("#save-change-subject").on('click', (e) => {
                                                    console.log($(e.target).closest(".modal-content").find("#add-subject-form").submit());
                                                });*/

                // The ctrl+shift N event keyboard was used to display the modal.
                /* var isPress = false;
                 var myModal = new bootstrap.Modal(document.getElementById('modalAddSubject'), {
                     keyboard: true
                 });
                 $(document).on("keydown", (event) => {
                     // console.log(event)

                     if (!isPress && event.ctrlKey && event.shiftKey) {
                         isPress = true;
                         console.log("ctrl+shift")
                         isPress && $(this).on('keydown', (e) => {
                             if (isPress && e.keyCode === 78 || e.keyCode === 110) { // 'A' or 'a'
                                 console.log("ctrl+shift N")

                                 e.preventDefault() ? e.preventDefault : e.returnValue = false;
                                 e.stopPropagation();

                                 myModal.show();
                                 isPress = false;
                                 return false;
                             }
                         })
                     }

                 });*/
            })();


        });

    })(jQuery)
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>

    </script>
</body> -->

<!-- </html> -->