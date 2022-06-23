<?php

namespace Library;
use mysqli;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath."../../config/config.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Change character set to utf8

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

    /**
     * Hàm có nhiệm vụ tạo kết nối đến csdl
     * @return bool kết nối thành công hay không
     */
    public function connectDB(): bool
    {
        $this->link =  new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        $this->link->set_charset("utf8");
        if (!$this->link) {
            $this->error = "Connection fail " . $this->link->connect_error;
            return false;
        }

        return true;
    }

    /**
     * Hàm có nhiệm vụ truy vấn đến csdl
     * @return object|bool đối tượng chứa thông tin truy vấn
     */
    public function select($query): object | bool
    {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);

        if($result->num_rows > 0){
            return $result;
        }

        return false;
    }

  

    /**
     * Hàm có nhiệm vụ truy vấn, thêm, cập nhật, xoá, gọi procedure đến csdl
     * @return object|bool đối tượng chứa thông tin truy vấn, gọi procedure; số dòng thêm, cập nhật, xoá thành công
     */
    public  function p_statement($query,  $type = "", $vars = []): object|bool
    {

        $stm = $this->link->prepare($query);        

        // type là i: int, d: double, float, s: string, b: blob 
        array_unshift($vars,  $type);

        // thêm tham chiếu vào vì bind param yều cầu các tham số phải là tham chiếu
        

        call_user_func_array(array($stm, 'bind_param'), $this->refValues($vars));
        $stm->execute() or die($this->link->error.__LINE__);

        

        //INSERT, SELECT, UPDATE và DELETE có 6 kí tự, you can
        //validate it using substr() below for better and faster performance
        if (strtolower(substr($query, 0, 6)) === "select" || strtolower(substr($query, 0, 4)) === "call") {
            $result = $stm->get_result();
        } else {
            $result = $stm->affected_rows;
        }

        $stm->close();
        if($result)
            return $result;

        return false;

        
    }

    private function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }
}
