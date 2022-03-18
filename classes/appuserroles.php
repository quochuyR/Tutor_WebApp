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
}
