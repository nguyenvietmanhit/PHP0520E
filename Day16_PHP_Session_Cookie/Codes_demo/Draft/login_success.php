<?php
session_start();
//để đề phòng trường hợp user chưa login mà truy cập thẳng
//vào file này, cần chuyển hướng user về trang login
//nếu ko tồn tại mảng $_SESSION với key = username thì sẽ
//chuyển hướng
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Bạn chưa login';
    header('Location: thuc_hanh_session.php');
    exit();
}
//login_success.php, ngang hàng với file thuc_hanh_session.php
//file này hiển thị username và message thành công sau khi user
//đăng nhập
//debug các thông tin của session
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
$username = $_SESSION['username'];
$success = $_SESSION['success'];
echo "<h3>$success</h3>";
echo "<h1>Chào bạn, $username</h1>";
//tạo link logout để đăng xuất người dùng
echo "<a href='logout.php'>Logout</a>";
