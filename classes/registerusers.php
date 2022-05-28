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

    /**
     * Hàm có nhiệm vụ thêm hoặc xoá người dùng đã đăng ký (chỉ dành cho gia sư)
     * @param int $action thêm hay xoá (1: thêm, 0: xoá)
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool số lượng người dùng thêm hoặc xoá thành công
     */
    public function AddOrDeleteRegisterTutor(int $action, string $userId, string $tutorId, int $TopicId): object| bool
    {
        $query = "CALL add_delete_register_tutor(?, ?, ?, ?)";
        $results = $this->db->p_statement($query, "issi", [$action, $userId, $tutorId, $TopicId]);

        return $results->num_rows > 0 ? $results : false;
    }


    /**
     * Hàm có nhiệm vụ lấy thông tin người dùng dựa vào id gia sư (bao gồm phân trang luôn. Chỉ dành cho gia sư)
     * @param int $tutorId id gia sư
     * @param string $request_method mảng chứa dữ liệu post phân trang (limit, page)
     * @return object thông tin người dùng
     */
    public function getRegisteredUserByTutorId(string $tutorId, array $request_method): object
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

    /**
     * Hàm có nhiệm vụ tạo link phân trang dựa vào dữ liệu cung cấp từ hàm getRegisteredUserByTutorId
     * @param array $request_method mảng chứa dữ liệu post phân trang (links)
     * @return string chuỗi chứa đoạn html phân trang
     */
    public function getPaginatorRegisteredUser(array $request_method): string
    {
        // paginator
        // echo $this->query;
        $links = (isset($request_method['links'])) ? Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinks($links, 'pagination justify-content-center');
    }

    /**
     * Hàm có nhiệm vụ đếm số lượng người dùng đăng ký (chỉ dành cho gia sư)
     * @param string $tutorId id gia sư
     * @return object số lượng người dùng đăng ký
     */
    public function countRegisteredUserByTutorId(string $tutorId): object
    {
        $query = "SELECT COUNT(DISTINCT(`registeredusers`.`userId`)) as sum_register_user
        FROM `registeredusers`
        WHERE `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin chủ đề môn học mà người dùng đã đăng ký
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object thông tin chủ đề đăng kí 
     */
    public function GetRegisteredUserTopic(string $userId, string $tutorId): object
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`, (SELECT COUNT(*) FROM `scheduletutors` WHERE `scheduletutors`.`registeredId` = `registeredusers`.`id`) AS approval
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ đặt trạng thái người dùng là đã được gia sư chấp nhận dạy
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool số lượng trạng thái chấp nhận thành công
     */
    public function ApprovalRegisteredUser(string $userId, string $tutorId): object | bool
    {
        $query = "UPDATE `registeredusers` SET `status`= ? WHERE `userId` = ? AND `tutorId` = ?;";
        $results = $this->db->p_statement($query, "iss", [1, $userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy trạng thái chấp nhận dạy từ người dùng đã đăng ký
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool trạng thái chập nhận dạy hay chưa (0: chưa chấp nhận, 1: đã chấp nhân)
     */
    public function GetApprovalRegisteredUser(string $userId, string $tutorId): object | bool
    {
        $query = "SELECT `registeredusers`.`status` FROM `registeredusers` WHERE `userId` = ? AND `tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy id của người dùng đăng ký ứng với môn học
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @param int $topicId id chủ đề
     * @param int $status trạng thái đã duyệt người dùng đăng kí hay chưa (0: chưa chấp nhận, 1: đã chấp nhân)
     * @return object|bool id của người đăng ký
     */
    public function GetRegisterIdByTopicId(string $userId, string $tutorId, int $topicId, int $status): object | bool
    {
        $query = "SELECT `registeredusers`.`id` 
        FROM `registeredusers`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?
        AND `registeredusers`.`topicId`= ? AND `registeredusers`.`status` = ?;";
        $results = $this->db->p_statement($query, "ssii", [$userId, $tutorId, $topicId, $status]);

        return $results ? $results : false;
    }

    /* user */

    /**
     * Hàm có nhiệm vụ đếm xem người dùng có đăng ký gia sư nào hay không
     * @param string $userId id người dùng
     * @return object|bool số lượng gia đã sư đăng ký
     */
    public function countRegisteredTutorByUserId(string $userId): object | bool
    {
        $query = "SELECT COUNT(DISTINCT(`registeredusers`.`tutorId`)) as sum_register_tutor
        FROM `registeredusers`
        WHERE `registeredusers`.`userId` = ?;";
        $results = $this->db->p_statement($query, "s", [$userId]);

        return $results ? $results : false;
    }
    
    /**
     * Hàm có nhiệm vụ đếm xem người dùng có đăng ký gia sư nào hay không dựa vào id gia sư
     * @param string $userId id người dùng
     * @param string $tutorId id người dùng
     * @return object|bool số lượng gia sư đã đăng ký
     */
    public function countRegisteredUsersWithTutor($userId, $tutorId)
    {
        $query = "SELECT COUNT(*) as registered_tutor
                    FROM `registeredusers` 
                    WHERE  `registeredusers`.`userId` = ? AND `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

   /**
     * Hàm có nhiệm vụ lấy thông tin người dùng dựa vào id người dùng (bao gồm phân trang luôn. Chỉ dành cho người dùng)
     * @param int $userId id người dùng
     * @param string $request_method mảng chứa dữ liệu post phân trang (limit, page)
     * @return object thông tin người dùng
     */
    public function getRegisteredTutorByUserId($userId, $request_method)
    {
        $query = "SELECT `appusers`.`id`, `tutors`.`id` as tutorId, `appusers`.`lastname`, `appusers`.`firstname`, `appusers`.`imagepath`, `tutors`.`currentjob`
        FROM `appusers` INNER JOIN `tutors` ON `appusers`.`id` = `tutors`.`userId`
        WHERE `tutors`.`id` IN (
            SELECT `registeredusers`.`tutorId`
            FROM `registeredusers`
            WHERE `registeredusers`.`userId` = ?)";
        $limit = (isset($request_method['limit'])) ? Format::validation($request_method['limit']) : 3;
        $page = (isset($request_method['page'])) ? Format::validation($request_method['page']) : 1;

        $this->paginator->constructor($query, "s", [$userId]);

        $results = $this->paginator->getData($limit, $page);

        return $results;
    }

    /**
     * Hàm có nhiệm vụ tạo link phân trang dựa vào dữ liệu cung cấp từ hàm getRegisteredUserByTutorId
     * @param array $request_method mảng chứa dữ liệu post phân trang (links)
     * @return string chuỗi chứa đoạn html phân trang
     */
    public function getPaginatorRegisteredTutor($request_method)
    {
        // paginator
        // echo $this->query;
        $links = (isset($request_method['links'])) ? Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinks($links, 'pagination justify-content-center');
    }
}
