<?php
session_start();
require_once 'database.php';
//crud/delete.php
//Thực hiện xóa bản ghi dựa theo id truyền lên url
//Do đang truyền tham số lên URL, thì dùng phương thức GET
//để lấy giá trị của tham số đó, thông qua mảng $_GET
//Do các tham số trên URL user đều có thể chỉnh sửa đc, nên
//cần phải validate cho tham số này
//Nếu ko tồn tại tham số id hoặc tồn tại r nhưng giá trị lại
//ko phải số, sẽ báo lỗi và chuyển hướng về danh sách
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  $_SESSION['error'] = 'ID ko hợp lệ';
  header('Location: index.php');
  exit();
}
$id = $_GET['id'];
// + Tạo câu truy vấn xóa dữ liệu
//luôn phải có điều kiện where khi update/delete
$sql_delete = "DELETE FROM categories WHERE id = $id";
// + Thực thi truy vấn:
$is_delete = mysqli_query($connection, $sql_delete);
//var_dump($is_delete);
if ($is_delete) {
  $_SESSION['success'] = "Xóa bản ghi id = $id thành công";
} else {
  $_SESSION['error'] = "Xóa bản ghi id = $id thất bại";
}
header('Location: index.php');
exit();