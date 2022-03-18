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
}
