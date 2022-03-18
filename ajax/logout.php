<?php
namespace Ajax;
use Library\Session;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/session.php");
Session::init();




if (isset($_POST["action"]) && $_POST["action"] === "logout") {
    if (session_id() !== '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
        // session isn't started
        Session::destroy();
?>
        <div class="<?= empty($_SESSION) ?  "d-block" : "d-none"   ?>" id="signup-signin">
            <span data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="cursor: pointer">
                Đăng nhập/Đăng kí
            </span>

        </div>
<?php
        exit;
    }
}








// 

// 
