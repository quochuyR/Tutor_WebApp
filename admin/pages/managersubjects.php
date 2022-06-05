<?php

namespace Admin;

use Classes\Subject;
use Library\Session;

require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ../../pages/login");
}
//  Classes\Subject, Classes\SubjectTopic;
?>

<?php
include_once "../../classes/subjects.php";
?>

<?php
$_subject = new Subject();

?>
<?php $title = "Quản lý môn học";
include_once "../inc/header.php" ?>
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
                                <button class="nav-link " id="subject-tab" data-bs-toggle="tab" data-bs-target="#subject" type="button" role="tab" aria-controls="subject" aria-selected="true">Môn học</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="subject-topic-tab" data-bs-toggle="tab" data-bs-target="#subject-topic" type="button" role="tab" aria-controls="subject-topic" aria-selected="false">Chủ đề môn học</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="subject" role="tabpanel" aria-labelledby="subject-tab">
                                <div class="card mt-4">
                                    <div class="card-body row px-md-3 px-1">
                                        <div class="d-flex mb-4 col-12">
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

                                        </div>


                                        <div class="col-md-7">
                                            <table id="subject-table" class="table table-striped table-type-1" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><input class="form-check-input " id="select-all-subject" type="checkbox"></th>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Tên môn học</th>
                                                        <th scope="col">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="subject-topic" role="tabpanel" aria-labelledby="subject-topic-tab">
                                <div class="card mt-4">
                                    <div class="card-body row px-md-3 px-1">
                                        <div class="d-flex mb-4 col-12">
                                            <button type="button" class="btn btn-outline-primary d-inline-flex " data-bs-toggle="modal" data-bs-target="#modalAddSubjectTopic">
                                                <span class="material-symbols-rounded">
                                                    add
                                                </span>
                                                <span class="d-block">Thêm mới</span>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger d-inline-flex mx-1" id="multiple-delete">
                                                <span class="material-symbols-rounded">
                                                    delete
                                                </span>
                                                <span class="d-block px-1">Xoá nhiều</span>
                                            </button>

                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group col-sm-8 flex-column d-flex mb-3">
                                                <label class="form-control-label">Lọc theo</label>
                                                <select class="js-data-subjects-ajax select2bs5" name="subject">


                                                </select>

                                            </div>

                                            <table id="subject-topic-table" class="table table-striped table-type-1" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><input class="form-check-input " id="select-all" type="checkbox"></th>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Tên môn học</th>
                                                        <th scope="col">Chủ đề môn học</th>
                                                        <th scope="col">Hành động</th>
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
                </div>

            </div>
        </div>
        <!-- Modal Add subject -->
        <div class="modal fade" id="modalAddSubject" tabindex="-1" aria-labelledby="modalAddSubjectLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalAddSubjectLabel">Thêm môn học</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="add-subject-form" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="control-input-subject" class="form-label">Tên môn học</label>
                                        <!-- <input type="text" class="form-control" id="control-input-subject" placeholder="Ví dụ: Công nghệ thông tin" minlength="3" required> -->
                                        <textarea class="form-control" id="control-input-subject" name="subject-name" placeholder="Ví dụ: Công nghệ thông tin" minlength="3" rows="3" required></textarea>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập môn học nhiều hơn 2 kí tự
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer">
                                <h4 class="fw-bold py-2">Lưu ý:</h4>
                                <ul>
                                    <li>shift + enter: Xuống hàng (nếu muốn thêm nhiều môn học)</li>
                                    <li>enter: Lưu dữ liệu (thêm môn học)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                        <button type="button" class="btn btn-primary" id="save-change-subject">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- Modal Add subject topic -->
        <div class="modal fade" id="modalAddSubjectTopic" tabindex="-1" aria-labelledby="modalAddSubjectTopicLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalAddSubjectTopicLabel">Thêm môn học</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">
                                <form id="add-subject-topic-form" class="needs-validation row" novalidate>
                                    <div class="form-group col-sm-12 flex-column d-flex mb-3">
                                        <label class="form-control-label">Chọn môn học</label>
                                        <select class="js-data-subject-topic-ajax select2bs5" id="subject-topic-ajax-select2" name="subject-topic">


                                        </select>

                                    </div>
                                    <div class="form-group col-sm-12 flex-column d-flex mb-3">
                                        <label for="control-input-subject-topic" class="form-label">Tên môn học</label>
                                        <!-- <input type="text" class="form-control" id="control-input-subject-topic" placeholder="Ví dụ: Công nghệ thông tin" minlength="3" required> -->
                                        <textarea class="form-control" id="control-input-subject-topic" name="subject-topic-name" placeholder="Ví dụ: Toán cấp 1" minlength="3" rows="3" required></textarea>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập môn học nhiều hơn 2 kí tự
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer">
                                <h4 class="fw-bold py-2">Lưu ý:</h4>
                                <ul>
                                    <li>shift + enter: Xuống hàng (nếu muốn thêm nhiều chủ đề môn học)</li>
                                    <li>enter: Lưu dữ liệu (thêm môn học)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                        <button type="button" class="btn btn-primary" id="save-change-subject-topic">Lưu lại</button>
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
                var subject_table = $('#subject-table').DataTable({
                    // data: data,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../api/subjects/getdatasubjects.php',
                        dataType: 'json',
                        type: 'get',
                        complete: function(data) {

                            // if (data.add === "success") {
                            //     table.ajax.reload(null, false);

                            // }
                            InitLoadSuccess();
                            // console.log(data)
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
                            data: null,
                            className: "",
                            render: function(data, type, row) {
                                return `<input class="form-check-input check-one" type="checkbox" value="${data.Id}">`
                            },
                        },
                        {
                            data: "Id"
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return `<span class="subject-name">${data["Tên môn học"]}</span>
                                                                    <form class="edit-subject-form d-none">
                                                                        <input type="hidden" class="form-control id-subject-input" name="id-subject" value="${data['Id']}">

                                                                        <input type="text" class="form-control edit-input" name="subject" value="${data['Tên môn học']} " required>

                                                                    </form>`
                            }
                        }, {
                            data: null,
                            render: function(data, type, row) {
                                // Combine the first and last names into a single table field
                                return `<div class="d-inline-flex cursor-pointer ">
                                                                        <span class="badge badge-light-success m-l-10 edit-subject">
                                                                            <span class="material-symbols-rounded  m-auto" style="color: #3F99EF;font-size: 20px !important;">
                                                                                edit_note
                                                                            </span>
                                                                        </span>
                                                                        <span class="badge badge-light-danger m-l-10 delete-subject">
                                                                            <span class="material-symbols-rounded  m-auto" data-value-id="${data.Id}" style="color: #E73774;font-size: 20px !important; ">
                                                                                delete
                                                                            </span>
                                                                        </span>

                                                                    </div>`;
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

                $('#subject-table').on('page.dt', (e) => {
                    $("#select-all-subject").prop("checked", false);
                    $("#select-all-subject").removeClass('allChecked');

                })


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

                function InitLoadSuccess(settings = null, json = null) {

                    // xoá sự kiện của từng selector
                    // vì bên trong hàm InitLoadSuccess sẽ lặp lại nhiều lần
                    // và tạo ra nhiều sự kiện trùng nhau
                    $(".edit-subject").off();
                    $('.edit-subject-form').off();
                    $(".delete-subject").off();
                    $("#multiple-delete-subject").off();

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
                        idx++;
                        console.log(idx)
                    });

                    // Edit

                    $('.edit-subject-form').on("submit", (event) => {
                        event.preventDefault();


                        console.log($(event.target).serialize())
                        $.ajax({
                            type: "post",
                            url: "../api/subjects/updatesubject.php",
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
                            url: "../api/subjects/deletesubject.php",
                            data: {
                                id_subject
                            },
                            cache: false,
                            success: function(data) {

                                if (data.delete === "success") {
                                    subject_table.ajax.reload(null, false);


                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    });

                    // Delete multiple

                    $("#multiple-delete-subject").on('click', (e) => {
                        let subject_id_list = [];
                        $('input[type="checkbox"]:not(#select-all-subject):checked').each((i, elm) => {
                            subject_id_list.push($(elm).val())
                        });
                        console.log(subject_id_list);
                        $.ajax({
                            type: "post",
                            url: "../api/subjects/deletesubject.php",
                            data: {
                                id_subject: subject_id_list
                            },
                            cache: false,
                            success: function(data) {

                                if (data.delete === "success") {
                                    subject_table.ajax.reload(null, false);


                                } else if (data.delete === "fail") {

                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    });


                }




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
                });

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

            // subject topics

            (function() {

                var subject_topic_table = $('#subject-topic-table').DataTable({
                    // data: data,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../api/subjecttopics/getdatasubjecttopics.php',
                        dataType: 'json',
                        type: 'get',
                        complete: function(data) {

                            // if (data.add === "success") {
                            //     table.ajax.reload(null, false);

                            // }
                            InitLoadSuccess();
                            console.log(data)
                        },
                        cache: false,
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
                                if (type === "display") {
                                    return `<input class="form-check-input check-one" type="checkbox" value="${data}">`;
                                }
                                return data;
                            }
                        },
                        {
                            data: "id",
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return `<span class="topic-id"> ${data}</span>`
                                }
                                return data
                            }
                        },
                        {
                            data: "subject",
                            render: function(data, type, row) {
                                if (type === "display") {
                                    return `<span class="subject-name">${data}</span>
                                                                    <form class="edit-subject-topic-form d-none">


                                                                        <div class="form-group col-sm-8 flex-column d-flex mb-3">

                                                                            <select class="js-data-subjects-ajax-edit select2bs5" name="subject_id">


                                                                            </select>

                                                                        </div>

                                                                    </form>`;
                                }
                                return data
                            }
                        },
                        {
                            data: "topicName",
                            render: function(data, type, row, meta) {
                                // console.log(meta)
                                if (type === "display") {
                                    return `<span class="subject-name">${data}</span>
                                                                    <form class="edit-subject-topic-form d-none">

                                                                        <input type="text" class="form-control edit-input" name="subject-topic" value="${data} " required>

                                                                    </form>`;
                                }

                                return data
                            }
                        }, {
                            data: "id",
                            render: function(data, type, row) {
                                // Combine the first and last names into a single table field
                                if (type === "display") {
                                    return `<div class="d-inline-flex cursor-pointer ">
                                                                        <span class="badge badge-light-success m-l-10 edit-subject-topic">
                                                                            <span class="material-symbols-rounded  m-auto" style="color: #3F99EF;font-size: 20px !important;">
                                                                                edit_note
                                                                            </span>
                                                                        </span>
                                                                        <span class="badge badge-light-danger m-l-10 delete-subject-topic">
                                                                            <span class="material-symbols-rounded  m-auto" data-value-id="${data}" style="color: #E73774;font-size: 20px !important; ">
                                                                                delete
                                                                            </span>
                                                                        </span>

                                                                    </div>`;
                                }
                                return null
                            },
                            // defaultContent:,
                        },
                    ],

                    initComplete: function(settings, json) {
                        // InitLoadSuccess(settings, json);
                        console.log(settings)

                    },
                    dom: 'Bfrtip',
                    buttons: ['pageLength', {
                            extend: 'print',
                            download: 'open',
                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function(win) {
                                console.log($(win.document.body).find('table').eq(1))
                                // $(win.document.body)
                                //     .css('font-size', '10pt')
                                //     .prepend(
                                //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                                //     );

                                $(win.document.body).find('table')
                                    .addClass('table-bordered').removeClass("table-type-1")
                            },
                            messageTop: `<span class="h5 pt-3 d-block">THÔNG TIN CHỦ ĐỀ MÔN HỌC</span>`
                        },
                        'colvis'
                    ],
                    // stateSave: true,
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


                select2_ajax('.js-data-subjects-ajax', null, '../api/subjects/getsubjectjointopicbyquery.php', function(params) {
                    var query = {
                        q: params.term,
                        num: !params.term && 'all'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }, function(data, params) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    }
                })



                $('.js-data-subjects-ajax').on('change', function(e) {
                    subject_topic_table
                        .columns(2)
                        .search($(this).select2('data')[0].text)
                        .draw()
                    console.log($(this).select2('data')[0].text)

                });
                // $('#subject-table').on('page.dt', (e) => {
                //     $("#select-all-subject").prop("checked", false);
                //     $("#select-all-subject").removeClass('allChecked');

                // })



                // var idx = 0;

                // // console.log(settings)

                // select all
                $('#subject-topic-table #select-all').on('click', function(e) {
                    // idx++
                    // console.log("-------------------", idx, "allPage")

                    let allPages = subject_topic_table.rows().nodes();
                    console.log(allPages)
                    if ($(this).hasClass('allChecked')) {
                        $('input[type="checkbox"]', allPages).prop('checked', false);
                    } else {
                        $('input[type="checkbox"]', allPages).prop('checked', true);

                    }
                    $(this).toggleClass('allChecked');

                    return true;
                });

                function select2_ajax(selector, dropdownParent, urlAjax, dataAjax, processResultsAjax) {

                    $(selector).select2({
                        theme: 'bootstrap-5',
                        language: "vi",
                        dropdownParent: dropdownParent,
                        ajax: {
                            url: urlAjax,
                            type: "post",
                            dataType: 'json',
                            delay: 250,
                            data: dataAjax,
                            processResults: processResultsAjax,
                            cache: true
                        },
                        placeholder: 'Gõ chữ bất kì để tìm chủ đề',
                        minimumInputLength: 0,
                        // templateResult: formatRepo,
                        // templateSelection: formatRepoSelection
                    }).on("select2:close", function(e) { // validation select2
                        // $(this).valid();
                    });
                }


                select2_ajax('.js-data-subject-topic-ajax', $("#modalAddSubjectTopic"), '../api/subjects/getsubjectbyquery.php', function(params) {
                    var query = {
                        q: params.term,
                        num: !params.term && 'all'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }, function(data, params) {
                    console.log(data);
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    }
                })
                // call select2 (subject in modal)

                // // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
                // // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
                // // nếu không load lại nó sẽ vô hiệu
                function InitLoadSuccess(settings = null, json = null) {

                    //     // xoá sự kiện của từng selector
                    //     // vì bên trong hàm InitLoadSuccess sẽ lặp lại nhiều lần
                    //     // và tạo ra nhiều sự kiện trùng nhau
                    $(".edit-subject-topic").off();
                    $('.edit-subject-topic-form').off();
                    $(".delete-subject-topic").off();
                    $("#subject-topic #multiple-delete").off();
                    // $('.js-data-subject-topic-ajax').select2('destroy');


                    // Edit subject topic
                    // gọi hàm này khi bấm vào nút edit



                    // Toggle Class
                    $(".edit-subject-topic").on('click', (e) => {
                        // get tr in table
                        let row_subject = $(e.currentTarget).closest(".subject-row");
                        let edit_form = row_subject.find("td > .edit-subject-topic-form")
                        let span_subject_name = row_subject.find("td > .subject-name")
                        // show edit form
                        let select_subject_edit = $(e.target).closest("tr").find(".js-data-subjects-ajax-edit");
                        console.log(select_subject_edit);
                        select2_ajax(select_subject_edit, null, '../api/subjects/getsubjectbyquery.php', function(params) {
                            var query = {
                                q: params.term,
                                num: !params.term && 'all'
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        }, function(data, params) {
                            console.log(data);
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            }
                        })
                        edit_form.toggleClass("d-none");
                        if ($(edit_form).hasClass("d-none")) {
                            $(select_subject_edit).select2('destroy');
                            console.log("sos")

                            let topic_id = $(row_subject).find(".topic-id").text();
                            let subject_id = $(edit_form).find("select").val()
                            let topic_name = $(edit_form).find("input").val()
                            console.log(subject_id, topic_name, topic_id, "di")


                            // $(form).on("submit", (event) => {
                            //     event.preventDefault();


                            //     console.log($(event.target).serialize())
                            $.ajax({
                                type: "post",
                                url: "../api/subjecttopics/updatesubjecttopic.php",
                                data: {
                                    topic_id,
                                    subject_id,
                                    topic_name
                                },
                                cache: false,
                                success: function(data) {

                                    if (data.update === "success") {
                                        subject_topic_table.ajax.reload(null, false);
                                    }

                                    console.log(data)
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr);
                                }
                            });
                            // });
                            // console.log(form)

                        }
                        // hide span subject name
                        span_subject_name.toggleClass("d-none");
                        console.log(edit_form, span_subject_name)
                        // idx++;
                        // console.log(idx)


                    });

                    // Edit


                    //     // Delete subject
                    $(".delete-subject-topic").on('click', (e) => {
                        let id_subject_topic = $(e.target).attr("data-value-id");
                        console.log()

                        $.ajax({
                            type: "post",
                            url: "../api/subjecttopics/deletesubjecttopics.php",
                            data: {
                                id_subject_topic
                            },
                            cache: false,
                            success: function(data) {

                                if (data.delete === "success") {
                                    subject_topic_table.ajax.reload(null, false);


                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    });

                    // Delete multiple

                    $("#subject-topic #multiple-delete").on('click', (e) => {
                        let subject_topic_id_list = [];
                        $('input[type="checkbox"]:not(#subject-topic-table #select-all):checked').each((i, elm) => {
                            subject_topic_id_list.push($(elm).val())
                        });
                        console.log(subject_topic_id_list);
                        $.ajax({
                            type: "post",
                            url: "../api/subjecttopics/deletesubjecttopics.php",
                            data: {
                                id_subject_topic: subject_topic_id_list
                            },
                            cache: false,
                            success: function(data) {

                                if (data.delete === "success") {
                                    subject_topic_table.ajax.reload(null, false);


                                } else if (data.delete === "fail") {

                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    });


                    // }




                    // // validation form
                    // var forms = document.querySelectorAll('.needs-validation')
                    // console.log(forms, "forms");
                    // // Loop over them and prevent submission
                    // Array.prototype.slice.call(forms)
                    //     .forEach(function(form) {
                    //         form.addEventListener('submit', function(event) {
                    //             if (!form.checkValidity()) {
                    //                 event.preventDefault()
                    //                 event.stopPropagation()
                    //             }

                    //             form.classList.add('was-validated')
                    //         }, false)
                    //     });

                    // // Add



                } // end init


                $('#add-subject-topic-form').on("submit", (event) => {
                    event.preventDefault();


                    console.log($(event.target).serialize())
                    if (confirm("Bạn chắc chắn muốn thêm những chủ đề môn học này?") === true) {
                        $.ajax({
                            type: "post",
                            url: "../api/subjecttopics/addsubjecttopics.php",
                            data: $(event.target).serialize(),
                            cache: false,
                            success: function(data) {

                                if (data.add === "success") {
                                    subject_topic_table.ajax.reload(null, false);

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
                $("#control-input-subject-topic").on('keydown', (e) => {
                    if (e.which === 13 && !e.shiftKey) {
                        e.preventDefault();
                        $(e.target).closest("#add-subject-topic-form").submit();
                    }
                });
                // submit button save-change-subject

                $("#save-change-subject-topic").on('click', (e) => {
                    console.log($(e.target).closest(".modal-content").find("#add-subject-topic-form").submit());
                });

                // The ctrl+shift N event keyboard was used to display the modal.

            })();
        });

    })(jQuery)
</script>
<?php include_once "../inc/footer.php" ?>


<!-- <script>

    </script>
</body> -->

<!-- </html> -->