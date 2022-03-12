<?php

$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../classes/tutors.php");
include_once($filepath."../../classes/subjects.php");
include_once($filepath."../../helpers/utilities.php");


$TTtopic = new Tutor();
$subjects = new Subject();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST) && !empty($_POST)) {
        $tutorOfTopic =  $TTtopic->getFilter($_POST);

        if ($tutorOfTopic->data) {
            while ($result = $tutorOfTopic->data->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0">
                <div class="card card-tutor" onclick=" location.href =\'' . 'tutor_details.php?id=' .  $result["id"] . ' \'">
                    <div class="card-img-top img-teacher pt-2 text-center">
                        <img src=" ' . Util::getCurrentURL() ."/../" . (isset($result['imagepath']) ?  $result['imagepath'] : "") . '" class="rounded" alt="" srcset="">
                    </div>
                    <div class="card-body">
                        <h6 class="font-weight-bold pt-1">' . $result['lastname'] . ' ' . $result['firstname'] . '</h6>';
                $subjectTutors = "";
                $subjectList = $subjects->getByTutorId($result['id']);
                while ($resultSB = $subjectList->fetch_assoc()) {
                    $subjectTutors .= $resultSB['subject'] . ', ';
                }

                $subjectTutors = substr($subjectTutors, 0, strlen(trim($subjectTutors)) - 1);

                echo  '<div class="text-muted description-intro">' . $result['teachingarea'] . ' | ' . $subjectTutors . '</div>
                        <div class="text-start description product">
                            <p>' . Format::textShorten($result['introduction'], 120) . '</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <div class="d-flex flex-row">
                                <a href="' . $result['linkfacebook'] . '" class="mx-1"><i class="fab fa-facebook fa-xl"></i></a>
                                <a href="' . (isset($result['linktwitter']) ?  $result['linktwitter'] : "") . '" class="mx-1"><i class="fab fa-twitter-square fa-xl"></i></a>
                            </div>
                            <div class="btn btn-primary">Đăng ký</div>
                        </div>
                    </div>
                </div>
            </div>';
            }

            echo ' <nav aria-label="Page navigation example " id="pagination-nav" class="mt-3">';
            echo $TTtopic->getPaginator($_POST);
            echo '</div>';
        }
        else echo "Không tìm thấy gia sư.";
    }
    else echo "Chọn môn học mới hiện chủ đề.";
}