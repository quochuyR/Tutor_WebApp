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

    /**
     * Hàm có nhiệm vụ thêm đánh giá cho gia sư
     * @param string $userId id người dùng
     * @param string $tuid id gia sư
     * @param int $star_review Số lượng sao đánh giá (1 --> 5)
     * @param string $text_rating nội dung đánh giá
     * @return object|bool số lượng hàng thêm thành công
     */
    public function add_review($userId, $tuid, $star_review, $text_rating): object|bool
    {
        $query = "INSERT INTO `reviews` (`id`, `userId`, `tutorId`, `user_rating`, `user_review`, `date_rating`) 
        VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP);";

        $result = $this->db->p_statement($query, "ssis", [$userId, $tuid, $star_review, $text_rating]);
        return $result;
    }

    /**
     * Hàm có nhiệm vụ kiểm tra người dùng đánh giá gia sư hay chưa
     * @param string $userId id người dùng
     * @param string $tuid id gia sư
     * @return object|bool gia sư đăng kí hay chưa (0/1)
     */
    public function has_review($userId, $tuid): object|bool
    {
        $query = "SELECT COUNT(*) hasReview 
        FROM `reviews`
        WHERE `userId` = ? AND `tutorId` = ?;";

        $result = $this->db->p_statement($query, "ss", [$userId, $tuid]);
        return $result;
    }

}