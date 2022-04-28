(function () {

  $(document).ready(function () {
    const urlProvince = "https://vapi.vnappmob.com/api/province/";
    let DOMprovinces = document.querySelector("#provinces");
    let DOMDistricts = document.querySelector("#districts");
    console.log(DOMprovinces)
    // let DOMWards = document.querySelector("#wards");
    let rs = {
      "results": [
        {
          "text": "Group 1",
          "children": [
            {
              "id": 1,
              "text": "Option 1.1"
            },
            {
              "id": 2,
              "text": "Option 1.2"
            }
          ]
        },
        {
          "text": "Group 2",
          "children": [
            {
              "id": 3,
              "text": "Option 2.1"
            },
            {
              "id": 4,
              "text": "Option 2.2"
            }
          ]
        }
      ],
      "pagination": {
        "more": true
      }
    };

    let optionOfSelectt = `<option  value="0">--Chọn huyện--</option>`
    if (DOMDistricts) DOMDistricts.innerHTML = `<select  name="province" id="province" value="0" name="province[]" class="mx-2 form-select" >${optionOfSelectt}</select>`;

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
          'Content-Type': 'application/json'
        },
        credentials: 'same-origin',
        redirect: 'follow',
        body: isEmptyObj(data) ? undefined : JSON.stringify(data)
      })
      return response.json()
    }

    DOMprovinces && postData(urlProvince, "GET", {}).then(data => {

      let ObjProvinces = Object.assign({}, data); // copy to new obj
      let provinces = [...Object.values(ObjProvinces)]; // convert to array

      // create many options of select
      let optionOfSelect = `<option value="0">--Chọn tỉnh--</option>`

      provinces[0].map((val, idx) => {

        optionOfSelect += `<option id="province" value="${val.province_id}">${val.province_name}</option>`
        // console.log()
      })
      console.log(provinces)
      DOMprovinces.innerHTML = `<select name="live" id = "live" name="province[]" class="form-select" >${optionOfSelect}</select>`; // join option into select

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
            var query = {
              search: params.term
            }
            return query;
          },
          processResults: function (data, params) {
            console.log(data)
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
              results: [...data.results.map(val => {
                return {
                  id: val.district_id,
                  text: val.district_name
                }
              })]
            }
          }
        },
        placeholder: 'Gõ chữ bất kì để tìm huyện',
      });
    }



    //





    // 


    $('.js-data-subjects-ajax').select2({
      theme: 'bootstrap-5',
      language: "vi",
      ajax: {
        url: '../api/getsubjecttopicbyquery',
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
        }
      },
      placeholder: 'Gõ chữ bất kì để tìm chủ đề',
      minimumInputLength: 0,
      // templateResult: formatRepo,
      // templateSelection: formatRepoSelection
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
    });

  });

  

})();