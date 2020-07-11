<?php
session_start();
//logout.php, ngang hàng với các file demo trước
//xử lý đăng xuất khỏi hệ thống
//xóa hết các session liên quan đến user đã login thành
//công, chuyển hướng về trang login kèm thông báo
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
//xóa cookie đang lưu liên quan đến username và password
setcookie('username', 'dsadsa', time() - 1);
setcookie('password', 'dsadsa', time() - 1);
//xóa session username
unset($_SESSION['username']);
$_SESSION['success'] = 'Logout thành công';
//chuyển hướng về trang login
header('Location: thuc_hanh_session.php');
exit();