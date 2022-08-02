<?php

use Library\Session;

require_once(__DIR__ . "../../vendor/autoload.php");

Session::init();

// print_r($_SESSION);
include "../inc/header.php";

print_r(filter_var("nhokbaby0246@gmail<>.com", FILTER_SANITIZE_EMAIL));
?>

<span class="material-symbols-rounded">
&#xe86c;
</span>
 <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0">
        <div class="card card-tutor">
            <div class=" card-img-top img-teacher text-center">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"></rect>
                </svg>
            </div>
            <div class="card-body">
                <h5 class="card-title placeholder-glow">
                    <span class="placeholder col-6"></span>
                </h5>
                <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-6"></span>
                    <span class="placeholder col-8"></span>
                </p>
                <div class="d-flex align-items-center justify-content-between pt-1 position-absolute" style="bottom: 1rem;">
                    <div class="d-flex flex-row">
                        <a href="#" class="mx-1 social-list-item text-center border-primary text-primary disabled placeholder"></a>
                        <a href="#" class="mx-1 social-list-item text-center border-info text-info disabled placeholder"></a>
                    </div>
                    <!-- <div class="btn btn-primary">Đăng ký</div> -->
</div>
</div>
</div>
</div>
</div> 
<img src="https://huyit19dthu.000webhostapp.com/tutor_webapp/public/images/262421254_424524942476669_3360814612238629305_n.jpg" alt="" srcset="">

<?php include "../inc/script.php"
?>
<?php include '../inc/footer.php' ?>