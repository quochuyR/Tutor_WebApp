<?php
namespace Helpers;

class Util
{
    public static function getCurrentURL($level=0)
    {
        $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $currentURL .= $_SERVER["SERVER_NAME"];

        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
            $currentURL .= ":" . $_SERVER["SERVER_PORT"];
        }

        // $currentURL .= $_SERVER["REQUEST_URI"];
        $path_self_array = preg_split("/\//", dirname($_SERVER["PHP_SELF"]));
        $path_self = "";
        for($i=0; $i < count($path_self_array) - $level;$i ++ ){
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

    public static function csrf_token(): string
    {
        return bin2hex(random_bytes(32));
    }
}
