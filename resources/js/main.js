(function () {

  $(document).ready(function () {
    const urlProvince = "https://vapi.vnappmob.com/api/province/";
    let DOMprovinces = document.querySelector("#provinces");
    let DOMDistricts = document.querySelector("#districts");

    let optionOfSelectt = `<option  value="0">--Chọn huyện--</option>`
    if (DOMDistricts) DOMDistricts.innerHTML = `<select  id="districts" value="0" name="districts[]" class="mx-2 form-select" >${optionOfSelectt}</select>`;

    function isEmptyObj(obj) {
      return Object.keys(obj).length === 0;
    }

    // fetch api
    async function postData(url = '', method, data) {
      const response = await fetch(url, {
        method: method,
        cache: 'no-cache',
        mode: 'cors',
        headers: {
          "Access-Control-Allow-Origin": "*",
          'Content-Type': 'application/json'
        },
        credentials: 'same-origin',
        redirect: 'follow',
        body: isEmptyObj(data) ? undefined : JSON.stringify(data)
      })
      return response.json()
    }

    DOMprovinces && $.ajax({
      type: "get",
      url: urlProvince,
      cache: false,
      success: function (data) {
        // if(data !== '0')
        let ObjProvinces = Object.assign({}, data); // copy to new obj
        let provinces = [...Object.values(ObjProvinces)]; // convert to array

        // create many options of select
        let optionOfSelect = `<option value="0">--Chọn tỉnh--</option>`

        provinces[0].map((val, idx) => {

          optionOfSelect += `<option value="${val.province_id}">${val.province_name}</option>`
          // console.log()
        })
        console.log(provinces)
        DOMprovinces.innerHTML = `<select id = "province" name="province" class="form-select" >${optionOfSelect}</select>`; // join option into select
        console.log(data, "data")
      },
      error: function (xhr, status, error) {
        console.log(xhr, error, status, "Lỗi");
      }
    });


    // District 
    DOMprovinces?.addEventListener('change', (e) => {
      // $(".js-data-districts-ajax option[value='']")?.remove();
      select2District(e)
    })


    function select2District(e) {

      $('.js-data-districts-ajax').select2({
        theme: 'bootstrap-5',
        language: "vi",
        multiple: true,
        ajax: {
          url: `https://vapi.vnappmob.com/api/province/district/${e.target.value}`,
          type: "get",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              term: params.term
            }

          },
          processResults: function (data, params) {
            params.term = params.term ? params.term : 'all'
            console.log(params)

            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
              results: $.map(data.results, (val) => {
                // console.log(val.district_name.toUpperCase().includes(params.term.toUpperCase()), "pấm")

                if (params.term === 'all') {
                  return {
                    id: val.district_id,
                    text: val.district_name
                  }
                }
                if (val.district_name.toUpperCase().includes(params.term.toUpperCase())) {
                  return {
                    id: val.district_id,
                    text: val.district_name
                  }
                }


              }),
            }
          },
          cache: true
        },
        placeholder: 'Gõ chữ bất kì để tìm huyện',
      }).on("select2:close", function (e) {  // validation select2
        $(this).valid();
      });
    }



    //





    // 


    $('.js-data-subjects-ajax').select2({
      theme: 'bootstrap-5',
      language: "vi",
      ajax: {
        url: '../api/subjecttopic/getsubjecttopicbyquery',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          var query = {
            q: params.term,
            num: !params.term && 'all'
          }

          // Query parameters will be ?search=[term]&type=public
          return query;
        }, processResults: function (data, params) {
          // Transforms the top-level key of the response object from 'items' to 'results'
          return {
            results: data
          }
        },
        cache: true
      },
      placeholder: 'Gõ chữ bất kì để tìm chủ đề',
      minimumInputLength: 0,
      // templateResult: formatRepo,
      // templateSelection: formatRepoSelection
    }).on("select2:close", function (e) {  // validation select2
      $(this).valid();
    });

    $('.js-data-teaching-form-ajax').select2({
      theme: 'bootstrap-5',
      language: "vi",
      multiple: true,
      data: [
        { id: 0, text: "Trực tuyến (Online)" },
        { id: 1, text: "Gặp mặt (Offline)" }],
      placeholder: 'Gõ chữ bất kì để tìm hình thức dạy',
      // templateResult: formatRepo,
      // templateSelection: formatRepoSelection
    }).on("select2:close", function (e) {  // validation select2
      $(this).valid();
    });

    $(".signin-form").validate({
      ignore: [],
      rules: {

        "username": {
          required: true,
          minlength: 5
        },
        "password": {
          required: true,
          minlength: 5
        }
      },
      messages: {
        "username": "Tài khoản ít nhất 5 ký tự.",
        "password": "Mật khẩu ít nhất 5 ký tự.",
      },

      errorPlacement: function (label, element) {

        if (label) label.insertBefore($(element).parent()).addClass('mb-2 text-danger');

      },
      submitHandler: (form) => {
        // submitRegisterForm();
        // form.submit();
        var response = grecaptcha.getResponse();
        //recaptcha failed validation
        // if (response.length == 0) {
        //   $('#recaptcha-error').show();
        //   return false;
        // }
        //   //recaptcha passed validation
        // else {
        //   $('#recaptcha-error').hide();
        //   return true;
        // }
      }
    });

    // Đăng nhập
    window.recaptchaCallback = () => {
      if (grecaptcha.getResponse() !== "") {
        $("#recaptcha-error").text("")
        return true;
      }
    }

    $(".signin-form").on('submit', (e) => {
      e.preventDefault();
      let $form = $(e.target);

      if (grecaptcha.getResponse() == "") {
        $("#recaptcha-error").text("Bạn chưa chọn recaptcha.")
        return false;
      }
      if (!$form.valid()) return false;
      let token = $("#token").val();
      let username = $("#username-field").val();
      let password = $("#password-field").val();
      let remember = $("#remember-me").prop("checked");
      console.log(username, remember, password)
      $.ajax({
        type: "post",
        url: "../pages/login",
        data: {
          token,
          username,
          password,
          remember,
          "g-recaptcha-response": grecaptcha.getResponse()
        },
        cache: false,
        success: function (data) {
          // if(data !== '0')
          // grecaptcha.reset();
          // $('#staticBackdrop').modal('hide'); // Tự nhiên cái màn đen che mất tiêu thấy ghét xoá luôn :))
          // $("#signup-signin").removeClass("d-block").addClass("d-none"); // đăng nhập xong ẩn đăng kí/đăng nhập
          // $("#login").replaceWith(data);

          logout(); // khi đăng nhập xong mới hiện logout nên để logout ở đây
          // console.log(data, "data")
          // console.log($("#username-field").val(), "Tài khoản")
          // if (window.location.pathname.includes("tutor_details"))
          if (data.login === 'fail-user-pass') {
            $("#error-login").html(`<div class="alert alert-danger" role="alert">
                                        <span class="el-alert__title">${data.message}</span>
                                    </div>`);
            grecaptcha.reset();

          }
          else if (data.login === "fail-user-verification") {
            $("#error-login").html(`<div class="alert alert-danger" role="alert">
                                      <span class="el-alert__title">${data.message}</span>
                                  </div>`);
          }
          else if (data.login === "successful") {
            window.location = data.url;

          }
          console.log(data)
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
          url: "../inc/header",
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
              location.href = "../pages/list_tutor";
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

  });

  // validation form


})();