<?php

namespace Classes;

use Library\Session, Library\Database;
use Helpers\Format;
use Classes\UserRole, Classes\AppUser, Classes\Remember;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/session.php");
Session::checkLogin();
include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");
include_once($filepath . "../../classes/appuserroles.php");
include_once($filepath . "../../classes/appusers.php");
include_once($filepath . "../../classes/remember.php");


class AdminLogin
{

    private $db;
    private $user_role;
    private $user;
    private $remember;
    public function __construct()
    {
        $this->db = new Database();
        $this->user_role = new UserRole();
        $this->user = new AppUser();
        $this->remember = new Remember();
    }


    /**
     * Hàm có nhiệm vụ đăng nhập vào hệ thống (dành cho cả người dùng, gia sư và người quản trị)
     * @param string $username tài khoản người dùng
     * @param string $password mật khẩu người dùng
     * @param bool $remember nhớ đăng nhập hay không
     * @return bool đăng nhập thành công hay không
     */

    public function login_admin(string $username, string $password, bool $remember = false): bool
    {
        $username = Format::validation($username);
        $password = Format::validation($password);
        $remember = Format::validation($remember);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $remember = mysqli_real_escape_string($this->db->link, $remember);

        if (!empty($username) && !empty($password)) {
            // $query = "SELECT id, username, lastname, firstname, imagepath 
            // FROM `appusers` 
            // WHERE username = ? and PASSWORD = md5(?) LIMIT 1";
            $user = $this->user->find_user_by_username($username)->fetch_assoc();

            // $result = $this->db->p_statement($query, "ss", [$username, $password]);
            if ($user) {
                $result = password_verify($password, $user["password"]);
                if (isset($result) && $result) {

                    $this->is_user_logged_in($user);

                    if ($remember) {
                        $this->remember->remember_me($user["id"]);
                    }
                    return true;
                }
            } else {

                header('Content-Type: application/json; charset=UTF-8');
                echo json_encode(array("login" => "fail-user-pass", "message" => "Tài khoản hoặc mật khẩu không đúng")); // 1001 : ERROR_USERNAME_PASSWORD_INCORRECT
                return false;
            }
        } else {

            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(array('message' => 'Tài khoản hoặc mật khẩu trống')); // 1000 : ERROR_USERNAME_PASSWORD_EMPTY
            return false;
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ kiểm tra người dùng đã nhập hay chưa. Nếu có thêm thông tin người dùng vào session
     * @param array $user mảng chứa thông tin người dùng (username, password, firstname, lastname ...)
     * @return bool thêm vào session thành công hay không
     */
    public function is_user_logged_in(array $user): bool
    {
        $roles = $this->user_role->getRoleByUserId($user["id"])->fetch_all(MYSQLI_ASSOC);


        $tutor = $this->user_role->getTutorIdByRoles([2, 3], $user["id"])->fetch_assoc();

        Session::set("login", true);
        Session::set("userId", $user["id"]);
        Session::set("roles", $roles);
        if ($tutor) Session::set("tutorId", $tutor["id"]);
        Session::set("username", $user["username"]);
        Session::set("lastname", $user["lastname"]);
        Session::set("firstname", $user["firstname"]);
        Session::set("imagepath", $user["imagepath"]);

        return true;
    }
}
