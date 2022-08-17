<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Library\Session;
use Classes\Contact;

$filepath  = realpath(dirname(__FILE__));

require_once(__DIR__ . "../../../vendor/autoload.php");
// include_once($filepath . "../../lib/session.php");
// if (!Session::checkRoles(['user', 'tutor'])) {
//         header("location:../../pages/errors/404");
// }
// include_once($filepath . "../../classes/savedtutors.php");
// include_once($filepath . "../../helpers/format.php");
Session::init();





if (isset($_POST["fullname"]) ) {
        try {
                $fullname = Format::validation($_POST["fullname"]);
                $email = Format::validation($_POST["email"]);
                $phone = Format::validation($_POST["phone"]);
                $content = Format::validation($_POST["content"]);

                $contact  = new contact();
                
                $contact->insertcontact($fullname,$email, $phone, $content);

        } catch (Exception $ex) {
                print_r($ex->getMessage());
        } finally {
                exit;
        }
}
