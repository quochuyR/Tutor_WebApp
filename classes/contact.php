<?php

namespace Classes;

use Library\Database;
use Helpers\Format;

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/database.php");
// include_once($filepath . "../../classes/paginator.php");

// include_once($filepath."../../helpers/format.php");

class SavedTutor
{
    private $db;
    private $paginator;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        $this->paginator = new Paginator();
        // $this->fm = new Format();
    }

    /**
     * Hàm có nhiệm vụ đếm xem có bao nhiêu gia sư đã lưu
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool số lượng gia sư đã lưu
     */
    public function countTutorSaved(string $userId, string $tutorId): object | bool
    {
        $query = "SELECT COUNT(*) as numTutor FROM `savetutors` 
        WHERE `savetutors`.`userId` = ? AND `savetutors`.`tutorId` = ?";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lưu mới gia sư
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool số lượng gia sư lưu thành công
     */
    public function createTutorSaved(string $userId, string $tutorId): object | bool
    {
        $query = "INSERT INTO `savetutors` (`id`, `userId`, `tutorId`, `saveddate`) VALUES (NULL, ?, ?, NOW());";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ xoá gia sư đã lưu
     * @param string $userId id người dùng
     * @param string $tutorId id gia sư
     * @return object|bool số lượng xoá gia sư đã lưu  thành công
     */
    public function deleteTutorSaved(string $userId, string $tutorId): object | bool
    {
        $query = "DELETE FROM `savetutors` WHERE `savetutors`.`userId` = ? AND `savetutors`.`tutorId` = ? ;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin gia sư đã lưu dựa vào id người dùng (bao gồm phân trang)
     * @param string $userId id người dùng
     * @param array $request_method mảng chứa dữ liệu post phân trang (limit, page)
     * @return object|bool thông tin gia sư
     */
    public function getTutorSavedByUserId(string $userId, array $request_method)
    {
        $query = "SELECT DISTINCT `tutors`.`id`, `appusers`.`firstname`, `appusers`.`lastname`, `tutors`.`teachingarea`, `appusers`.`job`, `appusers`.`imagepath`, `savetutors`.`saveddate`
        FROM ((`tutors` INNER JOIN `appusers` ON `tutors`.`userId` = `appusers`.`id`)
              INNER JOIN `savetutors` ON `savetutors`.`tutorId` = `tutors`.`id`)
        WHERE  EXISTS (
                                SELECT DISTINCT `savetutors`.`tutorId`
                                FROM   `savetutors` 
                                WHERE `savetutors`.`tutorId` = `tutors`.`id` AND `tutors`.`id` = `savetutors`.`tutorId`) AND  `savetutors`.`userId` = ?";
        $limit      = (isset($request_method['limit']))  ? Format::validation($request_method['limit']) : 3;
        $page       = (isset($request_method['page'])) ?  Format::validation($request_method['page']) : 1;


        $this->paginator->constructor($query, "s", [$userId]);

        $results  = $this->paginator->getData($limit, $page);

        return $results;
    }

    /**
     * Hàm có nhiệm vụ tạo link phân trang dựa vào dữ liệu cung cấp từ hàm getTutorSavedByUserId
     * @param array $request_method mảng chứa dữ liệu post phân trang (links)
     * @return string chuỗi chứa đoạn html phân trang
     */
    public function getPaginatorSavedTT($request_method)
    {
        // paginator
        // echo $this->query;
        $links      = (isset($request_method['links'])) ?  Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinks($links, 'pagination justify-content-center');
    }
    // đếm xem có gia sư hay không
    public function countTutorSavedByUserId($userId, $tutorId)
    {
        $query = "SELECT COUNT(*) as hasTutor FROM `savetutors`
        WHERE `savetutors`.`userId` = ? and `savetutors`.`tutorId` = ?";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }
}
