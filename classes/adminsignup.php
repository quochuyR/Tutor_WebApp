<?php

namespace Classes;

use Library\Session, Library\Database;
use Helpers\Format;
use Classes\AppUserRole, Classes\AppUser;

// $filepath  = realpath(dirname(__FILE__));
// include_once($filepath . "../../lib/session.php");
Session::checkLogin();
// include_once($filepath . "../../lib/database.php");
// include_once($filepath . "../../helpers/format.php");
// include_once($filepath . "../../classes/appuserroles.php");
// include_once($filepath . "../../classes/appusers.php");

require_once(__DIR__ . "../../config/app.php");
class AdminSignUp
{

    private $db;
    private $user_role;
    private $user;
    public function __construct()
    {
        $this->db = new Database();
        $this->user_role = new AppUserRole();
        $this->user = new AppUser();
    }


    /**
     * Hàm có nhiệm vụ thêm thông tin người dùng đăng ký (chỉ dành cho người dùng)
     * @param string $first_name Họ người dùng
     * @param string $last_name Tên người dùng
     * @param string $email Email người dùng
     * @param string $phone_number số điện thoại người dùng
     * @param string $username tài khoản người dùng
     * @param string $password mật khẩu người dùng
     * @param string $activation_code mã được tạo ngẫu nhiên gửi đến mail người đăng kí
     * @param int $expiry ngày hết hạn. Mặt định 1 ngày
     * @return bool đăng kí thành công hay không
     */
    public function sign_up_admin(
        string $first_name,
        string $last_name,
        string $email,
        string $phone_number,
        string $username,
        string $password,
        string $activation_code,
        int $expiry = 1 * 24  * 60 * 60
    ): bool {
        $first_name = mysqli_real_escape_string($this->db->link, $first_name);
        $last_name = mysqli_real_escape_string($this->db->link, $last_name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone_number = mysqli_real_escape_string($this->db->link, $phone_number);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        // check is empty
        if (
            !empty($first_name) && !empty($last_name) && !empty($email)
            && !empty($phone_number) && !empty($username) && !empty($password)
        ) {
            // hash password
            $hash_password = password_hash($password, PASSWORD_ARGON2I);
            $activation_code = password_hash($activation_code, PASSWORD_DEFAULT);
            $expiry = date('Y-m-d H:i:s',  time() + $expiry);
            // create new user
            $create_new = $this->user->create_new_user($username, $email, $hash_password, $last_name, $first_name, $phone_number, $activation_code, $expiry);
            if ($create_new) { // create success
                // get userId from username
                $userId = $this->user->find_user_id_by_username($username)->fetch_assoc()["id"];

                if (!empty($userId)) {
                    // add user role
                    $this->user_role->add_user_role($userId, 3);
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Hàm dùng để tạo mã xác thực
     * @return string mã ngẫu nhiên với độ dài 16
     */
    public function generate_activation_code(): string
    {
        return bin2hex(random_bytes(16));
    }


    /**
     * Hàm có nhiệm vụ gửi link để xác thưc
     * @param array $info thông tin chung cần xác thực (email)
     * @param string $activation_code mã code xác thực
     * @return bool mã ngẫu nhiên với độ dài 16
     */
    function send_activation_email(array $info, string $activation_code): bool
    {
        // create the activation link
        $activation_link = APP_URL . "/activate?email={$info['email']}&activation_code={$activation_code}";

        // set email subject & body
        $subject = 'Vui lòng xác thực tài khoản của bạn';
        $message = '
        <div style="background-color: #f3f4f6;">
        <div style="background-color: #fff;width:fit-content; margin:auto">
            <div style="flex: 1 1 auto;
    padding: 3rem 1rem">
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
                    <tbody>
                        <tr>
                            <td width="100%" align="center">
                                <img src="https://www.bootdey.com/img/Content/avatar/avatar7.png" width="140" height="auto" style="width:25%;height:auto; border-radius: 50%" class="CToWUd">
                            </td>
                        </tr>
                        <tr>
                            <td height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>
                    </tbody>


                </table>
                <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="m_283752211504387459backgroundTable" align="center" style="margin-left: auto;
  margin-right: auto; margin-top: 1rem;">
                    <tbody>
                        <tr>


                            <td style="font-family:Helvetica,arial,sans-serif;font-size:13px;color:#000000;text-align:left;line-height:18px">
                                Xin chào ' . $info['last_name'] . ' ' . $info['first_name'] . ',
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-family:Helvetica,arial,sans-serif;font-size:13px;color:#000000;text-align:left;line-height:18px">
                                Vui lòng nhấn vào link bên dưới để kích hoạt tài khoản của bạn: <a href="' . $activation_link . '">nhấn vào đây</a>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="100%" height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-family:Helvetica,arial,sans-serif;font-size:13px;color:#000000;text-align:left;line-height:18px">
                                <br>
                                Trân trọng,<br>
                                Đội ngũ web gia sư online trường Đại học Đồng Tháp
                            </td>
                        </tr>

                    </tbody>
                </table>
                

                <table width="500" align="center"  cellpadding="0" cellspacing="0" border="0" style="margin-top:5rem;margin-left:auto;margin-right:auto;">
                    <tbody>
                        <tr>
                            <td width="100%" style="font-family:Helvetica,arial,sans-serif;font-size:11px;color:#45B8AC;text-align:center;line-height:100%"><a href="#" style="text-decoration:none;color:#45B8AC" target="_blank">Chính sách bảo mật | Điều khoản web gia sư</a></td>
                        </tr>


                        <tr>
                            <td width="100%" height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>


                        <tr>
                            <td width="100%" style="font-family:Helvetica,arial,sans-serif;font-size:11px;color:#747474;text-align:center;line-height:0.9rem">Đây là email tự động. Vui lòng không trả lời email này. Thêm <a href="#" style="text-decoration:none;color:#45B8AC" target="_blank">info@tutor.vn</a> vào danh bạ email của bạn để đảm bảo bạn luôn nhận được email từ chúng tôi.</td>
                        </tr>


                        <tr>
                            <td width="100%" height="10" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>


                        <tr>
                            <td width="100%" style="font-family:Helvetica,arial,sans-serif;font-size:11px;color:#747474;text-align:center;line-height:100%">783, Phạm Hữu Lầu, P.6, TP. Cao Lãnh, Đồng Tháp</td>
                        </tr>


                        <tr>
                            <td width="100%" height="40" style="font-size:1px;line-height:1px">&nbsp;</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>  
         ';
        // email header
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';

        // Additional headers
        $headers[] = 'To: ' . $info['email'];
        $headers[] = "From: " . SENDER_EMAIL_ADDRESS;


        // send the email
        $send = mail($info['email'], $subject, $message,  implode("\r\n", $headers));
        return $send;
    }
}
