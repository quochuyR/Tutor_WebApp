<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class SubjectTopic 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function getAll()
    {
        $query = "SELECT * FROM `subjecttopics` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTopicBySubjectId($subjectId)
    {
        $query = "SELECT distinct topicName, `subjecttopics`.`id`, `subjects`.`id` as subjectId
        FROM ((`subjecttopics` INNER JOIN `subjects` 
        on `subjecttopics`.`subjectId` = `subjects`.`id`)
        INNER JOIN `teachingsubjects` ON `teachingsubjects`.`topicId` = `subjecttopics`.`id`)
        WHERE `subjects`.`id` = $subjectId";
        $result = $this->db->select($query);
        return $result;
    }

    public function CountBySubject()
    {
        $query = "SELECT `subjectId`, `subject`, COUNT(*) as sum_topic
        FROM ((`subjecttopics` INNER JOIN `subjects`
        ON `subjecttopics`.`subjectId` = `subjects`.`id`)
        INNER JOIN `teachingsubjects` on `subjecttopics`.`id` = `teachingsubjects`.`topicId`)
        GROUP BY subject ORDER BY sum_topic DESC;";
        $result = $this->db->select($query);
        return $result;
    }

    public function CountAll()
    {
        $query = "SELECT COUNT(*) as sum_all
        FROM ((`subjecttopics` INNER JOIN `subjects`
        ON `subjecttopics`.`subjectId` = `subjects`.`id`)
        INNER JOIN `teachingsubjects` on `subjecttopics`.`id` = `teachingsubjects`.`topicId`)";
        $result = $this->db->select($query);
        return $result;
    }

    // 

    public function getTopic_TutoringSchedule($tutorId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM ((`scheduletutors` INNER JOIN `subjecttopics` ON `scheduletutors`.`topicId` = `subjecttopics`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
       $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

       return $results ? $results : false;
    }

    public function getTopic_registerUser($tutorId, $userId)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ?  
        ORDER BY `subjecttopics`.`id` ASC;";
       $results = $this->db->p_statement($query, "si", [$tutorId, $userId]);

       return $results ? $results : false;
    }

    public function getTopic_registerUser_ByStatus($tutorId, $userId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName` , (SELECT COUNT(*) FROM `scheduletutors` WHERE `scheduletutors`.`registeredId` = `registeredusers`.`id`) AS approval
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ? AND `registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
       $results = $this->db->p_statement($query, "sii", [$tutorId, $userId, $status]);

       return $results ? $results : false;
    }

    /* User */

    public function getTopic_UserSchedule($userId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM ((`scheduletutors` INNER JOIN `subjecttopics` ON `scheduletutors`.`topicId` = `subjecttopics`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`userId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
       $results = $this->db->p_statement($query, "si", [$userId, $status]);

       return $results ? $results : false;
    }

    // lấy chủ đề mà người dùng đã đăng ký hay chưa đăng ký
    public function getTopic_registeredUser($tutorId, $userId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName` 
        FROM `teachingsubjects` INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`
        WHERE  `teachingsubjects`.`tutorId` = ? 
        AND `teachingsubjects`.`topicId`  NOT IN (SELECT `registeredusers`.`topicId` 
                                                   FROM `registeredusers`
                                                   WHERE `registeredusers`.`userId` = ? 
                                                   AND `registeredusers`.`tutorId` = ?)
        ORDER BY `subjecttopics`.`id` ASC;";

        if($status == 1){
            $query = str_replace("NOT IN", "IN", $query);
        }
        
        // print_r($query);
       $results = $this->db->p_statement($query, "sss", [$tutorId, $userId, $tutorId]);

       return $results ? $results : false;
    }


}
