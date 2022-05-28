<?php

namespace Classes;

use Helpers\Format;
use Library\Database;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");


class UserRole
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Hàm có nhiệm vụ thêm quyền cho người dùng (dành cho cả người dùng, gia sư và người quản trị)
     * @param string $userId id người dùng
     * @param int $roleId id quyền (1: admin, 2: tutor, 3: user)
     * @return object | bool thêm quyền thành công hay không
     */
    public function add_user_role(string $userId, int $roleId): object | bool
    {

        $userId = Format::validation($userId);
        $roleId = Format::validation($roleId);

        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $roleId = mysqli_real_escape_string($this->db->link, $roleId);
        if (!empty($userId) && is_numeric($roleId)) {
            $query = "INSERT INTO `appuserroles` 
            VALUES (NULL, ?, ?);";

            $result = $this->db->p_statement($query, "si", [$userId, $roleId]);
            return $result;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ lấy quyền người dùng bằng id người dùng (dành cho cả người dùng, gia sư và người quản trị)
     * @param string $userId id người dùng
     * @return object | bool thêm quyền thành công hay không
     */

    public function getRoleByUserId(string $userId): object | bool
    {
        $userId = Format::validation($userId);

        $userId = mysqli_real_escape_string($this->db->link, $userId);

        if (!empty($userId)) {
            $query = "SELECT  `approles`.`name`
            FROM `appuserroles` INNER JOIN `approles` ON `appuserroles`.`roleId` = `approles`.`id`
            WHERE `appuserroles`.`userId` = ?;";

            $result = $this->db->p_statement($query, "s", [$userId]);
            return $result;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ lấy id gia sư bằng quyền
     * @param string $userId id người dùng
     * @param array $RoleId mảng chứa id quyền (1: admin, 2: tutor, 3: user)
     * @return object | bool lấy id gia sư thành công hay không
     */
    public function getTutorIdByRoles(array $RoleId, string $userId): object|bool
    {
        $vars = array();
        $types = "";
        $typeCount = count($RoleId);
        // create a array with question marks
        $typeMarks = array_fill(0, $typeCount, '?');
        $typeMarks = implode(",", $typeMarks);
        $dataTypes = str_repeat('i', $typeCount);
        $types .= $dataTypes; // bind param roleID
        $types .= 's'; // bind param UserID

        $vars = array_merge($RoleId, [$userId]);

        // print_r($vars);
        // print_r($types);
        $query = "SELECT DISTINCT `tutors`.`id`
        FROM ((`appusers` INNER JOIN `appuserroles` ON `appusers`.`id` = `appuserroles`.`userId`)
          INNER JOIN `tutors` ON `tutors`.`userId` = `appusers`.`id`)
         WHERE `appuserroles`.`roleId` IN ($typeMarks) AND `appusers`.`id` = ?;";
        $results = $this->db->p_statement($query, $types, $vars);
        // $results = $this->db->p_statement($query, "is", [$RoleId, $UserId]);

        return $results ? $results : false;
    }
}
