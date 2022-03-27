(function(){
// URL province api
const urlProvince = "https://vapi.vnappmob.com/api/province/";

let DOMprovinces = document.querySelector("#provinces");
let DOMDistricts = document.querySelector("#districts");
let DOMWards = document.querySelector("#wards");

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
    }
    )
    return response.json()
}

postData(urlProvince, "GET", {}).then(data => {

    let ObjProvinces = Object.assign({}, data); // copy to new obj
    let provinces = [...Object.values(ObjProvinces)]; // convert to array

    // create many options of select
    let optionOfSelect = `<option value="0">--Chọn tỉnh--</option>`
    provinces[0].map((val, idx) => {
        optionOfSelect += `<option value="${val.province_id}">${val.province_name}</option>`
        console.log()

    })
    console.log(provinces)
    DOMprovinces.innerHTML = `<select name="province[]" class="mx-2">${optionOfSelect}</select>`; // join option into select

});

// District 
DOMprovinces.addEventListener('change', (e) => {
    const urlDistrict = new URL(`https://vapi.vnappmob.com/api/province/district/${e.target.value}`);

    postData(urlDistrict, "GET", {}).then(data => {

        let ObjDistricts = Object.assign({}, data);
        let districts = [...Object.values(ObjDistricts)];


        let optionOfSelect = `<option value="0">--Chọn huyện--</option>`
        districts[0].map((val, idx) => {
            optionOfSelect += `<option value="${val.district_id}">${val.district_name}</option>`
            console.log()

        })

        DOMDistricts.innerHTML = `<select name="district[] class="mx-2"">${optionOfSelect}</select>`;

    });
})

// Ward
DOMDistricts.addEventListener('change', (e) => {
    const urlWard = new URL(`https://vapi.vnappmob.com/api/province/ward/${e.target.value}`);

    postData(urlWard, "GET", {}).then(data => {

        let ObjWards = Object.assign({}, data);
        let Wards = [...Object.values(ObjWards)];


        let optionOfSelect = `<option value="0">--Chọn xã/thị trấn--</option>`
        Wards[0].map((val, idx) => {
            optionOfSelect += `<option value="${val.ward_id}">${val.ward_name}</option>`
            console.log()

        })

        DOMWards.innerHTML = `<select name="ward[] class="mx-2">${optionOfSelect}</select>`;

    });
})

function isEmptyObj(obj) {
    return Object.keys(obj).length === 0;
}

})();