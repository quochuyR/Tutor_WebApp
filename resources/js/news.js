(function() {
    jQuery(document).ready(function($) {
        'use strict';

        function strimURLN() {
            const urlPage = [];
            urlPage.push(window.location.href.split("/"));
            if (urlPage[0][urlPage[0].length - 1] == "news")
                return true;
            return false;
        }

        if (strimURLN()) {
            $.ajax({
                url: "../api/news/getpost",
                type: "post",
                success: function(data) {
                    console.log(data, "data news");
                }
            });
        }
    })

})();