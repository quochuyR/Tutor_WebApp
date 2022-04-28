<?php
namespace Classes;

use Library\Database;
use Helpers\Format;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
include_once($filepath."../../classes/paginator.php");

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

    public function createTutorSaved($userId, $tutorId)
    {
        $query = "INSERT INTO `savetutors` (`id`, `userId`, `tutorId`, `saveddate`) VALUES (NULL, ?, ?, NOW());";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }
    public function deleteTutorSaved($userId, $tutorId)
    {
        $query = "DELETE FROM `savetutors` WHERE `savetutors`.`userId` = ? AND `savetutors`.`tutorId` = ? ;";
        $results = $this->db->p_statement($query, "ss", [$userId, $tutorId]);

        return $results ? $results : false;
    }

    // bao gồm phân trang luôn
    public function getTutorSavedByUserId($userId, $request_method)
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
 
         $results  = $this->paginator->getData( $limit,$page );
        
        return $results;
    }

    // tạo link phân trang
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
