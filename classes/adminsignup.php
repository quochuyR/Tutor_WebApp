<?php

namespace Classes;

use Library\Session, Library\Database;
use Helpers\Format;
use Classes\UserRole, Classes\AppUser;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/session.php");
Session::checkLogin();
include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");
include_once($filepath . "../../classes/appuserroles.php");
include_once($filepath . "../../classes/appusers.php");


class AdminSignUp
{

    private $db;
    private $user_role;
    private $user;
    public function __construct()
    {
        $this->db = new Database();
        $this->user_role = new UserRole();
        $this->user = new AppUser();
    }


    /**
     * Hàm có nhiệm vụ thêm thông tin người dùng đăng ký (chỉ dành cho người dùng)
     * @param string $first_name Họ người dùng
     * @param string $last_name Tên người dùng
     * @param string $email Email người dùng
     * @param string $phone_number số điện thoại người dùng
     * @param string $username tài khoản người dùng
     * @param string $password mật khẩu người dùng
     * @return bool đăng kí thành công hay không
     */
    public function sign_up_admin(string $first_name, string $last_name, string $email, string $phone_number, string $username, string $password): bool
    {
        $first_name = mysqli_real_escape_string($this->db->link, $first_name);
        $last_name = mysqli_real_escape_string($this->db->link, $last_name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone_number = mysqli_real_escape_string($this->db->link, $phone_number);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        // check is empty
        if (
            !empty($first_name) && !empty($last_name) && !empty($email)
            && !empty($phone_number) && !empty($username) && !empty($password)
        ) {
            // hash password
            $hash_password = password_hash($password, PASSWORD_ARGON2I);
            // create new user
            $create_new = $this->user->create_new_user($username, $email, $hash_password, $last_name, $first_name, $phone_number);
            if ($create_new) { // create success
                // get userId from username
                $userId = $this->user->find_user_id_by_username($username)->fetch_assoc()["id"];

                if (!empty($userId)) {
                    // add user role
                    $this->user_role->add_user_role($userId, 3);
                    return true;
                }
            }
        }

        return false;
    }
}
