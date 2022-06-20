<?php

namespace Classes;

use Helpers\Format;
use Library\Database;

$filepath = realpath(dirname(__FILE__));

include_once $filepath . "../../lib/database.php";
include_once $filepath . "../../classes/paginator.php";

// include_once($filepath."../../helpers/format.php");

class TutoringSchedule
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

    public function AddTutoringSchedule($status, $registerId, $dayofweekId, $topicId,  $timeId)
    {
        $query = "";
        $types = "";
        $vars = array();

        if($dayofweekId !== null && $topicId !== null && $timeId !== null){
            $query = "CALL add_schedule_from_registered_user(?, ?, ?, ?, ?)";
            $types = "iiiii";
            $vars = [$status, $registerId, $dayofweekId, $topicId,  $timeId];
        }
        else{
            $query = "CALL add_schedule_from_registered_user(?, ?, NULL, NULL, NULL)";
            $types = "ii";
            $vars = [$status, $registerId];
        }
        $results = $this->db->p_statement($query, $types, $vars);

        return $results ? $results : false;
    }

    public function deleteTutoringSchedule($id)
    {
        $query = "DELETE FROM `scheduletutors` WHERE `scheduletutors`.`id` = ?;";
        $results = $this->db->p_statement($query, "i", [$id]);

        return $results ? $results : false;
    }
    
    public function updateTutoringSchedule($Id, $dayofweekId, $timeId, $subjectTopicId)
    {
        $query = "UPDATE `scheduletutors` 
        SET `dayofweekId`= ?,`topicId`= ?,`timeId`= ? 
        WHERE `scheduletutors`.`id` = ?;";
        $results = $this->db->p_statement($query, "iiii", [$dayofweekId, $subjectTopicId, $timeId, $Id]);

        return $results ? $results : false;
    }

    // bao gồm phân trang luôn
    public function getTutoringScheduleByTutorId($status, $tutorId, $request_method)
    {
        $types = "";
        $vars = array();
        $query = "SELECT DISTINCT `registeredusers`.`userId`
        FROM `scheduletutors` INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id` 
        WHERE `registeredusers`.`status` = ? AND `registeredusers`.`tutorId` = ?";

        $vars = array_merge($vars, [$status, $tutorId]);
        $types .= 'is';
        if (isset($request_method['day']) && is_numeric($request_method['day'])) {
            $day = $request_method['day'];
            
            
            $query .= " AND `scheduletutors`.`dayofweekId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$day]);
        }

        if (isset($request_method['subjectTopic']) && is_numeric($request_method['subjectTopic'])) {
            $subjectTopic = $request_method['subjectTopic'];
            
            
            $query .= " AND `scheduletutors`.`topicId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$subjectTopic]);
        }

        // lấy thời gian start and end
        if ((isset($request_method['endTime']) && is_numeric($request_method['endTime']))
        && (isset($request_method['startTime']) && is_numeric($request_method['startTime']))) {
            $endTime = $request_method['endTime'];
            $startTime = $request_method['startTime'];
            
            $query .= " AND ( `scheduletutors`.`timeId` BETWEEN ? AND ? )";
            // bind params
            $types .= 'ii';
            $vars = array_merge($vars, [$startTime, $endTime]);
        }
        // chỉ lấy thời gian start

        else if (isset($request_method['startTime']) && is_numeric($request_method['startTime'])) {
            $startTime = $request_method['startTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$startTime]);
        }
        // chỉ lấy thời gian end

        else if (isset($request_method['endTime']) && is_numeric($request_method['endTime'])) {
            $endTime = $request_method['endTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$endTime]);
        }

        if (isset($request_method['uid']) && !empty($request_method['uid'])) {
            $userId = $request_method['uid'];
            
            
            $query .= " AND `registeredusers`.`userId` = ?";
            // bind params
            $types .= 's';
            $vars = array_merge($vars, [$userId]);
        }

        

        // print_r($query);
        $limit = (isset($request_method['limit'])) ? Format::validation($request_method['limit']) : 3;
        $page = (isset($request_method['page'])) ? Format::validation($request_method['page']) : 1;

        $this->paginator->constructor($query, $types, $vars);

        $results = $this->paginator->getData($limit, $page);
        return $results;
    }

    // tạo link phân trang
    public function getPaginatorTutoringSchedule($request_method)
    {
        // paginator
        // echo $this->query;
        $links = (isset($request_method['links'])) ? Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinksAjax('pagination justify-content-center' ,$links );
    }

    // đếm xem có user hay không
    public function countRegisterUserByTutorId($tutorId)
    {
        $query = "SELECT COUNT(DISTINCT(`registeredusers`.`userId`)) as sum_register_user
        FROM `registeredusers`
        WHERE `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }

     // get lịch dạy ứng với người đã đăng ký (chỗ cái bảng)
     public function GetUserScheduleById($scheduleId){
        $query = "SELECT  `scheduletutors`.`id`, `dayofweeks`.`id` as dayofweekId, `dayofweeks`.`day`, `times`.`id` as timeId, `times`.`time`, `subjecttopics`.`topicName`, `subjecttopics`.`id` as subject_topicId
        FROM ((((`scheduletutors`  INNER JOIN `registeredusers` ON`registeredusers`.`id` = `scheduletutors`.`RegisteredId`)
              INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `scheduletutors`.`topicId`)
             
        WHERE `scheduletutors`.`id` = ?;";

        $results = $this->db->p_statement($query, "i", [$scheduleId]);

        return $results ? $results : false;


     }

    // get lịch dạy ứng với người đã đăng ký (chỗ cái bảng)
    public function GetTutoringSchedule_Tutor($tutorId, $userId, $status, $request_method)
    {
        $types = "";
        $vars = array();
        $query = "SELECT  `scheduletutors`.`id`, `dayofweeks`.`id` as dayofweekId, `dayofweeks`.`day`, `times`.`id` as timeId, `times`.`time`, `subjecttopics`.`topicName`, `subjecttopics`.`id` as subject_topicId
        FROM ((((`scheduletutors`  INNER JOIN `registeredusers` ON`registeredusers`.`id` = `scheduletutors`.`RegisteredId`)
              INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `scheduletutors`.`topicId`)
             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ? AND `registeredusers`.`status` = ?";
        $vars = array_merge($vars, [$tutorId, $userId, $status]);
        $types .= 'ssi';
        if (isset($request_method['day']) && is_numeric($request_method['day'])) {
            $day = $request_method['day'];
            
            
            $query .= " AND `scheduletutors`.`dayofweekId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$day]);
        }

        if (isset($request_method['subjectTopic']) && is_numeric($request_method['subjectTopic'])) {
            $subjectTopic = $request_method['subjectTopic'];
            
            
            $query .= " AND `scheduletutors`.`topicId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$subjectTopic]);
        }

        // lấy thời gian start and end
        if ((isset($request_method['endTime']) && is_numeric($request_method['endTime']))
        && (isset($request_method['startTime']) && is_numeric($request_method['startTime']))) {
            $endTime = $request_method['endTime'];
            $startTime = $request_method['startTime'];
            
            $query .= " AND ( `scheduletutors`.`timeId` BETWEEN ? AND ? )";
            // bind params
            $types .= 'ii';
            $vars = array_merge($vars, [$startTime, $endTime]);
        }
        // chỉ lấy thời gian start

        else if (isset($request_method['startTime']) && is_numeric($request_method['startTime'])) {
            $startTime = $request_method['startTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$startTime]);
        }
        // chỉ lấy thời gian end

        else if (isset($request_method['endTime']) && is_numeric($request_method['endTime'])) {
            $endTime = $request_method['endTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$endTime]);
        }

        $query .= " ORDER BY `scheduletutors`.`id` ASC";
        $results = $this->db->p_statement($query, $types, $vars);

        return $results ? $results : false;
    }

    /* Lịch dạy học user */

    // bao gồm phân trang luôn
    // lấy tutorId từ userId
    public function getTutoringScheduleByUserId($status, $userId, $request_method)
    {
        $types = "";
        $vars = array();
        $query = "SELECT DISTINCT `registeredusers`.`tutorId`, (SELECT `tutors`.`userId` FROM tutors WHERE `tutors`.`id` = `registeredusers`.`tutorId`) as userId
        FROM `registeredusers` INNER JOIN `scheduletutors` ON `registeredusers`.`id` = `scheduletutors`.`registeredId`
        WHERE `registeredusers`.`userId` = ? AND `registeredusers`.`status` = ?";

        $vars = array_merge($vars, [$userId, $status]);
        $types .= 'is';
        if (isset($request_method['day']) && is_numeric($request_method['day'])) {
            $day = $request_method['day'];
            
            
            $query .= " AND `scheduletutors`.`dayofweekId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$day]);
        }

        if (isset($request_method['subjectTopic']) && is_numeric($request_method['subjectTopic'])) {
            $subjectTopic = $request_method['subjectTopic'];
            
            
            $query .= " AND `scheduletutors`.`topicId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$subjectTopic]);
        }

        // lấy thời gian start and end
        if ((isset($request_method['endTime']) && is_numeric($request_method['endTime']))
        && (isset($request_method['startTime']) && is_numeric($request_method['startTime']))) {
            $endTime = $request_method['endTime'];
            $startTime = $request_method['startTime'];
            
            $query .= " AND ( `scheduletutors`.`timeId` BETWEEN ? AND ? )";
            // bind params
            $types .= 'ii';
            $vars = array_merge($vars, [$startTime, $endTime]);
        }
        // chỉ lấy thời gian start

        else if (isset($request_method['startTime']) && is_numeric($request_method['startTime'])) {
            $startTime = $request_method['startTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$startTime]);
        }
        // chỉ lấy thời gian end

        else if (isset($request_method['endTime']) && is_numeric($request_method['endTime'])) {
            $endTime = $request_method['endTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$endTime]);
        }

        if (isset($request_method['tuid']) && !empty($request_method['tuid'])) {
            $tutorId = $request_method['tuid'];
            
            
            $query .= " AND `registeredusers`.`tutorId` = ?";
            // bind params
            $types .= 's';
            $vars = array_merge($vars, [$tutorId]);
        }

        

        // print_r($query);
        $limit = (isset($request_method['limit'])) ? Format::validation($request_method['limit']) : 3;
        $page = (isset($request_method['page'])) ? Format::validation($request_method['page']) : 1;

        $this->paginator->constructor($query, $types, $vars);

        $results = $this->paginator->getData($limit, $page);
        return $results;
    }

    // tạo link phân trang
    public function getPaginatorUserSchedule($request_method)
    {
        // paginator
        // echo $this->query;
        $links = (isset($request_method['links'])) ? Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinksAjax('pagination justify-content-center', $links);
    }

    // đếm xem có gia sư hay không
    public function countTutoringScheduleByUserId($tutorId)
    {
        $query = "SELECT COUNT(DISTINCT(`registeredusers`.`userId`)) as sum_register_user
        FROM `registeredusers`
        WHERE `registeredusers`.`tutorId` = ?;";
        $results = $this->db->p_statement($query, "s", [$tutorId]);

        return $results ? $results : false;
    }

    // get lịch dạy ứng với người đã đăng ký (chỗ cái bảng)
    public function GetTutoringSchedule_User($tutorId, $userId, $status, $request_method)
    {
        $types = "";
        $vars = array();
        $query = "SELECT  `scheduletutors`.`id`, `dayofweeks`.`id` as dayofweekId, `dayofweeks`.`day`, `times`.`id` as timeId, `times`.`time`, `subjecttopics`.`topicName`, `subjecttopics`.`id` as subject_topicId
        FROM ((((`scheduletutors`  INNER JOIN `registeredusers` ON`registeredusers`.`id` = `scheduletutors`.`RegisteredId`)
              INNER JOIN `times` ON `scheduletutors`.`timeId` = `times`.`id`)
              INNER JOIN `dayofweeks` ON `scheduletutors`.`dayofweekId` = `dayofweeks`.`id`)
              INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `scheduletutors`.`topicId`)
             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ? AND `registeredusers`.`status` = ?";
        $vars = array_merge($vars, [$tutorId, $userId, $status]);
        $types .= 'ssi';
        if (isset($request_method['day']) && is_numeric($request_method['day'])) {
            $day = $request_method['day'];
            
            
            $query .= " AND `scheduletutors`.`dayofweekId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$day]);
        }

        if (isset($request_method['subjectTopic']) && is_numeric($request_method['subjectTopic'])) {
            $subjectTopic = $request_method['subjectTopic'];
            
            
            $query .= " AND `scheduletutors`.`topicId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$subjectTopic]);
        }

        // lấy thời gian start and end
        if ((isset($request_method['endTime']) && is_numeric($request_method['endTime']))
        && (isset($request_method['startTime']) && is_numeric($request_method['startTime']))) {
            $endTime = $request_method['endTime'];
            $startTime = $request_method['startTime'];
            
            $query .= " AND ( `scheduletutors`.`timeId` BETWEEN ? AND ? )";
            // bind params
            $types .= 'ii';
            $vars = array_merge($vars, [$startTime, $endTime]);
        }
        // chỉ lấy thời gian start

        else if (isset($request_method['startTime']) && is_numeric($request_method['startTime'])) {
            $startTime = $request_method['startTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$startTime]);
        }
        // chỉ lấy thời gian end

        else if (isset($request_method['endTime']) && is_numeric($request_method['endTime'])) {
            $endTime = $request_method['endTime'];
            
            
            $query .= " AND `scheduletutors`.`timeId` = ?";
            // bind params
            $types .= 'i';
            $vars = array_merge($vars, [$endTime]);
        }

        $query .= " ORDER BY `scheduletutors`.`id` ASC";
        $results = $this->db->p_statement($query, $types, $vars);

        return $results ? $results : false;
    }

    /**
     * Đếm xem gia sư đã lên lịch dạy cho người dùng hay chưa
     */
   
    public function count_tutor_has_schedule_for_user($userId, $tutorId, $status)
    {
        $query = "SELECT COUNT(*) AS has_schedule
        FROM `registeredusers` AS r INNER JOIN `scheduletutors` AS s ON r.id = s.registeredId
        WHERE r.userId = ? AND r.tutorId = ? AND r.status = ?;";
        $results = $this->db->p_statement($query, "ssi", [$userId, $tutorId, $status]);

        return $results ? $results : false;
    }
    
}
