<?php

namespace Library;
use mysqli;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath."../../config/config.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Database
{
    public  $host = DB_HOST;
    public  $user = DB_USER;
    public  $pass = DB_PASS;
    public  $dbname = DB_NAME;

    public  $link;
    public  $error;


    public function __construct()
    {
        $this->connectDB();
    }

    public  function connectDB()
    {
        $this->link =  new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if (!$this->link) {
            $this->error = "Connection fail " . $this->link->connect_error;
            return false;
        }
    }

    public function select($query)
    {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);

        if($result->num_rows > 0){
            return $result;
        }

        return false;
    }

    public  function p_statement($query,  $type = "", $vars = [])
    {

        $stm = $this->link->prepare($query);        

        // type là i: int, d: double, float, s: string, b: blob 
        array_unshift($vars, $type);

        // thêm tham chiếu vào vì bind param yều cầu các tham số phải là tham chiếu
        foreach ($vars as $key => $value) {
            $vars[$key] = &$vars[$key];
        }

        call_user_func_array(array($stm, 'bind_param'), $vars);
        $stm->execute() or die($this->link->error.__LINE__);

        

        //INSERT, SELECT, UPDATE và DELETE có 6 kí tự, you can
        //validate it using substr() below for better and faster performance
        if (strtolower(substr($query, 0, 6)) === "select") {
            $result = $stm->get_result();
        } else {
            $result = $stm->affected_rows;
        }

        $stm->close();
        if($result)
            return $result;

        return false;

        
    }
}
