<?php
session_start();
//để tránh trường hợp user biết url hiện tại và truy cập vào khi chưa
//logic, thì cần chặn trường hợp này, bằng cách kiểm tra nếu ko tồn
//tại mảng sesion với key=username thì chuyển hướng về trang login
if (!isset($_SESSION['username'])) {
  $_SESSION['error'] = 'Bạn chưa đăng nhập,ko thể truy cập trang này';
  header('Location: login.php');
  exit();
}
//success.php
//LÀ trang sau khi đăng nhập thành công
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
$success = $_SESSION['success'];
$username = $_SESSION['username'];
//hiển thị thông tin ra màn hình
echo "<h1>$success</h1>";
echo "Chào bạn, <b>$username</b>";
echo "<a href='logout.php'>Logout</a>";