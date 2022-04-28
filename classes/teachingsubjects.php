<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class TeachingSubject
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function insertTeachingSubjects($tutorId, $subjectId)
    {
        $query = "INSERT INTO `teachingsubjects` 
        VALUES (NULL, ?, ?);";

        $results =  $this->db->p_statement($query, "si", [$tutorId, $subjectId]);

        return $results ? $results : false;
    }

    public function getTopicByTutorId($tutorId)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM `teachingsubjects` INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`
        WHERE `teachingsubjects`.`tutorId` = ?;";

        $results =  $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }
    
    public function GetRegisteredUserTopic($userId, $tutorId)
    {
        $query = "SELECT DISTINCT `subjecttopics`.`id`, `subjecttopics`.`topicName`, `registeredusers`.`status`
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

}