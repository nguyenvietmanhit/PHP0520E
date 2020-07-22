<?php
session_start();
//crud/delete.php
//Xử lý xóa theo id truyền lên
require_once 'database.php';
//url xóa đang có dạng sau: delete.php?id=12
//luôn phải xử lý validate cho dữ liệu từ url, vì user
//hoàn toàn có thể sửa đc
//nếu id ko tồn tại hoặc id ko phải số thì sẽ báo lỗi
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID ko hợp lệ';
    header('Location: index.php');
    exit();
}
$id = $_GET['id'];
//THỰC HIỆN TRUY VẤN XÓA BẢN GHI THEO ID BẮT ĐƯỢC TỪ URL
// - Tạo truy vấn xóa
//luôn phải xác định điều kiện với truy vấn DELETE/UPDATE
//nếu ko sẽ DELETE/UPDATE toàn bộ bảng!
$sql_delete = "DELETE FROM categories WHERE id = $id";
// - Thực thi truy vấn
$is_delete = mysqli_query($connection, $sql_delete);
if ($is_delete) {
    $_SESSION['success'] = "Xóa bản ghi $id thành công";
} else {
    $_SESSION['error'] = "Xóa bản ghi $id thất bại";
}
header('Location: index.php');
exit();