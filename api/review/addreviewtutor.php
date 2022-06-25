<?php

namespace Ajax;

use Classes\Review;
use Exception;
use Helpers\Format;
use Library\Session;

require_once(__DIR__ . "../../../vendor/autoload.php");

// $filepath = realpath(dirname(__FILE__));

// include_once $filepath . "../../lib/session.php";
if (!Session::checkRoles(['user', 'tutor'])) {
    header("location:../../pages/errors/404");
}
// include_once $filepath . "../../classes/registerusers.php";

// include_once $filepath . "../../helpers/format.php";

$_review = new Review();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {

        if ((isset($_POST['tuid']) && !empty($_POST['tuid']))
            && (isset($_POST['star_review']) && is_numeric($_POST['star_review']))
            && (isset($_POST['text_rating']) && !empty($_POST['text_rating']))
        ) {
            $tuid = Format::validation($_POST["tuid"]);
            $star_review = Format::validation($_POST["star_review"]);
            $text_rating = Format::validation($_POST["text_rating"]);

            try {
                $has_review = $_review->has_review(Session::get('userId'), $tuid)->fetch_assoc()["hasReview"];

                if(!$has_review){
                    $add_review = $_review->add_review(Session::get('userId'), $tuid, $star_review, $text_rating);

                    if ($add_review) {
    
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode(["add" => "successful", "message" => "Thêm đánh giá thành công."]);
                    }
                }
                else{
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["add" => "fail", "message" => "Bạn đã đánh giá gia sư rồi."]);
                }

                
            } catch (Exception $ex) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(["add" => "fail", "message" => $ex->getMessage()]);
            }
        }
    }
}
