<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

class Format{
    public static function formatDate($date){
        return date('d-m-Y H:i:s');
    }

    public static function textShorten($text, $limit = '200'){
        $text = $text . " ";
        $text = substr($text, 0, $limit);

        $text = substr($text, 0 , strripos($text, ' ')); //Tìm khoảng trăng cuỗi đầu tiên
        $text = $text . "...";
        return $text;
    }

    public static function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'tiếng',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v; 
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' trước' : 'lúc nãy';
    }
}






