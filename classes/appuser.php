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
     * @return object|bool số lượng hàng thêm thành công
     */

    public function create_new_user(
        string $username,
        string $email,
        string $password,
        string $last_name,
        string $first_name,
        string $phone_number,
        string $activation_code,
        string $expiry
    ): object|bool {
        $query = "INSERT INTO `appusers`
         VALUES (UUID(), ?, ?, ?, ?, ?, NULL, ?, NULL, NULL, NULL, NULL, current_timestamp(), 0, ?, ?, current_timestamp());";

        $result = $this->db->p_statement($query, "ssssssss", [$username, $email, $password, $last_name, $first_name, $phone_number, $activation_code, $expiry]);
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
     * hàm có nhiệm vụ cập nhật hình ảnh người dùng(dành cho user)
     * @param string $id id của người dùng
     * @param string $image hình ảnh người dùng
     * @return object|bool số lượng hàng cập nhật thành công
     */

    public function update_image_user($id, $new_image): object| bool
    {
        $query = "UPDATE `appusers` SET `imagepath`= ? WHERE `id` = ?;";

        $result = $this->db->p_statement($query, "ss", [$new_image, $id]);
        return $result;
    }

    /**
     * hàm có nhiệm vụ cập nhật người dùng đã kích hoạt email
     * @param string $user_id id của người dùng
     * @return object|bool số lượng hàng cập nhật thành công
     */
    function activate_user(string $user_id): bool
    {
        $sql = 'UPDATE appusers
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id = ? ';

        $result = $this->db->p_statement($sql, "s", [$user_id]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ xoá người dùng không kích hoạt
     * @param string $id id người dùng
     * @param string $active trạng thái kích hoạt
     * @return object|bool xoá người dùng thành công
     */

    public function delete_user_by_id(int $id, int $active = 0): object| bool
    {
        $query = "DELETE FROM `appusers` WHERE id = ? AND active = ?";

        $result = $this->db->p_statement($query, "si", [$id, $active]);
        return $result;
    }


    /**
     * Hàm có nhiệm vụ tìm người dùng không kích hoạt và xoá
     * @param string $activation_code code xác thực của người dùng
     * @param string $email email người dùng
     * @return object|bool xoá người dùng nếu chưa kích hoạt (lớn hơn 1 ngày) hoặc trả về người dùng chưa kích hoạt
     */
    function find_unverified_user(string $activation_code, string $email)
    {

        $sql = 'SELECT id, activation_code, activation_expiry < now() as expired
        FROM appusers
        WHERE active = 0 AND email= ?';

        $result = $this->db->p_statement($sql, "s", [$email]);


        $user = $result->fetch_assoc();

        if ($user) {
            // already expired, delete the in active user with expired activation code
            if ((int)$user['expired'] === 1) {
                $this->delete_user_by_id($user['id']);
                return null;
            }
            // verify the password
            if (password_verify($activation_code, $user['activation_code'])) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Hàm có nhiệm vụ tìm user id bằng username
     * @param string $username tài khoản người dùng
     * @return object|bool id của người dùng tìm được
     */
    public function find_user_id_by_username(string $username): object|bool
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
        $query = "SELECT id, username, password, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`imagepath`, active
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
        $query = "SELECT  `appusers`.`id`, `appusers`.`username`, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`phonenumber`,  `appusers`.`sex`, `appusers`.`job`, `appusers`.`address`,  `appusers`.`email`,  `appusers`.`imagepath`, `appusers`.`dateofbirth`
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

    public function check_column_unique($column, $value)
    {
        $query = "SELECT COUNT(*) AS has_unique FROM `appusers` AS u";
        if ($column === "email") {
            $query .= " WHERE u.email = ?";
        }

        if ($column === "username") {
            $query .= " WHERE u.username = ?";
        }

        if ($column === "phonenumber") {
            $query .= " WHERE u.phonenumber = ?";
        }

        $result = $this->db->p_statement($query, "s", [$value]);
        return $result;
    }
}
