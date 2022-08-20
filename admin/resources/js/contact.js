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
            columns: [{
                    "data": 'id',
                },
                { "data": "fullname" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "time" },
                {
                    "data": "status",
                    render: function(data, type, row) {
                        if (data == 0)
                            return "Chưa xem";
                        else
                            return "Đã xem";
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        // return `<a href="?id=${data.id}" id="moreview">Xem thêm</a>`
                        return `<button id="moreviewbutton" class="btn btn-success m-1 p-1">Xem</button>`;

                    }
                }
            ],
            "order": [
                [1, 'asc']
            ]
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
            //hiển thị thông tin
            $("#showfullname").html(data['fullname']);
            $("#showemail").html(data['email']);
            $("#showphone").html(data['phone']);
            $("#showcontent").html(data['content']);
            $("#contactModal").modal('show');
            // alert(data['status']);
            if (data['status'] == 1) {
                $("#seencontact").hide();
            }
            $("#seencontact").on('click', function() {
                let id = data['id'];
                $.ajax({
                    url: "../api/contact/updatestatuscontact",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: id,
                    }
                });
                $("#contactModal").modal('hide');
            });
        });

    });

})();