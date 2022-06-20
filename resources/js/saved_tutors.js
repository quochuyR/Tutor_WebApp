(function(){
    $(document).ready(function() {
        $(".unsave-tutor").on('click', (e) => {
            e.preventDefault();

            const tutorId = $(e.currentTarget).attr("data-href");

            console.log(tutorId, $(e.currentTarget).attr("data-href"));
            $.ajax({
                type: "post",
                url: "../api/savedtutor/unsaved_tutors",
                data: {
                    tutorId: tutorId
                },
                cache: false,
                success: function(data) {

                    // $("#save-tutor").replaceWith(data);
                    if (data.delete === "successful")
                        $(e.target).closest(".job-box").remove();
                    console.log(data, "data")
                },
                error: function(xhr, status, error) {
                    console.log(xhr, error, status, "Lỗi");
                }
            });
        });
    });
})();