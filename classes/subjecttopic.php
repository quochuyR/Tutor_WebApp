<?php

namespace Classes;

use Library\Database;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
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

    /**
     * Hàm có nhiệm vụ thêm thông tin môn học
     * @param int $subject_id id của môn học
     * @param array $subject_name_array tên của chủ đề môn học
     * @return object|bool sô chủ đề môn học được thêm thành công
     */
    public function add_subject_topic($subject_id, $subject_topic_name_array): object|bool
    {
        $subjectTopicCount = count($subject_topic_name_array);
        // create a array with question marks
        $subjectTopicMarks = array_fill(0, $subjectTopicCount, '(NULL, ?, ?)');
        $subjectTopicMarks =  implode(",", $subjectTopicMarks);
        $dataTypes = str_repeat('is', $subjectTopicCount);

        $vars = array();

        foreach ($subject_topic_name_array as $topic_name) {
            array_push($vars, $subject_id, $topic_name);
        }
        // print_r($subjectTopicMarks);
        // print_r($vars);
        // print_r($dataTypes);
        $query = "INSERT INTO `subjecttopics` (`id`, `subjectId`, `topicName`) VALUES $subjectTopicMarks;";

        // print_r($query);
        $result = $this->db->p_statement($query, $dataTypes, $vars);
        return $result;
        // return false;
    }

    /**
     * Hàm có nhiệm vụ cập nhật thông tin chủ đề môn học dựa vào id
     * @param int $id id của môn học
     * @param string $subject tên của môn học
     * @return object|bool sô môn học được cập nhật thành công
     */
    public function update_subject_subject($id, $subjectId, $topic_name): object|bool
    {
        $query = "UPDATE `subjecttopics` st SET st.subjectId= ?,st.topicName=? WHERE st.id = ?;";
        $result = $this->db->p_statement($query, "isi", [$subjectId, $topic_name, $id]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ xoá chủ đề môn học dựa vào id 
     * @param array|int $id id của chủ đề môn học
     * @return object|bool sô môn học đã xoá thành công
     */
    public function delete_subject_topic(array|int $id): object|bool
    {
        $vars = array();
        $types = "";
        $idMarks = null;
        if (is_array($id)) {
            $id = array_map(function ($v) {
                return mysqli_real_escape_string($this->db->link, $v);
            }, $id);

            $idCount = count($id);
            // create a array with question marks
            $idMarks = array_fill(0, $idCount, '?');
            $idMarks =  implode(",", $idMarks);
            $dataTypes = str_repeat('i', $idCount);
            $types .= $dataTypes;
            $vars = array_merge($vars, $id);
        }

        if (is_numeric($id)) {
            $id =  mysqli_real_escape_string($this->db->link, $id);


            $types = "i";
            $vars = array_merge($vars, [$id]);
            $idMarks = '?';
        }

        $query = "DELETE FROM `subjecttopics` WHERE `subjecttopics`.`id` IN ($idMarks);";
        $result = $this->db->p_statement($query, $types,  $vars);
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
        GROUP BY `subjectId`, `subject` ORDER BY sum_topic DESC;";
        $result = $this->db->select($query);
        return $result;
    }

    public function CountByTutor()
    {
        $query = "SELECT s.id, s.subject, COUNT(DISTINCT ts.tutorId) as sum_tutor
        FROM (((subjecttopics t INNER JOIN subjects s
        ON t.subjectId = s.id)
        INNER JOIN teachingsubjects ts on t.id = ts.topicId)
		INNER JOIN tutors tu ON ts.tutorId = tu.id)
        WHERE tu.tutor_status = 1
        GROUP BY s.id, s.subject ORDER BY sum_tutor DESC;";
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

    public function countAllTutorRegisteredTopic()
    {
        $query = "SELECT  COUNT(DISTINCT `teachingsubjects`.`tutorId`) as sum_all_tutor
        FROM `subjecttopics` 
        INNER JOIN `teachingsubjects` on `subjecttopics`.`id` = `teachingsubjects`.`topicId`;";
        $result = $this->db->select($query);
        return $result;
    }

    // 

    public function getTopic_TutoringSchedule($tutorId, $status)
    {
        $query = "SELECT DISTINCT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM ((`scheduletutors` INNER JOIN `subjecttopics` ON `scheduletutors`.`topicId` = `subjecttopics`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`tutorId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$tutorId, $status]);

        return $results ? $results : false;
    }

    public function getTopic_registerUser($tutorId, $userId)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ?  
        ORDER BY `subjecttopics`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$tutorId, $userId]);

        return $results ? $results : false;
    }

    public function getTopic_registerUser_ByStatus($tutorId, $userId, $status)
    {
        $query = "SELECT DISTINCT `subjecttopics`.`id`, `subjecttopics`.`topicName` , (SELECT COUNT(*) FROM `scheduletutors` WHERE `scheduletutors`.`registeredId` = `registeredusers`.`id`) AS approval
        FROM `registeredusers` INNER JOIN `subjecttopics` ON `registeredusers`.`topicId` = `subjecttopics`.`id`             
        WHERE `registeredusers`.`tutorId` = ? AND `registeredusers`.`userId` = ? AND `registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
        $results = $this->db->p_statement($query, "sii", [$tutorId, $userId, $status]);

        return $results ? $results : false;
    }

    /* User */

    public function getTopic_UserSchedule($userId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName`
        FROM ((`scheduletutors` INNER JOIN `subjecttopics` ON `scheduletutors`.`topicId` = `subjecttopics`.`id`)
              INNER JOIN `registeredusers` ON `scheduletutors`.`RegisteredId` = `registeredusers`.`id`)
        WHERE `registeredusers`.`userId` = ? AND 	`registeredusers`.`status` = ?
        ORDER BY `subjecttopics`.`id` ASC;";
        $results = $this->db->p_statement($query, "si", [$userId, $status]);

        return $results ? $results : false;
    }

    // lấy chủ đề mà người dùng đã đăng ký hay chưa đăng ký
    public function getTopic_registeredUser($tutorId, $userId, $status)
    {
        $query = "SELECT `subjecttopics`.`id`, `subjecttopics`.`topicName` 
        FROM `teachingsubjects` INNER JOIN `subjecttopics` ON `subjecttopics`.`id` = `teachingsubjects`.`topicId`
        WHERE  `teachingsubjects`.`tutorId` = ? 
        AND `teachingsubjects`.`topicId` ";

        if ($status == 1) {
            $query .= " IN (SELECT `registeredusers`.`topicId` 
            FROM `registeredusers`
            WHERE `registeredusers`.`userId` = ? 
            AND `registeredusers`.`tutorId` = ?)";
        }
        if ($status == 0) {
            $query .= " NOT IN (SELECT `registeredusers`.`topicId` 
            FROM `registeredusers`
            WHERE `registeredusers`.`userId` = ? 
            AND `registeredusers`.`tutorId` = ?)";
        }

        $query .= " ORDER BY `subjecttopics`.`id` ASC;";
       
        // print_r($query);
        $results = $this->db->p_statement($query, "sss", [$tutorId, $userId, $tutorId]);

        return $results ? $results : false;
    }


    public function getSubjectByQuery($method, $subId)
    {
        $query = "SELECT  `subjects`.`id` as subId, `subjecttopics`.`id` as topicId, `subjecttopics`.`topicName`,  `subjects`.`subject`  
        FROM `subjecttopics` INNER JOIN `subjects` ON `subjecttopics`.`subjectId` = `subjects`.`id`";
        $q = "";
        $results = null;
        if (isset($method['q']) && !empty($method['q'])) {

            $q = $method["q"];
            $results = $this->db->select($query);
        }
        if (isset($method['num']) && !empty($method['num'])) {
            $query .= " WHERE `subjecttopics`.`topicName` LIKE  CONCAT('%',?,'%') AND `subjecttopics`.`subjectId` = ?";
            $query .= " ORDER BY `subjects`.`id` ASC;";
            $results = $this->db->p_statement($query, "si", [$q, $subId]);
        }



        return $results ? $results : false;
    }
}
