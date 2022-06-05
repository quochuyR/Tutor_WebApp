<?php

namespace Classes;

use Library\Database;

$filepath  = realpath(dirname(__FILE__));

include_once($filepath . "../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class AppUser
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    /**
     * Hàm có nhiệm vụ tạo mới người dùng (dành cho người dùng)
     * @param string $first_name Họ người dùng
     * @param string $last_name Tên người dùng
     * @param string $email Email người dùng
     * @param string $phone_number số điện thoại người dùng
     * @param string $username tài khoản người dùng
     * @param string $password mật khẩu người dùng
     * @return object số lượng hàng thêm thành công
     */

    public function create_new_user(string $username, string $email, string $password, string $last_name, string $first_name, string $phone_number): object
    {
        $query = "INSERT INTO `appusers`
         VALUES (UUID(), ?, ?, ?, ?, ?, NULL, ?, NULL, NULL, NULL, NULL, current_timestamp());";

        $result = $this->db->p_statement($query, "ssssss", [$username, $email, $password, $last_name, $first_name, $phone_number]);
        return $result;
    }
    /**
     * hàm có nhiệm vụ cập nhật thông tin người dùng(dành cho user)
     * @param string $email tên email của người dùng
     * @param string $last_name họ người dùng
     * @return object|bool số lượng hàng cập nhật thành công
     */

    public function update_user($id, $email, $last_name, $first_name,  $sex, $phonenumber, $date_of_birth, $address, $job): object| bool
    {
        $query = "UPDATE `appusers` SET `email`=?,`lastname`=?,`firstname`=?,`sex`=?,`phonenumber`=?,`dateofbirth`=?,`address`=?,`job`=? WHERE id=? ;";

        $result = $this->db->p_statement($query, "sssisssss", [$email, $last_name, $first_name, $sex, $phonenumber, $date_of_birth, $address, $job, $id]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ tìm user id bằng username
     * @param string $username tài khoản người dùng
     * @return object id của người dùng tìm được
     */
    public function find_user_id_by_username(string $username): object
    {
        $query = "SELECT id
        FROM `appusers` 
        WHERE username = ?;";

        $result = $this->db->p_statement($query, "s", [$username]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ tìm thông tin người dùng dựa vào username
     * @param string $username tài khoản người dùng
     * @return object thông tin người dùng nếu tìm thành công
     */
    public function find_user_by_username(string $username): object
    {
        $query = "SELECT id, username, password, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`imagepath` 
        FROM `appusers` 
        WHERE username = ?;";

        $result = $this->db->p_statement($query, "s", [$username]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ lấy thông tin người dùng dựa vào id người dùng
     * @param string $userId id người dùng
     * @return object thông tin người dùng
     */

    public function getInfoByUserId($userId): object
    {
        $query = "SELECT  `appusers`.`id`, `appusers`.`username`, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`phonenumber`,  `appusers`.`sex`, `appusers`.`job`, `appusers`.`address`, `appusers`.`dateofbirth`, `appusers`.`email`,  `appusers`.`imagepath`
        FROM  `appusers` 
        WHERE `appusers`.`id` = ?;";

        $result = $this->db->p_statement($query, "s", [$userId]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ đếm tổng số lượng người dùng   
     * @return object số lượng người dùng
     */

    public function countAll(): object
    {
        $query = "SELECT  count(*) as num_user
        FROM  `appusers` 
        WHERE 1";

        $result = $this->db->select($query);
        return $result;
    }

    public function getNumUserByMonth()
    {
        $query = "SELECT MONTHNAME(`appusers`.`datecreated`) AS month, COUNT(*) AS num
        FROM `appusers`
        GROUP BY MONTHNAME(`appusers`.`datecreated`);";

        // echo $query;
        $result = $this->db->select($query);
        return $result;
    }
}
