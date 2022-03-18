<?php
namespace Classes;

use Library\Session, Library\Database;
use Helpers\Format;
use Classes\UserRole;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath."../../lib/session.php");
Session::checkLogin();
include_once($filepath."../../lib/database.php");
include_once($filepath."../../helpers/format.php");
include_once($filepath."../../classes/appuserroles.php");


class AdminLogin{

    private $db;
    private $user_role;
    public function __construct()
    {
        $this->db = new Database();
        $this->user_role = new UserRole();
    }

    public function login_admin($username, $password)
    {
        $username = Format::validation($username);
        $password = Format::validation($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if(!empty($username) && !empty($password)){
            $query = "SELECT id, username, lastname, firstname, imagepath 
            FROM `appusers` 
            WHERE username = ? and PASSWORD = md5(?) LIMIT 1";

            $result = $this->db->p_statement($query, "ss", [$username, $password]);

            if($result){
                $value = $result->fetch_assoc();

                $roles = $this->user_role->getRoleByUserId($value["id"])->fetch_all(MYSQLI_ASSOC);
                // print_r($roles);
                Session::set("login", true);
                Session::set("userId", $value["id"]);
                Session::set("roles", $roles);

                Session::set("username", $value["username"]);
                Session::set("lastname", $value["lastname"]);
                Session::set("firstname", $value["firstname"]);
                Session::set("imagepath", $value["imagepath"]);
                // header("location:.././inc/header.php");
                return true;
                
                // echo "đăng nhập thành công";
            }
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'TÀI KHOẢN HOẶC MẬT KHẨU KHÔNG ĐÚNG', 'code' => 1001))); // 1001 : ERROR_USERNAME_PASSWORD_INCORRECT
            return false;
        }
        else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'TÀI KHOẢN HOẶC MẬT KHẨU TRỐNG', 'code' => 1000))); // 1000 : ERROR_USERNAME_PASSWORD_EMPTY
            return false;
        }

        return false;
    }
}
