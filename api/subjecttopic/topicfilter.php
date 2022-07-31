<?php

namespace Ajax;

use Exception;
use Helpers\Format;
use Classes\SubjectTopic;

$filepath  = realpath(dirname(__FILE__));

require_once(__DIR__ . "../../../vendor/autoload.php");

// include_once($filepath."../../classes/subjecttopics.php");
// include_once($filepath."../../helpers/format.php");

$SBtopic = new SubjectTopic();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['subject']) && !empty($_POST['subject'])) {
        try {
            $subject = Format::validation($_POST['subject']);


            $subjectOfTopic =  $SBtopic->getTopicBySubjectId($subject);


            if ($subjectOfTopic) {

                while ($result = $subjectOfTopic->fetch_assoc()) {
                    echo '<div class="form-inline d-flex align-items-center py-1"> <label 
                class="tick " data-category="' . $result["subjectId"] . '" data-value="' . $result["topicName"] . '">' . $result["topicName"] . '<input
                    type="checkbox" class="topic checkbox-filter" value="' . $result["id"] . '"> <span class="check"></span> </label> </div>';
                }
            } else {
                echo "Chọn môn học mới hiện chủ đề.";
            }
        } catch (Exception $ex) {
            print_r($ex->getMessage());
        }
    } else echo "Chọn môn học mới hiện chủ đề.";
}
