<?php

namespace Classes;

use Library\Session, Library\Database;
use Helpers\Format;

$filepath  = realpath(dirname(__FILE__));
include_once($filepath . "../../lib/session.php");
Session::checkLogin();
include_once($filepath . "../../lib/database.php");
include_once($filepath . "../../helpers/format.php");


class Remember
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Hàm có nhiệm vụ tạo tạo token
     * @return array token chứa selector, validator, selector:validator
     */

    private function generate_tokens(): array
    {
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));

        return [$selector, $validator, $selector . ':' . $validator];
    }

    /**
     * Hàm có nhiệm vụ chuyển đổi token
     * @param string $token token lấy từ cookie của trình duyệt
     * @return array token chứa selector, validator
     */
    private function parse_token(string $token): ?array
    {
        $parts = explode(':', $token);

        if ($parts && count($parts) == 2) {
            return [$parts[0], $parts[1]];
        }
        return null;
    }

    /**
     * Hàm có nhiệm vụ thêm user token
     * @param string $user_id id người dùng
     * @param string $selector là để select validator lưu trữ trong cơ sở dữ liệu
     * @param string $hashed_validator dùng để xác thực đăng nhập
     * @param string $expiry thời hạn hết token (hêt hạn cookie)
     * @return object|bool số lượng user token thêm thành công
     */

    private function insert_user_token(string $user_id, string $selector, string $hashed_validator, string $expiry): object|bool
    {
        $sql = 'INSERT INTO user_tokens(user_id, selector, hashed_validator, expiry)
            VALUES(?, ?, ?, ?)';

        $results = $this->db->p_statement($sql, "ssss", [$user_id, $selector, $hashed_validator, $expiry]);


        return $results;
    }

    /**
     * Hàm có nhiệm vụ tìm user token dựa vào selector
     * @param string $selector là để select validator lưu trữ trong cơ sở dữ liệu
     * @return array|null thông tin user token
     */
    private function find_user_token_by_selector(string $selector): array|null
    {

        $sql = 'SELECT id, selector, hashed_validator, user_id, expiry
                FROM user_tokens
                WHERE selector = ? AND
                    expiry >= now()
                LIMIT 1';

        $results = $this->db->p_statement($sql, "s", [$selector]);

        return $results->fetch_assoc();
    }

    /**
     * Hàm có nhiệm vụ xoá user token
     * @param string $user_id id người dùng
     * @return object|bool số lượng user token xoá thành công
     */
    public function delete_user_token(string $user_id): bool | object
    {
        $sql = 'DELETE FROM user_tokens WHERE user_id = ?';
        $results = $this->db->p_statement($sql, "s", [$user_id]);

        return $results ? true : false;
    }

     /**
     * Hàm có nhiệm vụ tìm người dùng dựa theo token
     * @param string $token token lưu trong cookie
     * @return array thông tin người dùng
     */
    public function find_user_by_token(string $token): array
    {
        $tokens = $this->parse_token($token);

        if (!$tokens) {
            return null;
        }

        $sql = 'SELECT `appusers`.`id`, `appusers`.`username`, `appusers`.`firstname`, `appusers`.`lastname`, `appusers`.`imagepath`
            FROM appusers
            INNER JOIN user_tokens ON user_id = `appusers`.`id`
            WHERE selector = ? AND
                expiry > now()
            LIMIT 1';

        $results = $this->db->p_statement($sql, "s", [$tokens[0]]);

        return $results->fetch_assoc();
    }

     /**
     * Hàm có nhiệm vụ kiểm tra token có hợp lệ hay không
     * @param string $token token lưu trong cookie
     * @return bool token có hợp lệ hay không
     */
    public function token_is_valid(string $token): bool
    { // parse the token to get the selector and validator [$selector, $validator] = parse_token($token);
        [$selector, $validator] = $this->parse_token($token);
        $tokens = $this->find_user_token_by_selector($selector);
        // if(!password_verify($validator, $tokens['hashed_validator'])){
        //     print_r("true");
        // }
        // print_r($validator);
        // echo '<br>';
        // print_r($tokens["hashed_validator"]);
        if (!$tokens) {
            return false;
        }

        return password_verify($validator, $tokens['hashed_validator']);
    }

     /**
     * Hàm có nhiệm vụ nhớ đăng nhập
     * @param string $user_id id người dùng
     * @param int $day số ngày sẽ hết hạn (mặc định là 3)
     * @return void 
     */
    public function remember_me(string $user_id, int $day = 3): void
    {
        [$selector, $validator, $token] = $this->generate_tokens();

        // remove all existing token associated with the user id
        $this->delete_user_token($user_id);

        // set expiration date
        $expired_seconds = time() + 60 * 60 * 24 * $day;

        // insert a token to the database
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
        $expiry = date('Y-m-d H:i:s', $expired_seconds);

        if ($this->insert_user_token($user_id, $selector, $hash_validator, $expiry)) {

            setcookie('remember_me', $token, $expired_seconds,  "/", "localhost", true, true);
        }
    }
}
