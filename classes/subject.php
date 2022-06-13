<?php

namespace Classes;

use Library\Database;
use mysqli;

// $filepath  = realpath(dirname(__FILE__));

// include_once($filepath . "../../lib/database.php");
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

    /**
     * Hàm có nhiệm vụ lấy thông tin môn học
     * @return object thông tin môn học
     */
    public function getAll(): object
    {
        $query = "SELECT * FROM `subjects` ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin môn học dựa vào id gia sư
     * @param string $tutorId id của gia sư
     * @return object thông tin môn học
     */
    public function getByTutorId(string $tutorId)
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

    /**
     * Hàm có nhiệm vụ cập nhật thông tin môn học dựa vào id môn học
     * @param int $id id của môn học
     * @param string $subject tên của môn học
     * @return object|bool sô môn học được cập nhật thành công
     */
    public function update_subject(int $id, string $subject): object|bool
    {
        $query = "UPDATE `subjects` SET `subject`=? WHERE `subjects`.`id` = ?;";
        $result = $this->db->p_statement($query, "si", [$subject, $id]);
        return $result;
    }


    /**
     * Hàm có nhiệm vụ thêm thông tin môn học
     * @param array $subject tên của môn học
     * @return object|bool sô môn học được thêm thành công
     */
    public function add_subject(array $subject): object|bool
    {
        $subjectCount = count($subject);
        // create a array with question marks
        $subjectMarks = array_fill(0, $subjectCount, '(NULL, ?)');
        $subjectMarks =  implode(",", $subjectMarks);
        $dataTypes = str_repeat('s', $subjectCount);

        // print_r($subjectMarks);
        // print_r($dataTypes);
        $query = "INSERT INTO `subjects` (`id`, `subject`) VALUES $subjectMarks;";

        // print_r($query);
        $result = $this->db->p_statement($query, $dataTypes, $subject);
        return $result;
    }



    /**
     * Hàm có nhiệm vụ xoá thông tin môn học dựa vào id môn học
     * @param array|int $id id của môn học
     * @return object|bool sô môn học đã xoá thành công
     */
    public function delete_subject(array|int $id): object|bool
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

        $query = "DELETE FROM `subjects` WHERE `subjects`.`id` IN ($idMarks);";
        $result = $this->db->p_statement($query, $types,  $vars);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin môn học có trong chủ đề môn học (select2)
     * @param array $method phương thức post $_POST
     * @return object|bool thông tin buổi (sáng, chiều, tối)
     */
    public function getSubjectJoinTopicByQuery($method)
    {
        $query = "SELECT DISTINCT  s.`id`, s.`subject`  
        FROM  `subjects` s INNER JOIN `subjecttopics` st ON s.id = st.subjectId";
        $q = "";
        $results = null;
        if (isset($method['q']) && !empty($method['q'])) {

            $q = $method["q"];
            $results = $this->db->select($query);
        }
        if (isset($method['num']) && !empty($method['num'])) {
            $query .= " WHERE s.`subject` LIKE  CONCAT('%',?,'%')";
            $query .= " ORDER BY s.`id` ASC;";
            $results = $this->db->p_statement($query, "s", [$q]);
        }



        return $results ? $results : false;
    }

    /**
     * Hàm có nhiệm vụ chỉ lấy thông tin môn học  (select2)
     * @param array $method phương thức post $_POST
     * @return object|bool thông tin buổi (sáng, chiều, tối)
     */
    public function getSubjectByQuery($method)
    {
        $query = "SELECT DISTINCT  s.`id`, s.`subject`  
        FROM  `subjects` AS s";
        $q = "";
        $results = null;
        if (isset($method['q']) && !empty($method['q'])) {

            $q = $method["q"];
            $results = $this->db->select($query);
        }
        if (isset($method['num']) && !empty($method['num'])) {
            $query .= " WHERE s.`subject` LIKE  CONCAT('%',?,'%')";
            $query .= " ORDER BY s.`id` ASC;";
            $results = $this->db->p_statement($query, "s", [$q]);
        }



        return $results ? $results : false;
    }
}
