<?php

namespace Views;

use Helpers\Util, Helpers\UploadFile;
use Helpers\Format;

require_once(__DIR__ . "../../vendor/autoload.php");


// upload avatar user
// $upload_image = UploadFile::upload("file", "../public/images_test/");
// print_r($upload_image["fileName"][0]);

$title = "Danh sách gia sư";
$nav_tutor_active = "active";
include "../inc/header.php";
?>

<div id="main" class="container pb-3">
    <!-- <div class="card">
        <div class="card-body">
            <form method='post' class="row g-3" action='test' enctype='multipart/form-data'>
            <div class="col-6">
                <input type="file" class="form-control" name="file[]" id="file" multiple>
            </div>
            <div class="col-3">
                <input type='submit' class="btn btn-secondary" name='submit' value='Upload'>
            </div>
            </form>
        </div>
    </div> -->

    <div class="card">
        <div class="card-body">
            <div id="demo-basic"></div>
            <button type="button" class="btn btn-info" id="get-result">kết quả</button>
        </div>
    </div>

</div>
<?php include "../inc/script.php"
?>
<script>
    var basic = $('#demo-basic').croppie({
        viewport: {
            width: 320,
            height: 320
        },

        boundary: {
            width: 360,
            height: 360,
            type: 'circle'
        },
        showZoomer: true,
        mouseWheelZoom: 'ctrl',
    });
    basic.croppie('bind', {
        url: '../public/images_test/mayanh.jpg',
        // points: [77, 469, 280, 739]
    });
    //on button click

   
        basic.croppie('result', {
        type: 'canvas',
        size: 'viewport',
        format:'png'
    }).then(function(html) {
        // html is div (overflow hidden)
        // with img positioned inside.
        console.log(html)
    });
    
   
</script>
<?php include '../inc/footer.php' ?>