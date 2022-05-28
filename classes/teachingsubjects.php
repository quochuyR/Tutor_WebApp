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

    /**
     * Hàm có nhiệm vụ thêm chủ đề môn học cho gia sư
     * @param string $tutorId id gia sư
     * @param string $subjectId trạng thái gia sư đã duyệt hay chưa (0: chưa duyệt, 1: đã duyệt)
     * @return object|bool số lượng chủ đề môn học gia sư  được thêm thành công
     */
    public function insertTeachingSubjects($tutorId, $subjectId): object|bool
    {
        $query = "INSERT INTO `teachingsubjects` 
        VALUES (NULL, ?, ?);";

        $results =  $this->db->p_statement($query, "si", [$tutorId, $subjectId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin chủ đề môn học mà gia sư dạy dựa vào id gia sư
     * @param string $tutorId id gia sư
     * @return object|bool  thông tin chủ đề môn học mà gia sư dạy
     */
    public function getTopicByTutorId($tutorId): object|bool
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM `teachingsubjects` INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`
        WHERE `teachingsubjects`.`tutorId` = ?;";

        $results =  $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }
    
    /**
     * Hàm có nhiệm vụ lấy thông tin chủ đề môn học mà người dùng đăng ký với gia sư
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool  thông tin chủ đề môn học mà người dùng đăng ký với gia sư
     */
    public function GetRegisteredUserTopic($userId, $tutorId)
    {
        $query = "SELECT DISTINCT `subjecttopics`.`id`, `subjecttopics`.`topicName`, `registeredusers`.`status`
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

}