<?php

namespace Library;

use Helpers\Util;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../helpers/utilities.php");
class Session
{


    /**
     * Hàm có nhiệm vụ tạo mới session
     * @return void
     */
    public static function init(): void
    {

        if (version_compare(phpversion(), '8.2', "<=")) {
            // var_dump(session_id());
            if (empty(session_id())) {
                session_start();
                if (!isset($_SESSION["csrf_token"])) {
                    self::set("csrf_token", Util::csrf_token());
                }
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    /**
     * Hàm có nhiệm vụ lấy giá trị session dựa vào khoá
     * @param string $key khoá của session dùng để truy xuất giá trị
     * @return string|bool|array  giá trị của session ứng với khoá
     */
    public static function get(string $key): string | bool | array
    {

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return false;
    }

    /**
     * Hàm có nhiệm vụ đặt giá trị session dựa vào khoá
     * @param string $key khoá của sesion dùng để truy xuất giá trị
     * @param string|array|null $val giá trị của session
     * @return void
     */
    public static function set(string $key, string|array|null $val): void
    {
        $_SESSION[$key] = $val;
    }

    /**
     * Hàm có nhiệm vụ kiểm tra session (Đăng nhập hay chưa)
     * @return void chuyển đến trang login nếu chưa đăng nhập
     */
    public static function checkSession(): void
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("location:login.php");
        }
    }

    /**
     * Hàm có nhiệm vụ kiểm tra đăng nhập hay chưa
     * @return bool đăng nhập hay chưa
     */
    public static function checkLogin(): bool
    {
        self::init();

        if (self::get("login") == true) {
            return true;
        }
        return false;
    }

    /**
     * Hàm có nhiệm vụ kiểm tra quyền dựa vào session
     * @param array $role_allow những quyền cho phép
     * @return bool quyền phù hợp hay không
     */
    public static function checkRoles($role_allow): bool
    {
        // print_r($role_allow);


        // var_dump($_SESSION);
        if (self::checkLogin() && !empty(self::get("roles"))) {
            // if (!empty(self::get("roles"))) {
            // $roles = array();
            $roles = array();

            foreach (self::get("roles") as $value) { // nhớ lưu ý key và value của mảng
                // print_r($roles[]);

                array_push($roles, $value["name"]);
            }
            if(count(array_intersect($role_allow, ["user", "tutor", "admin"])) !== 0){
                foreach($roles as $role){
                
                    if(in_array($role, $role_allow)){
                        return true;
                    }
                }
            }
            

            
            
            return false;
            // if (count($roles) <= 1) {
            //     if (count(array_intersect($roles, $role_allow)) === count($roles)) {
            //         return true;
            //         //    print_r(array_diff($role_allow, $roles));
            //     }
            // } else {
            //     if (count(array_intersect($roles, $role_allow)) === count($role_allow)) {
            //         return true;
            //         //    print_r(array_diff($role_allow, $roles));
            //     }
            // }
        }



        return false;
    }

    public static function destroy()
    {

        session_unset();
        session_destroy();
        setcookie(session_name(), '', 0, '/');

        //    header("Location:");
    }
}

// echo microtime();
