(function () {

    // URL province api
   
    $(document).ready(function () {




        // Thêm sự kiện click cho checkbox mục đích để xoá và thêm vào filter
        function onChangeCheckbox() {
            $("input[type=checkbox].checkbox-filter ").each((i, checkbox) => {
                checkbox.addEventListener('click', (e) => {
                    addAndRemoveFilter(e);
                })
            })
        };

        onChangeCheckbox(); // Gọi thẳng ở đây luôn vì cho lần đầu nó load mấy cái checkbox





        // Nhấn để thêm vào chỗ "lọc theo"

        $(".category").each((i, child) => {
            if (child.nodeName === 'LI') {
                child.addEventListener('click', (e) => {

                    addAndRemoveFilter(e);

                    // console.log(current, "class");
                    $(".subject-active").each((i, li) => {
                        // console.log(li.className, "li.className")
                        if (li !== e.currentTarget) {
                            if (li.className.includes("subject-active")) {
                                li.className = li.className.replace(" subject-active", "");

                                $(`div[data-category="${li.getAttribute("subject-id")}"`)?.remove();
                                $(`div[value="${li.getAttribute("value")}"`)?.remove();


                                // console.log(e.target.getAttribute("value"))
                                // console.log(document.querySelector(`div[value="${e.currentTarget.getAttribute("value")}"`))
                            }
                        }


                    });



                    if (!e.currentTarget.className.includes("subject-active"))
                        $(e.currentTarget).addClass(" subject-active");

                    // if($(".subject-active").length <= 0)
                    //     $(`li[value="Tất cả"]`).addClass(" subject-active");

                    // console.log(e.currentTarget.className.includes("subject-active"))
                });

            }

        });



        function addAndRemoveFilter(e) {
            var DIVFilter = document.querySelector("#filter");
            var listFilter = [...DIVFilter.children];
            // console.log(listFilter.filter(val => {
            //     return val.getAttribute("value") === e.currentTarget.getAttribute("value")
            // }).length);
            // console.log(e.currentTarget.parentNode.getAttribute("data-category"))

            // Thêm filter môn học (việc lọc để tránh thêm trùng)

            if (listFilter.filter(val => val.getAttribute("value") === e.currentTarget.getAttribute("value")).length <= 0 && e.currentTarget.getAttribute("type") !== 'checkbox') {
                DIVFilter.innerHTML += `<div class="green-label green-label-filter font-weight-bold p-0 px-1 mx-sm-1 mx-0 my-sm-0 my-2" value="${e.currentTarget.getAttribute("value")}">${e.currentTarget.getAttribute("value")} <span
            class="px-1 close " >&times;</span> </div>`;

            }
            // Thêm filter của checkbox (việc lọc để tránh thêm trùng)
            else if (listFilter.filter(val => val.getAttribute("data-value") === e.currentTarget.parentNode.firstChild.nodeValue).length <= 0 && e.currentTarget.getAttribute("type") === 'checkbox' && e.currentTarget.checked) {
                DIVFilter.innerHTML += `<div class="green-label green-label-filter font-weight-bold p-0 px-1 mx-sm-1 mx-0 my-sm-0 my-2"  data-category="${e.currentTarget.parentNode.getAttribute("data-category")}" data-value="${e.currentTarget.parentNode.firstChild.nodeValue}">${e.currentTarget.parentNode.firstChild.nodeValue} <span
            class="px-1 close " >&times;</span> </div>`;
            }

            // Xoá khi checkbox checked bằng flase
            if ($(e.currentTarget).attr("type") === 'checkbox' && e.currentTarget.checked === false) {
                $(`div[data-value="${e.currentTarget.parentNode.firstChild.nodeValue}"`)?.remove();
            }

            $(".close").on('click', (e) => {

                let checkBoxValue = $(e.currentTarget.parentNode).attr("data-value");
                // let LiValue = e.currentTarget.parentNode.getAttribute("value");
                let checkBoxReset = $(`label[data-value="${checkBoxValue}"]`);

                // var current = document.querySelectorAll(".subject-active");

                // [...current].map(li => {
                //     if (li.getAttribute("value") === LiValue) {
                //         li.className = li.className.replace("subject-active", "")
                //     }
                // })

                // xoá checked khi xoá filter
                if (checkBoxReset[0]?.firstElementChild.nodeName === 'INPUT') {
                    checkBoxReset[0].firstElementChild.checked = false;
                }

                // console.log($(".category").first(), "123456");
                // Xoá hết thì thêm background xanh cho li Tất cả :))


                e.currentTarget.parentNode.remove(); // xoá khi click vào dấu x

                // khi xoá filter thì cập nhật lại gia sư

                //     $(`li[value="Tất cả"]`).addClass(" subject-active");
                // if (e.currentTarget.parentNode.("value") ) {
                //     e.currentTarget.parentNode.remove();

                filer_data();
                // }
                // console.log($(".subject-active").length, "length")

                if ($("#filter").children().length <= 1) {
                    $(".category").each((i, items) => {
                        if ($(items).attr("value") === "Tất cả") {
                            $(items).addClass("subject-active");
                        }
                        else {
                            $(items).removeClass("subject-active");
                        }
                    });

                }


            });

            // onChangeCheckbox();  // Cái này dùng đề refresh các chủ đề khi click và môn học
        }




        if (checkMobile(/iPhone|iPad|iPod|Android/i)) {
            $(".text-sub").each((i, li) => {
                li.textContent = li.textContent.substringing(0, 103) + "...";
            })
        }


        function checkMobile(reg) {
            var isMobile = reg.test(navigator.userAgent);
            if (isMobile) {
                return true;
            }
            return false;
        }


        // page_data();
        filer_data();
        page_paginator();

        $("#filter-subject li").on('click', (e) => {


            // thêm subject filter
            $.ajax({
                type: "post",
                url: "../api/Topic",
                data: {
                    subject: $(e.currentTarget).attr('subject-id') // lấy giá trị của thuộc tính subject-id
                },
                cache: false,
                success: function (data) {
                    console.log(data, "chủ đề")
                    $(".topic-container").html(data); // Thêm đoạn html vào id topic (response từ ajax)


                    onChangeCheckbox(); // Cái này dùng đề refresh các chủ đề khi click và môn học
                    $(".topic").on('click', (e) => { // Để ở đây cũng chủ yếu là để refresh các checkbox của 
                        // chủ đề khi mới thêm vào (cập nhật lại DOM)
                        filer_data();  // gọi hàm thực thi filter
                    });
                    filer_data();

                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });


        });

        $(".checkbox-filter").on('click', () => { // filter khi all checkbox bị click

            filer_data();
        });


        // lọc dữ liệu
        function filer_data(e = null) {
            $("#tutors .row").html(`<div class="spinner-border text-primary d-flex mx-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>`);





            let url = $(e?.currentTarget).attr('href') ? $(e.currentTarget).attr('href') : "3&1"; // check có thẻ a chưa 
            let [limit, page] = url.split("&");
            console.log(limit, page, url)

            let subject = $(".category.subject-active").attr("subject-id");
            let topic = get_filter_arr(".topic:checked");
            let status = get_filter_arr(".teachingForm:checked");
            let sex = get_filter_arr(".sex:checked");
            let type = get_filter_arr(".type:checked");
            console.log($(".topic:checked"), "get value ")
            $.ajax({
                type: "post",
                url: "../api/listtutors",
                data: {
                    subject: subject,
                    topic: topic,
                    status: status,
                    sex: sex,
                    type: type,
                    limit,
                    page,
                },
                cache: false,
                success: function (data) {
                    $("#tutors .row").html(data);
                    page_paginator();
                    // console.log(data)
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });

        }

        // Đăng nhập

        $(".signin-form").on('submit', (e) => {
            e.preventDefault();
            let username = $("#username-field").val();
            let password = $("#password-field").val();
            $.ajax({
                type: "post",
                url: "../api/login",
                data: {
                    username,
                    password,
                    "g-recaptcha-response": grecaptcha.getResponse()
                },
                cache: false,
                success: function (data) {
                    // if(data !== '0')
                    grecaptcha.reset();
                    $('#staticBackdrop').modal('hide'); // Tự nhiên cái màn đen che mất tiêu thấy ghét xoá luôn :))
                    $("#signup-signin").removeClass("d-block").addClass("d-none"); // đăng nhập xong ẩn đăng kí/đăng nhập
                    $("#login").replaceWith(data);

                    logout(); // khi đăng nhập xong mới hiện logout nên để logout ở đây
                    console.log(data, "data")
                    console.log($("#username-field").val(), "Tài khoản")
                    if (window.location.pathname.includes("tutor_details"))
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr, error, status, "Lỗi");
                }
            });
        });

        // Đăng xuất
        function logout() {
            $(".logout").on('click', (e) => {
                e.preventDefault();
                clearForm(); //clear không thôi người ta thấy username and password

                console.log($(".logout").attr("href-action"), `$(".logout").attr("href")`);
                $.ajax({
                    type: "post",
                    url: "../api/logout",
                    data: {
                        action: $(".logout").attr("href-action")
                    },
                    cache: false,
                    success: function (data) {
                        // if(data !== '0')
                        clearForm(); //clear không thôi người ta thấy username and password
                        $('#staticBackdrop').modal('hide'); // Tự nhiên cái màn đen che mất tiêu thấy ghét xoá luôn :))
                        $("#login").removeClass("d-flex justify-content-center align-items-center")
                            .addClass("d-none"); // đăng xuất thì ẩn đăng nhập thành công
                        $("#signup-signin").replaceWith(data);
                        if (window.location.pathname.includes("saved_tutors"))
                            location.href = "../pages/list_Tutor";
                        else location.reload();
                        console.log(data, "data")
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr, error, status, "Lỗi");
                    }
                });
            });
        }

        function clearForm() {
            $("#username-field").val('');
            $("#password-field").val('');
        }



        logout();







        // function page_data(e) {
        //     $("#tutors .row").html(`<div class="spinner-border text-primary mx-auto" role="status">
        //                         <span class="sr-only">Loading...</span>
        //                     </div>`);




        //     let url = "../api/listtutors" + ($(e?.currentTarget).attr('href') ? $(e.currentTarget).attr('href') :"?limit=3&page=1"); // check có thẻ a chưa 
        //     console.log(url)
        //     $.ajax({
        //         type: "get",
        //         url: url,
        //         dataType: 'text',
        //         cache: false,
        //         success: function (data) {
        //             $("#tutors .row").html(data);
        //             page_paginator();
        //             // console.log(data)
        //         },
        //         error: function (xhr, status, error) {
        //             console.error(xhr);
        //         }
        //     });
        // }
        function page_paginator() {

            // $.ajax({
            //     type: "get",
            //     url: '../api/listtutors',
            //     dataType: 'text',
            //     cache: false,
            //     success: function (data) {
            //         $("#tutors .row").html(data);

            //         // console.log(data)
            //     },
            //     error: function (xhr, status, error) {
            //         console.error(xhr);
            //     }
            // });
            $(".link-ajax").on('click', (e) => {
                e.preventDefault();
                filer_data(e);
            });
        }

        // Lưu gia sư




        // dữ liệu trả về sẽ như thế này Toán, Vật lý, Hoá,
        function get_filter_str(className) {
            let data = "";
            $(className).each((i, val) => {
                data += $(val).val() + ','
                // console.log($(val).val(), "val")
            });
            return data.trim();
        }

        function get_filter_arr(className) {
            let data = [];
            $(className).each((i, val) => {
                data.push($(val).val());
                // console.log($(val).val(), "val")
            });
            return data;
        }


       






    });

    (function ($) {

        "use strict";

        $('nav .dropdown').hover(function () {
            var $this = $(this);
            $this.addClass('show');
            $this.find('> a').attr('aria-expanded', true);
            $this.find('.dropdown-menu').addClass('show');
        }, function () {
            var $this = $(this);
            $this.removeClass('show');
            $this.find('> a').attr('aria-expanded', false);
            $this.find('.dropdown-menu').removeClass('show');
        });

    })(jQuery);

    (function ($) {

        "use strict";

        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    })(jQuery);

    // Xem hình ảnh lớn và rõ hơn

    $("img:not(.avatar)").on('click', function (e) {
        let DIVShowImg = document.querySelector(".img-float");
        let Img = document.querySelector(".img-container>img");
        DIVShowImg.className = DIVShowImg.className.replace("d-none", "");
        console.log(Img)
        Img.src = e.target.src;
        $('body').css("overflow-y", "hidden");
        document.querySelector(".full-height").addEventListener('click', (e) => {
            e.target.parentNode.classList.add('d-none');
            $('body').css("overflow-y", "scroll");

        });


    });

})();
