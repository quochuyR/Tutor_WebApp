<?php

namespace Classes;

use Library\Database;
use mysqli;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
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
}
