<?php
namespace Classes;

use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");
// include_once($filepath."../../helpers/format.php");

class Review 
{
    private $db;
    // private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }
    
    /**
     * Hàm có nhiệm vụ lấy thông tin đánh giá
     * @return object thông tin đánh giá
     */
    public function getAll(): object
    {
        $query = "SELECT  * FROM `reviews`; ";

        $result = $this->db->select($query);
        return $result;
    }
    /**
     * Hàm có nhiệm vụ lấy thông tin đánh giá dựa vào tutorId
     * @param string $tuId id gia sư
     * @return object|bool thông tin đánh giá người dùng ứng với gia sư
     */
    public function get_review_by_tuId(string $tuId): object|bool
    {
        $query = "SELECT u.lastname, u.firstname, u.imagepath, rw.date_rating, rw.user_rating, rw.user_review 
        FROM (( `reviews` AS rw INNER JOIN `tutors` AS tu ON tu.id = rw.tutorId)
              INNER JOIN `appusers` AS u ON u.id = rw.userId)
              WHERE `tutorId` = ?;";

        $result = $this->db->p_statement($query, "s", [$tuId]);
        return $result;
    }
    /**
     * Hàm có nhiệm vụ lấy trung bình đánh giá dựa vào tutorId
     * @param string $tuId id gia sư
     * @return object|bool trung bình đánh giá người dùng ứng với gia sư
     */
    public function get_avg_review_by_tuId(string $tuId): object|bool
    {
        $query = "SELECT AVG(`reviews`.`user_rating`) AS average_rating 
        FROM `reviews` 
        WHERE `tutorId` = ?";

        $result = $this->db->p_statement($query, "s", [$tuId]);
        return $result;
    }

}