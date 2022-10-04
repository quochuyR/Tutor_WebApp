(function() {
    jQuery(document).ready(function($) {
        'use strict'
        // SELECT *, (SELECT count(id) FROM `blogs` WHERE `kind` = kindpost.kindname AND `status` = 1) AS cobo,(SELECT count(id) FROM `blogs` WHERE `kind` = kindpost.kindname AND `status` = 0) AS an  FROM `kindpost`
        $("#tableCategory").DataTable({
            // processing: true,
            // serverSide: true,
            searchPanes: {
                controls: false
            },
            searching: false,
            info: false,
            ajax: {
                url: "../api/category/getcategory",
                dataType: 'json',
                type: 'get',
            },
            createdRow: function(row, data, dataIndex) {
                if (data.status === 0) {
                    $(row).addClass('badge-light-danger');
                }
            },
            columns: [{
                    "data": "id",
                    render: function(data, type, row) {
                        return `<div class="text-center checklistcategory"><input  class="form-check-input checklistcategory" type="checkbox" value="${data}" name="flexCheckTableCategory[]"></div>`;
                    }
                },
                {
                    "data": "status",
                    render: function(data, type, row) {
                        if (data) {
                            return `<p class="text-center icon-tablecategory"><i class="fa-solid fa-circle-check icon-tablecategory"></i></p>`
                        }
                        return `<p class="text-center icon-tablecategory"><i class="fa-solid fa-circle-xmark icon-tablecategory"></i></p>`;
                    }
                },
                {
                    "data": {
                        "kindname": "kindname",
                        "id_parent": "id_parent",
                        "id": "id",
                    },
                    render: function(data, type, row) {
                        if (data['id_parent'] != 0) {
                            return `<a href="categoryedit?${data['id']}"><p class="text-start"><b>${data['kindname']}</b></p></a><p><small>-- Danh mục cha: ${data['id_parent']}</small></p>`;
                        } else {
                            return `<a href="categoryedit?${data['id']}"><p class="text-start"><b>${data['kindname']}</b></p></a>`;
                        }

                    }
                },
                {
                    "data": "position_show",
                    render: function(data, type, row) {
                        return `<p class= "text-center" >${data}</p> `;
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return `<p class= "text-center" > 0</p> `;
                    }
                },

                {
                    "data": null,
                    render: function(data, type, row) {
                        return `<div class= "text-center d-block" >
                                <span id="remoteCategory" class="material-symbols-rounded" style="color: #D61C4E"> delete </span>
                            </div> `;
                    }
                }
            ],
            "order": [
                [1, 'asc']
            ],
            // initComplete: function(settings, json) {
            //     InitLoadSuccess(settings, json);
            // }
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
                    previous: '«',
                }
            }
        });

        $('#publishedCategory').on('click', function(event) {
            event.preventDefault();
            var arr = [];

            arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "../api/category/changestatuscategory",
                    data: {
                        id: arr,
                        status: 1
                    },
                    dataType: 'json',

                }).done(function(data) {
                    //none
                });
                $('#tableCategory').DataTable().ajax.reload();
            }

        })

        function loadTableCategory() {
            const spinnertable = $('.spinnertable');
            const tableCategory = $('#tableCategory tbody');
            tableCategory.addClass('fade');
            spinnertable.removeClass('fade');
            setTimeout(function() {
                spinnertable.addClass('fade');
                tableCategory.removeClass('fade');
                $('#tableCategory').DataTable().ajax.reload();
            }, 300);
        }

        $('#unPublishedCategory').on('click', function(event) {
            event.preventDefault();
            var arr = [];

            arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                console.log(typeof(JSON.stringify(arr)))
                console.log(JSON.stringify(arr))
                $.ajax({
                    type: "POST",
                    url: "../api/category/changestatuscategory",
                    data: {
                        id: arr,
                        status: 0
                    }
                }).done(function(data) {
                    //none
                });
                $('#tableCategory').DataTable().ajax.reload();
            }
        })

        $('#deleteCategory').on('click', function(event) {
            event.preventDefault();
            var arr = [];

            arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function(e, i) {
                return +e.value;
            });
            if (arr.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "../api/category/deleteCategory",
                    data: {
                        id: arr,
                    },

                }).done(function(data) {
                    loadTableCategory();
                });
            }
        })

        $('#reloadTableCategory').on('click', function(event) {
            event.preventDefault();
            loadTableCategory();

        })


        $('#tableCategory tbody').on('click', '#remoteCategory', function() {
            // alert(data[0] + "'s salary is: " + data[5]);
            let table = $("#tableCategory").DataTable();
            var data = table.row($(this).parents('tr')).data();
            //truy vấn xóa trong db
            var arr = [];

            arr[0] = data['id'];
            console.log(arr);
            $.ajax({
                    type: "post",
                    url: "../api/category/deleteCategory",
                    data: {
                        id: arr,
                    }
                    // cache: false,
                })
                .done(function() {
                    alert("Đã xóa danh mục");
                    $('#tableCategory').DataTable().ajax.reload();
                });
        });

    });
})();