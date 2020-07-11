<?php
session_start();
//logout.php
//XỬ LÝ ĐĂNG XUẤT USER KHỎI HỆ THỐNG
//xử lý xóa hết tất các session liên quan khi user login vào
//hệ thống
unset($_SESSION['success']);
unset($_SESSION['username']);
$_SESSION['success'] = 'Đăng xuất thành công';
//xóa các cookie liên quan đến username và password
setcookie('username', '', time() - 1);
setcookie('password', '', time() - 1);

//có thể sử dụng thêm hàm session_destroy()
header('Location: login.php');
exit();