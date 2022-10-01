<?php
// namespace Ajax;
// use Library\Session;
// use Classes\Remember;
// $filepath  = realpath(dirname(__FILE__));


// include_once($filepath . "../../lib/session.php");
// include_once($filepath . "../../classes/remember.php");
// Session::checkRoles(['user','tutor']);
// // if(!Session::checkRoles(['user','tutor'])){
// //     header("location: ../pages/errors/404");
// // }
// $remember = new Remember();
// if (isset($_POST["action"]) && $_POST["action"] === "logout") {
//     if (session_id() !== '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
//         // session isn't started
        

//         $remember->delete_user_token(Session::get('userId'));

//         if (isset($_COOKIE['remember_me'])) {
//             unset($_COOKIE['remember_me']);
//             setcookie('remember_user', null, -1);
//         }
//         Session::destroy();
//         exit;
//     }
// }

