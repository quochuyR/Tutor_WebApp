import {
    image_viewer,
    remove_eventListener
} from './modules/image_viewer.js'
(function () {
    // data table
    "use-strict"
    jQuery(document).ready(function ($) {




        (function () {
            var tutor_table = $('#user-table').DataTable({
                // data: data,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '../api/users/getdatausers',
                    dataType: 'json',
                    type: 'get',
                    complete: function (data) {

                        // if (data.add === "success") {
                        //     table.ajax.reload(null, false);

                        // }
                        InitLoadSuccess();
                        console.log(data)
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr);
                    }
                },
                drawCallBack: function (settings) {
                    console.log(settings)
                },
                createdRow: function (row, data, dataIndex) {
                    if(data.status === 0){
                        $(row).addClass('badge-light-danger');
                    }
                    $(row).addClass('subject-row');
                },
                columns: [{
                    data: "Id",
                    className: "",
                    render: function (data, type, row) {
                        return `<input class="form-check-input check-one" type="checkbox" value="${data}">`
                    },
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        if (type === "display") {
                            return `<div class="round-img">
                                            <a href="#"><img class="rounded" src="${row.image ? "../../public/" + row.image : "https://www.bootdey.com/img/Content/avatar/avatar5.png"}" alt=""></a>
                                        </div>`
                        }
                        return data

                    },
                },
                {
                    data: "last_name",
                    render: function (data, type, row) {
                        if (type === "display") {
                            return `<span class="text-dark d-block">${data}</span>`
                        }
                        return data

                    },
                },
                {
                    data: "first_name",
                    render: function (data, type, row) {
                        if (type === "display") {
                            return `<span class="text-dark d-block">${data}</span>`
                        }
                        return data

                    },
                },
                {
                    data: "username",
                    render: function (data, type, row) {
                        console.log(row, "row")

                        if (type === "display") {
                            return `<span class="text-dark d-block">${data}</span>`;
                        }
                        return data
                    }
                },
                {
                    data: "sex",
                    render: function (data, type, row) {
                        console.log(row, "row")

                        if (type === "display") {
                            return `<span class="text-dark d-block">${data === 1 ? "Nam" : "Nữ"}</span>`;
                        }
                        return data
                    }
                },
                {
                    data: "account_roles",
                    render: function (data, type, row) {
                        console.log(row, "row")

                        if (type === "display") {
                            return `<span class="text-dark d-block">${data}</span>`;
                        }
                        return data
                    }
                }, {
                    data: null,
                    className: "",
                    render: function (data, type, row) {
                        // Combine the first and last names into a single table field
                        return `<div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input users-active" type="checkbox" role="switch" id="flexSwitchCheckActiveUser${data.Id.substring(9, 13)}" ${data.status === 1 ? "checked" : ""} data-id="${data.Id}">
                                        <label class="form-check-label" for="flexSwitchCheckActiveUser${data.Id.substring(9, 13)}"></label>
                                    </div>`;
                    },
                    // defaultContent:,
                },
                ],

                // initComplete: function(settings, json) {
                //     InitLoadSuccess(settings, json);
                // },,
                dom: 'Bfrtip',
                buttons: ['pageLength', {
                    extend: 'print',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (win) {
                        console.log($(win.document.body).find('table').eq(1))
                        // $(win.document.body)
                        //     .css('font-size', '10pt')
                        //     .prepend(
                        //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        //     );

                        $(win.document.body).find('table')
                            .addClass('table-bordered').removeClass("table-type-1")
                    },
                    messageTop: `<span class="h5 pt-3 d-block">THÔNG TIN TÀI KHOẢN NGƯỜI DÙNG</span>`
                },
                    'colvis'
                ],
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

            // $('#user-table').on('page.dt', (e) => {
            //     $("#select-all-user").prop("checked", false);
            //     $("#select-all-user").removeClass('allChecked');

            // })


            // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
            // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
            // nếu không load lại nó sẽ vô hiệu
            // var idx = 0;

            // console.log(settings)

            // select all
            $('#select-all-user').on('click', function (e) {
                // idx++
                // console.log("-------------------", idx, "allPage")

                let allPages = tutor_table.rows().nodes();
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

                // $(".approval").on('click', (e) => {
                //     let id = $(e.target).attr("data-value-id");


                //     $.ajax({
                //         type: "post",
                //         url: "../api/tutors/gettutordetailsforadmin",
                //         data: {
                //             id
                //         },
                //         cache: false,
                //         success: function(data) {

                //             // if (data.delete === "success") {
                //             //     subject_topic_table.ajax.reload(null, false);

                //             // }
                //             $("#modal-user-detail .modal-body").html(data);
                //             $("#users-active").attr("data-id", id);

                //             image_viewer(".image-certificate");

                //             console.log(data)
                //         },
                //         error: function(xhr, status, error) {
                //             console.error(xhr);
                //         }
                //     });
                // });

                // update approval tutor
                $(".users-active").off();

                $(".users-active").on('click', (e) => {
                    let id = $(e.target).attr("data-id");
                    let isActive = $(e.target).prop("checked") ? 1 : 0;
                    console.log(id, isActive, "ID")

                    $.ajax({
                        type: "post",
                        url: "../api/users/updateactiveuser",
                        data: {
                            id,
                            isActive
                        },
                        cache: false,
                        success: function (data) {

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
                                    onClick: function () { } // Callback after click
                                }).showToast();
                            }

                            console.log(data)
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                })




            }
            // var review_modal = document.getElementById('modal-user-detail');

            // review_modal?.addEventListener('hidden.bs.modal', function(event) {

            //     remove_eventListener({
            //        event: 'click',
            //        selector: '#image-viewer .close'
            //     });
            //     remove_eventListener({
            //        event: 'click',
            //        selector: '.image-certificate'
            //     })


            // });

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
                                                        url: "../api/subjects/addsubject",
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

})(jQuery);