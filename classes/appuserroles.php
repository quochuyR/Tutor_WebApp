<?php
namespace Classes;
use Helpers\Format;
use Library\Database;
$filepath  = realpath(dirname(__FILE__));
include_once($filepath."../../lib/database.php");
include_once($filepath."../../helpers/format.php");


class UserRole{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getRoleByUserId($userId)
    {
        $userId = Format::validation($userId);

        $userId = mysqli_real_escape_string($this->db->link, $userId);

        if(!empty($userId)){
            $query = "SELECT  `approles`.`name`
            FROM `appuserroles` INNER JOIN `approles` ON `appuserroles`.`roleId` = `approles`.`id`
            WHERE `appuserroles`.`userId` = ?;";

            $result = $this->db->p_statement($query, "s", [$userId]);
            return $result;
        }

        return false;
    }

    public function getTutorIdByRoles($RoleId, $userId)
    {
        $vars = array();
        $types= "";
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
