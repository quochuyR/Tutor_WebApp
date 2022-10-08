(function() {
    $(document).ready(function($) {

        //tin tuc noi bat
        $.ajax({
            url: "../api/news/selectCategoiesByPosition",
            type: "post",
            data: {
                position: 'feature_1'
            },
            success: function(data) {
                if (data) {
                    const url = window.location.href.split("pages/")[0];
                    $.ajax({
                        url: "../api/news/getPostByCategories",
                        type: "post",
                        data: {
                            kindname: data[0]['kindname'],
                        },
                        success: function(data_PostNews) {
                            if (data_PostNews) {
                                let block_feature_1 = $("#block_feature_1_homepage");
                                block_feature_1.html(`<div class="col-12  col-md-12 row" id="feature_1_homepage"></div>`)
                                    // console.log(data_PostNews, 'datasdfs')
                                let feature_1Dom = $('#feature_1_homepage');
                                let Html = "";
                                const count_post = data[0]['NUMBER'] >= 4 ? (data[0]['NUMBER'] - (data[0]['NUMBER'] % 4)) : 4;
                                const number_news = 8;
                                $.each(data_PostNews, function(index, value) {
                                    if (index == count_post || index >= number_news) {
                                        return false;
                                    }
                                    Html += `<div class="col-6 col-md-3 Bm_Sub">
                                        <div class="Bm_I_Sub">
                                            <a href="${url}pages/post?${value['title_url']}">
                                                <img src="${url}public/images/blogpost/${value['nameimage']}" alt="${value['title_url']}">
                                            </a>
                                        </div>
                                        <div class="Bm_Ab_Sub">
                                            <a href="${url}pages/post?${value['title_url']}">
                                                <p class="limit-text-news">${value['title']}</p>
                                            </a>
                                        </div>
                                    </div>`;
                                })
                                feature_1Dom.html(Html);
                            }
                        }
                    });
                }
            }
        });

        //carousel
        $.ajax({
            url: '../api/homepage/loadCarousel',
            type: 'post',
            success: function(data) {
                // console.log(data, "carousel loaded");
                if (data) {
                    const url = window.location.href.split("pages/")[0];
                    let Html = "";
                    const carousel_image_background = $('#carousel_image_background');
                    $.each(data, function(index, value) {
                        if (index == 0) {
                            Html += `<div class="carousel-item active">
                                    <img src="${url}/public/images/carousel/${value['file_name']}" class="d-block w-100" alt="${value['name_image']}">
                                </div>`;
                        } else {
                            Html += `<div class="carousel-item">
                                        <img src="${url}/public/images/carousel/${value['file_name']}" class="d-block w-100" alt="${value['name_image']}">
                                    </div>`;
                        }
                    })
                    carousel_image_background.html(Html);
                } else {
                    $('#carouselSecction').hide();
                }
            }
        })
    })
})();