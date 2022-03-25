<?php

namespace Classes;

use Helpers\Format;
use Library\Database;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/database.php";
include_once $filepath . "../../classes/paginator.php";

// include_once($filepath."../../helpers/format.php");

class RegisterUser
{
    private $db;
    private $paginator;
    // private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->paginator = new Paginator();
        // $this->fm = new Format();
    }

    public function AddRegisterUser($userId, $tutorId, $TopicId)
    {
        $query = "INSERT INTO `registeredusers` (`id`, `userId`, `tutorId`, `topicId`, `RegistrationDate`, `status`) VALUES (NULL, ?, ?, ?, NOW(), b'0')";
        $results = $this->db->p_statement($query, "sss", [$userId, $tutorId, $TopicId]);

        return $results ? $results : false;
    }
    public function deleteRegisteredUser($userId, $tutorId, $register_userID)
    {
        $query = "DELETE FROM `registeredusers` WHERE `registeredusers`.`userId` = ?  AND `registeredusers`.`tutorId` = ? AND `registeredusers`.`id`  = ? ;";
        $results = $this->db->p_statement($query, "ssi", [$userId, $tutorId, $register_userID]);

        return $results ? $results : false;
    }

    // bao gồm phân trang luôn
    public function getRegisteredUserByTutorId($tutorId, $request_method)
    {
        $query = "SELECT `appusers`.`id`, `appusers`.`lastname`, `appusers`.`firstname`, `appusers`.`imagepath`, `appusers`.`job` 
        FROM `appusers`
        WHERE `appusers`.`id` IN (
            SELECT `registeredusers`.`userId`
            FROM `registeredusers`
            WHERE `registeredusers`.`tutorId` = ?)";
        $limit = (isset($request_method['limit'])) ? Format::validation($request_method['limit']) : 3;
        $page = (isset($request_method['page'])) ? Format::validation($request_method['page']) : 1;

        $this->paginator->constructor($query, "s", [$tutorId]);

        $results = $this->paginator->getData($limit, $page);

        return $results;
    }

    // tạo link phân trang
    public function getPaginatorRegisteredUser($request_method)
    {
        // paginator
        // echo $this->query;
        $links = (isset($request_method['links'])) ? Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinks($links, 'pagination justify-content-center');
    }

    // đếm xem có gia sư hay không
    public function countRegisteredUserByTutorId($tutorId)
    {
        $query = "SELECT COUNT(DISTINCT(`registeredusers`.`userId`)) as sum_register_user
        FROM `registeredusers`
        WHERE `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }

    public function GetRegisteredUserTopic($userId, $tutorId)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`, (SELECT COUNT(*) FROM `scheduletutors` WHERE `scheduletutors`.`registeredId` = `registeredusers`.`id`) AS approval
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    // Duyệt dạy kèm người dùng đã đăng ký
    public function ApprovalRegisteredUser($userId, $tutorId)
    {
        $query = "UPDATE `registeredusers` SET `status`= ? WHERE `userId` = ? AND `tutorId` = ?;";
        $results = $this->db->p_statement($query, "iss", [1, $userId, $tutorId]);

        return $results ? $results : false;
    }

    // Lấy người dùng đã duyệt dạy kèm hay chưa
    public function GetApprovalRegisteredUser($userId, $tutorId)
    {
        $query = "SELECT `registeredusers`.`status` FROM `registeredusers` WHERE `userId` = ? AND `tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    // Lấy người id của register ứng với môn học
    public function GetRegisterIdByTopicId($userId, $tutorId, $topicId, $status)
    {
        $query = "SELECT `registeredusers`.`id` 
        FROM `registeredusers`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?
        AND `registeredusers`.`topicId`= ? AND `registeredusers`.`status` = ?;";
        $results = $this->db->p_statement($query, "ssii", [$userId, $tutorId, $topicId, $status]);

        return $results ? $results : false;
    }
}
