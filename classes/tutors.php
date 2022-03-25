<?php
namespace Classes;

use Library\Database;
use Helpers\Format;
// use Model\Tutor_Model;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");
include_once($filepath . "../../classes/paginator.php");

class Tutor
{
    private $db;
    private $fm;
    private $query;
    private $paginator;
    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        $this->paginator = new Paginator();
    }

    public function getAll()
    {
        $query = 'SELECT `tutors`.`id`,  `appusers`.`username`, `appusers`.`firstname`, `appusers`.`lastname`, `tutors`.`CURRENTADDRESS`, `tutors`.`teachingarea`, `tutors`.`introduction`, `tutors`.`linkfacebook`, `tutors`.`linktwitter`, `appusers`.`imagepath`
        FROM `tutors` INNER JOIN `appusers`  ON `tutors`.`userId` = `appusers`.`id`
        WHERE `tutors`.`tutor_status` = 1 LIMIT 0, 3';
        $result = $this->db->select($query);
        return $result;
    }

    public function countAll()
    {
        $query = "SELECT COUNT(*) AS count_tutors FROM `tutors`
        WHERE `tutors`.`tutor_status` = 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function addTutor($Tutor_Model)
    {
        $query = "INSERT INTO `tutors` (`id`, `userId`, `introduction`, `CURRENTADDRESS`, `college`, `CURRENTJOB`, `teachingform`, `teachingarea`, `linkfacebook`, `linktwitter`, `tutor_status`) 
        VALUES (UUID(),?,?,?,?,?,?,?,?,?);";
        // $result = $this->db->p_statement($query, "sssssisss", [$Tutor_Model->_userId, $Tutor_Model->__introduction, $Tutor_Model->_currentAddress, $Tutor_Model->_college, $Tutor_Model->_currentJob, $Tutor_Model->_teachingForm, $Tutor_Model->_teachingArea, $Tutor_Model->_linkFacebook, $Tutor_Model->_linkTwitter]);
        $result = $this->db->p_statement($query, "sssssisss", $Tutor_Model);
        return $result;
    }

    public function getFilter($request_method)
    {
        // print_r($request_method);
        // Filter
        $types = "";
        $vars = array();





        // query filter
        $this->query = "SELECT DISTINCT `tutors`.`id`, `appusers`.`firstname`, `appusers`.`lastname`, `tutors`.`CURRENTADDRESS`, `tutors`.`teachingarea`, `tutors`.`introduction`, `tutors`.`linkfacebook`, `tutors`.`linktwitter`, `appusers`.`imagepath`
             FROM (((`tutors` INNER JOIN `appusers`  ON `tutors`.`userId` = `appusers`.`id`)
                  INNER JOIN  `teachingsubjects` ON `teachingsubjects`.`tutorId` = `tutors`.`id`)
                  INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`)
                  WHERE `tutors`.`tutor_status` = ?";
        $types = "i";
        $vars[] = 1;
        if (isset($request_method['subject']) && is_numeric($request_method['subject'])) {
            $subject = Format::validation($request_method['subject']);
            $subject = $this->db->link->real_escape_string($request_method['subject']);

            if ($subject != 0) {
                $this->query .= " AND `subjecttopics`.`subjectId` = ?";
                $types .= "i";
                $vars[] = $subject;
            }
            // bind params 


        }

        if (isset($request_method['topic']) && !empty($request_method['topic'])) {
            $topic = $request_method['topic'];
            // echo "topic là: " . count($topic) . "<br>";
            $topicCount = count($topic);
            // create a array with question marks
            $topicMarks = array_fill(0, $topicCount, '?');
            $topicMarks =  implode(",", $topicMarks);
            $dataTypes = str_repeat('i', $topicCount);
            $this->query .= " AND `teachingsubjects`.`topicId` IN ($topicMarks)";
            // bind params
            $types .= $dataTypes;
            $vars = array_merge($vars, $topic);
        }

        if (isset($request_method['status']) &&  !empty($request_method['status'])) {
            $status = $request_method['status'];

            $statusCount = count($status);
            // create a array with question marks
            $statusMarks = array_fill(0, $statusCount, '?');
            $statusMarks =  implode(",", $statusMarks);
            $dataTypes = str_repeat('i', $statusCount);
            $this->query .= " AND `tutors`.`teachingform` IN ($statusMarks)";
            // bind params
            $types .= $dataTypes;
            $vars = array_merge($vars,  $status);
        }

        if (isset($request_method['sex']) &&  !empty($request_method['sex'])) {
            $sex = $request_method['sex'];

            $sexCount = count($sex);
            // create a array with question marks
            $sexMarks = array_fill(0, $sexCount, '?');
            $sexMarks =  implode(",", $sexMarks);
            $dataTypes = str_repeat('i', $sexCount);

            $this->query .= " AND `appusers`.`sex` IN ($sexMarks)";
            // bind params
            $types .= $dataTypes;
            $vars = array_merge($vars, $sex);
        }

        if (isset($request_method['type']) && !empty($request_method['type'])) {
            $type = $request_method['type'];
            // $type = $this->db->link->real_escape_string($request_method['type']);

            $typeCount = count($type);
            // create a array with question marks
            $typeMarks = array_fill(0, $typeCount, '?');
            $typeMarks =  implode(",", $typeMarks);
            $dataTypes = str_repeat('s', $typeCount);
            $this->query .= " AND `tutors`.`currentjob` IN ($typeMarks)";
            // bind params
            $types .= $dataTypes;
            $vars = array_merge($vars, $type);
        }
        // echo $types;


        // $result = $this->db->p_statement($this->query, $types,   $vars );


        // return $result;

        // pagination

        $limit      = (isset($request_method['limit']))  ? Format::validation($request_method['limit']) : 3;
        $page       = (isset($request_method['page'])) ?  Format::validation($request_method['page']) : 1;

       
        $this->paginator->constructor($this->query, $types, $vars);

        $results  = $this->paginator->getData($limit, $page);

        return $results;
    }

    public function getTutorDetail($id)
    {
        $query = "SELECT `tutors`.`id`, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`username`, `appusers`.`sex`, `appusers`.`phonenumber`, `appusers`.`email`, `tutors`.`CURRENTJOB`, `tutors`.`CURRENTADDRESS`, `tutors`.`teachingarea`, `tutors`.`introduction`, `tutors`.`linkfacebook`, `tutors`.`linktwitter`, `appusers`.`imagepath` 
        FROM `tutors` INNER JOIN `appusers` ON `tutors`.`userId` = `appusers`.`id` 
        WHERE `tutors`.`tutor_status` = 1 and `tutors`.`id` = ?";

        // echo $query;
        $result = $this->db->p_statement($query, "s", [$id]);
        return $result;
    }



    public function getPaginator($request_method)
    {
        // paginator
        // echo $this->query;
        $links      = (isset($request_method['links'])) ?  Format::validation($request_method['links']) : 3;
        return $this->paginator->createLinksAjax($links, 'pagination justify-content-center');
    }
}
