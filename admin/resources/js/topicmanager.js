(function() {
    // data table
    "use-strict"
    jQuery(document).ready(function($) {

        // subject topics

        (function() {

            var subject_topic_table = $('#subject-topic-table').DataTable({
                // data: data,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '../api/subjecttopics/getdatasubjecttopics',
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
                                                                <form class="edit-subject-form d-none">


                                                                    <div class="form-group col-sm-8 flex-column d-flex mb-3">

                                                                        <select class="js-data-subjects-ajax-edit select2bs5" name="subject-id">


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
                                return `<span class="topic-name">${data}</span>
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


            select2_ajax('.js-data-subjects-ajax', null, '../api/subjects/getsubjectjointopicbyquery', function(params) {
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

                let select2 = $(selector).select2({
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

                return select2;
            }


            select2_ajax('.js-data-subject-topic-ajax', $("#modalAddSubjectTopic"), '../api/subjects/getsubjectbyquery', function(params) {
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
                $('.edit-topic-form').off();
                $(".delete-subject-topic").off();
                $("#subject-topic #multiple-delete").off();
                // $('.js-data-subject-topic-ajax').select2('destroy');


                // Edit subject topic
                // gọi hàm này khi bấm vào nút edit



                // Toggle Class
                $(".edit-subject-topic").on('click', (e) => {
                    // get tr in table
                    let row_subject = $(e.currentTarget).closest(".subject-row");
                    let edit_subject_form = row_subject.find("td > .edit-subject-form")
                    let edit_topic_form = row_subject.find("td > .edit-subject-topic-form")
                    let span_subject_name = row_subject.find("td > .subject-name")
                    let span_topic_name = row_subject.find("td > .topic-name")
                    // show edit form
                    let select_subject_edit = $(e.target).closest("tr").find(".js-data-subjects-ajax-edit");
                    select2_ajax(select_subject_edit, null, '../api/subjects/getsubjectbyquery', function(params) {
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
                    console.log(select_subject_edit, $(span_subject_name).text());
                    $.ajax({
                        type: 'post',
                        url: '../api/subjects/getsubjectbyquery',
                        data:{
                            q: $(span_subject_name).text(),
                            num: "all"
                        }
                    }).then(function(data) {
                        // create the option and append to Select2
                        console.log(data[0].text, "đỉnh thật")
                        var option = new Option(data[0].text, data[0].id, true, true);
                        select_subject_edit.append(option).trigger('change');

                        // manually trigger the `select2:select` event
                        select_subject_edit.trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        });
                    });
                    console.log("sos")

                    // $(form).on("submit", (event) => {
                    //     event.preventDefault();

                    edit_subject_form.toggleClass("d-none");
                    edit_topic_form.toggleClass("d-none");

                    //     console.log($(event.target).serialize())
                    $(edit_topic_form).off().on('submit', (e) => {
                        e.preventDefault();
                        let topic_id = $(row_subject).find(".topic-id").text();
                        let subject_id = $(edit_subject_form).find("select").val()
                        let topic_name = $(edit_topic_form).find("input").val()
                        console.log(subject_id, topic_name, topic_id, "di")
                        $.ajax({
                            type: "post",
                            url: "../api/subjecttopics/updatesubjecttopic",
                            data: {
                                topic_id,
                                subject_id,
                                topic_name
                            },
                            cache: false,
                            success: function(data) {

                                if (data.update === "success") {
                                    subject_topic_table.ajax.reload(null, false);
                                    Toastify({
                                        text: "Cập nhật thành công!",
                                        duration: 5000,
                                        close: true,
                                        gravity: "top", // `top` or `bottom`
                                        position: "right", // `left`, `center` or `right`
                                        stopOnFocus: true, // Prevents dismissing of toast on hover
                                        style: {
                                            background: "linear-gradient(to right, #56C596, #7BE495)",
                                        },
                                        onClick: function() {} // Callback after click
                                    }).showToast();

                                    $(select_subject_edit).select2('destroy');

                                    edit_subject_form.toggleClass("d-none");
                                    edit_topic_form.toggleClass("d-none");
                                }

                                console.log(data)
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    })

                    // });
                    // console.log(form)


                    // hide span subject name
                    span_subject_name.toggleClass("d-none");
                    span_topic_name.toggleClass("d-none");
                    console.log(edit_subject_form, span_subject_name)
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
                        url: "../api/subjecttopics/deletesubjecttopics",
                        data: {
                            id_subject_topic
                        },
                        cache: false,
                        success: function(data) {

                            if (data.delete === "success") {
                                subject_topic_table.ajax.reload(null, false);
                                Toastify({
                                    text: "Xoá thành công!",
                                    duration: 5000,
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
                });

                // Delete multiple

                $("#multiple-delete").on('click', (e) => {
                    let subject_topic_id_list = [];
                    $('input[type="checkbox"]:not(#subject-topic-table #select-all):checked').each((i, elm) => {
                        subject_topic_id_list.push($(elm).val())
                    });
                    console.log(subject_topic_id_list, "subject_topic_id_list");
                    $.ajax({
                        type: "post",
                        url: "../api/subjecttopics/deletesubjecttopics",
                        data: {
                            id_subject_topic: subject_topic_id_list
                        },
                        cache: false,
                        success: function(data) {

                            if (data.delete === "success") {
                                Toastify({
                                    text: "Xoá thành công!",
                                    duration: 5000,
                                    close: true,
                                    gravity: "top", // `top` or `bottom`
                                    position: "right", // `left`, `center` or `right`
                                    stopOnFocus: true, // Prevents dismissing of toast on hover
                                    style: {
                                        background: "linear-gradient(to right, #56C596, #7BE495)",
                                    },
                                    onClick: function() {} // Callback after click
                                }).showToast();
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
                        url: "../api/subjecttopics/addsubjecttopics",
                        data: $(event.target).serialize(),
                        cache: false,
                        success: function(data) {

                            if (data.add === "success") {
                                subject_topic_table.ajax.reload(null, false);
                                Toastify({
                                    text: "Thêm thành công!",
                                    duration: 5000,
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