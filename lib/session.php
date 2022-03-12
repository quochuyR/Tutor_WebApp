<?php

class Session
{
    public static function init()
    {
        if (version_compare(phpversion(), '8.2', "<=")) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function get($key)
    {

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return false;
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("location:login.php");
        }
    }

    public static function checkLogin()
    {
        self::init();

        if (self::get("login") == true) {
            return true;
        }
    }

    public static function destroy()
    {
        
        session_unset();
        session_destroy();
        setcookie(session_name(),'',0,'/');
        
        //    header("Location:");
    }
}


// echo microtime();
