<?php
namespace Ajax;
use Helpers\Util, Helpers\Format;

use Classes\Tutor, Classes\Subject;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../classes/tutors.php");
include_once($filepath . "../../classes/subjects.php");
include_once($filepath . "../../helpers/utilities.php");


$TTtopic = new Tutor();
$subjects = new Subject();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {
        $tutorOfTopic =  $TTtopic->getFilter($_POST);
        ?>
         <div class="col-12 pt-md-0 pb-2">
                    <div class=" d-flex align-items-center views justify-content-end">
                        <span class="btn text-success me-3">
                            <span class="fas fa-th px-md-2 px-1 ">

                            </span>
                            <span>Dạng lưới</span>
                        </span>
                        <span class="green-label px-md-2 px-2 "><?= $tutorOfTopic->data->num_rows ?> gia sư

                    </div>
                </div>
                <?php

        if ($tutorOfTopic->data) {
            while ($result = $tutorOfTopic->data->fetch_assoc()) {
?>
               

                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0">
                    <div class="card card-tutor" onclick=" location.href ='  <?= "tutor_details.php?id=" . $result['id']  ?> '; ">
                        <div class=" card-img-top img-teacher text-center">
                            <img src=" <?= Util::getCurrentURL() . "/../public/" . (isset($result['imagepath']) ? $result['imagepath'] : "") ?>" class="rounded" alt="" srcset="">
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold pt-1"><?= $result['lastname'] . ' ' . $result['firstname'] ?></h6>
                            <?php
                            $subjectTutors = "";
                            $subjectList = $subjects->getByTutorId($result['id']);
                            while ($resultSB = $subjectList->fetch_assoc()) {
                                $subjectTutors .= $resultSB['subject'] . ', ';
                            }

                            $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);
                            ?>

                            <div class="text-muted description-intro"><?= $result['teachingarea'] . ' | ' . $subjectTutors ?></div>
                            <div class="text-start description product">
                                <p><?= Format::textShorten($result['introduction'], 120) ?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-1">
                                <div class="d-flex flex-row">
                                    <a href="<?= $result['linkfacebook'] ?>" class="mx-1"><i class="fab fa-facebook fa-xl"></i></a>
                                    <a href="<?= (isset($result['linktwitter']) ? $result['linktwitter'] : "") ?>" class="mx-1"><i class="fab fa-twitter-square fa-xl"></i></a>
                                </div>
                                <!-- <div class="btn btn-primary">Đăng ký</div> -->
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }

            echo ' <nav aria-label="Page navigation example " id="pagination-nav" class="mt-3">';
            echo $TTtopic->getPaginator($_POST);
            echo '</div>';
        } else echo "Không tìm thấy gia sư.";
    } else echo "Chọn môn học mới hiện chủ đề.";
}
