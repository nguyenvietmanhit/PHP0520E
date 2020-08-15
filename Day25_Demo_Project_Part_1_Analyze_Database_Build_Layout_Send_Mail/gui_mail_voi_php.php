<?php
/**
 * gui_mail_voi_php.php
 *  Hướng dẫn gửi mail với PHP
 *  - PHP có 1 hàm có sẵn để gửi mail, là: mail(), tuy nhiên
 * việc gửi mail sử dụng hàm này ko ổn định, vì việc gửi mail
 * liên quan đến cấu hình các thông số để có thể gửi đc mail,
 * để có thể dùng hàm mail() gửi đc mail, cần cấu hình trong
 * file php.ini. Việc cấu hình sẽ khá khó, thực tế sẽ sử dụng
 * thư viện từ bên ngoài để gửi mail: PHPMailer
 * - Tải thư viên PHPMailer về
 * - Cấu trúc hiện tại: file gui_mail_voi_php.php
 * ngang hàng với thư mục PHPMailer
 PHPMailer
 gui_mail_voi_php.php
 *
 * DEMO gửi mail với thư viện PHPMailer
 * + Copy code mẫu trên trang chủ của PHPMailer, sửa lại các
 * thông số cho phù hợp
 */
?>

<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//nhúng các file sau
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

// Load Composer's autoloader
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;
  // Enable SMTP authentication
  //tên đăng nhập gmail
  $mail->Username   = 'nguyenvietmanhit@gmail.com';                     // SMTP username
  //ko phải password đưang nhập gmail, là mật khẩu ứng dụng
  //https://myaccount.google.com/
  //cần xác minh 2 bước để có thể tạo mật khẩu ứng dụng
  $mail->Password   = 'wkxvypgibgfhtezh';                               // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->setFrom('abc@d.e', 'Mạnh');
//  $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
  $mail->addAddress('nguyenvietmanhit@gmail.com');               // Name is optional
  $mail->addReplyTo('info@example.com', 'Information');
  $mail->addCC('cc@example.com');
  $mail->addBCC('bcc@example.com');

  // Attachments
//  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Here is the subject';
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


//mail('nguyenvietmanhit@gmail.com',
//    'Tiêu đề mail', 'Message gửi mail');