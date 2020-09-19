<?php
require_once 'libraries/PHPMailer/src/PHPMailer.php';
require_once 'libraries/PHPMailer/src/SMTP.php';
require_once 'libraries/PHPMailer/src/Exception.php';
class Helper
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE_TEXT = 'Active';
    const STATUS_DISABLED_TEXT = 'Disabled';

    /**
     * Get status text
     * @param int $status
     * @return string
     */
    public static function getStatusText($status = 0)
    {
        $status_text = '';
        switch ($status) {
            case self::STATUS_ACTIVE:
                $status_text = self::STATUS_ACTIVE_TEXT;
                break;
            case self::STATUS_DISABLED:
                $status_text = self::STATUS_DISABLED_TEXT;
                break;
        }
        return $status_text;
    }

    /**
     * Chuyển đổi chuỗi ký tự có dấu thành chuỗi ký tự không dấu, ngăn cách  nhau bởi ký tự -
     * @param $str
     * @return null|string|string[]
     */
    public static function getSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    /**
     * Gửi mail sử dụng thư viện PHPMailer
     * @param $email String Email người gửi
     * @param $subject String Tiêu đề mail
     * @param $body String Nội dung mail
     * @param $username String Username Gmail
     * @param $password String Mật khẩu ứng dụng
     */
    public static function sendMail($email, $subject, $body, $username, $password)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mail->isSMTP();
            // Send using SMTP
            //host miễn phí của gmail
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            //username gmail của chính bạn
            $mail->Username = $username;                     // SMTP username
            //password cho ứng dụng, ko phải password của tài khoảng
//    đăng nhập gmail
//    tạo mật khẩu ứng dụng tại link:
// https://myaccount.google.com/ - menu Bảo mật
            $mail->Password = $password;                               // SMTP password
//            $mail->Password = 'yichffdzhetottuw';                               // SMTP password
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('demo@demo.com', 'Mail demo gửi đơn hàng');
            //setting mail người gửi
            $mail->addAddress($email);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

            // Attachments
//      $mail->addAttachment('rose.jpeg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}