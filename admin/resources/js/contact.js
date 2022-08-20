(function() {

    jQuery(document).ready(function($) {
        "use strict";

        $("#contactstable").DataTable({
            // processing: true,
            // serverSide: true,
            ajax: {
                url: "../api/contact/getcontact",
                dataType: 'json',
                type: 'get',
            },
            createdRow: function(row, data, dataIndex) {
                if (data.status === 0) {
                    $(row).addClass('badge-light-danger');
                }
            },
            columns: [
                { "data": 'id', },
                { "data": "fullname" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "time" },
                {
                    "data": "status",
                    render: function(data, type, row) {
                        if (data == 0)
                            return "<p class='badge bg-danger text-center d-block'>Chưa xem</p>";
                        else
                            return "<p class='badge bg-success text-center d-block'>Đã xem</p>";
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        // return `<a href="?id=${data.id}" id="moreview">Xem thêm</a>`
                        return `<div id="moreviewbutton" class="text-center d-block"><span  class="material-symbols-rounded" style="color: #1C3879">visibility</span></div>`;
                        // return `<button id="moreviewbutton" class="btn btn-success m-1 p-1">Xem</button>`;

                    }
                }
            ],
            "order": [
                [1, 'asc']
            ],
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
                    messageTop: `<span class="h5 pt-3 d-block">Danh sách liên hệ</span>`
                },
                'colvis'
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

        //Thao tác với bảng
        $('#contactstable tbody').on('click', 'tr', function() {
            var data = $("#contactstable").DataTable().row(this).data();
            //hiện chổ đã chọn trên bảng
            let selectedcolor = 'selected';
            if ($(this).hasClass(selectedcolor)) {
                $(this).removeClass(selectedcolor);
            } else {
                $("#contactstable tr.selected").removeClass(selectedcolor);
                $(this).addClass(selectedcolor);
            }
            // alert(data['status']);

            //hiển thị thông tin
            $("#showfullname").html(data['fullname']);
            $("#showemail").html(data['email']);
            $("#showphone").html(data['phone']);
            $("#showcontent").html(data['content']);
            $("#contactModal").modal('show');


            if (data['status'] == 1) {
                $("#seencontact").hide();
                $("#deliveredcontact").show();
            } else {
                $("#seencontact").show();
                $("#deliveredcontact").hide();
            }

            $("#seencontact").on('click', function() {
                let id = data['id'];
                let status = data['status'];
                $.ajax({
                    url: "../api/contact/updatestatuscontact",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: id,
                        status: status
                    }
                });
                $("#contactstable").DataTable().ajax.reload();
                $("#contactModal").modal('hide');
            });
            $("#deliveredcontact").on('click', function() {
                let id = data['id'];
                let status = data['status'];
                $.ajax({
                    url: "../api/contact/updatestatuscontact",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: id,
                        status: status
                    }
                });
                $("#contactstable").DataTable().ajax.reload();
                $("#contactModal").modal('hide');
            });
        });

    });

})();