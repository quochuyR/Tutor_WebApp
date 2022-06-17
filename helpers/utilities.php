<?php

namespace Helpers;

require_once(__DIR__ . "../../config/app.php");
class Util
{


    public static function getCurrentURL($level = 0)
    {
        $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $currentURL .= $_SERVER["SERVER_NAME"];

        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
            $currentURL .= ":" . $_SERVER["SERVER_PORT"];
        }

        // $currentURL .= $_SERVER["REQUEST_URI"];
        $path_self_array = preg_split("/\//", dirname($_SERVER["PHP_SELF"]));
        $path_self = "";
        for ($i = 0; $i < count($path_self_array) - $level; $i++) {
            $path_self .= $path_self_array[$i] . "/";
        }

        $currentURL .= $path_self;
        return $currentURL;
    }
    public static function getRootURL()
    {
        $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $currentURL .= $_SERVER["SERVER_NAME"];

        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
            $currentURL .= ":" . $_SERVER["SERVER_PORT"];
        }

        // $currentURL .= $_SERVER["REQUEST_URI"];
        // $currentURL .= dirname($_SERVER["PHP_SELF"]);
        return $currentURL;
    }


    public static function redirect_to(string $url): void
    {
        header('Location:' . $url);
        exit();
    }

    public static function redirect_with(string $url, array $items): void
    {
        foreach ($items as $key => $value) {
            $_SESSION[$key] = $value;
        }
    
        self::redirect_to($url);
    }

    public static function redirect_with_message(string $url, string $message, string $type = Flash::FLASH_SUCCESS)
    {
        Flash::flash('flash_' . $type, $message, $type);
        self::redirect_to($url);
    }

    public static function csrf_token(): string
    {
        return bin2hex(random_bytes(32));
    }





   
}
