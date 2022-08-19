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
            columns: [
                { "data": "id" },
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
                        return `<a href="#id=${data.id}">Xem thêm</a>`
                    }
                }
            ]
        });
    });
})();