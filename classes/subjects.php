<?php

$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Subject
{
    private $db;
    // private $fm;
    public function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function getAll()
    {
        $query = "SELECT * FROM `subjects` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getByTutorId($tutorId)
    {
        $query = "SELECT distinct `subjects`.`subject`
        FROM (((`tutors` INNER JOIN `teachingsubjects`
                ON `tutors`.`id` = `teachingsubjects`.`tutorId`)
                INNER JOIN `subjecttopics`
                ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`)
                INNER JOIN `subjects` ON `subjects`.`id` = `subjecttopics`.`subjectId`)
                WHERE `tutors`.`id` = '" . $tutorId . "' ORDER BY `subjects`.`subject` ASC";
        $result = $this->db->select($query);
        return $result;
    }
}
