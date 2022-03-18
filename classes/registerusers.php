<?php
namespace Classes;

use Library\Database;
use Helpers\Format;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
include_once($filepath."../../classes/paginator.php");

// include_once($filepath."../../helpers/format.php");

class RegisterUser
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

    public function createRegisterUser($userId, $tutorId, $TopicId)
    {
        $query = "INSERT INTO `registeredusers` (`id`, `userId`, `tutorId`, `topicId`, `RegistrationDate`, `status`) VALUES (NULL, ?, ?, ?, NOW(), b'0')";
        $results = $this->db->p_statement($query, "sss", [$userId, $tutorId, $TopicId]);

        return $results ? $results : false;
    }
    public function deleteRegisterUser($userId, $tutorId, $register_userID)
    {
        $query = "DELETE FROM `registeredusers` WHERE `registeredusers`.`userId` = ?  AND `registeredusers`.`tutorId` = ? AND `registeredusers`.`id`  = ? ;";
        $results = $this->db->p_statement($query, "ssi", [$userId, $tutorId, $register_userID]);

        return $results ? $results : false;
    }

    // bao gồm phân trang luôn
    
    public function getRegisterUserByTutorId($tutorId, $request_method)
    {
        $query = "SELECT DISTINCT `tutors`.`id`, `appusers`.`firstname`, `appusers`.`lastname`, `tutors`.`teachingarea`, `appusers`.`job`, `appusers`.`imagepath`, `savetutors`.`saveddate`
                    FROM ((`tutors` INNER JOIN `appusers` ON `tutors`.`tutorId` = `appusers`.`id`)
                          INNER JOIN `savetutors` ON `savetutors`.`tutorId` = `tutors`.`id`)
                    WHERE `tutors`.`id` IN (
                                            SELECT`savetutors`.`tutorId`
                                            FROM   `savetutors` 
                                            WHERE `savetutors`.`tutorId` = ?)";
         $limit      = (isset($request_method['limit']))  ? Format::validation($request_method['limit']) : 3;
         $page       = (isset($request_method['page'])) ?  Format::validation($request_method['page']) : 1;
 
 
         $this->paginator->constructor($query, "s", [$tutorId]);
 
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
