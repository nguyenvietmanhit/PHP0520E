<?php
require_once 'database.php';
//crud_ajax/ajax_create.php
//do phương thức truyền lên từ ajax dang là post nên
//sử dụng biến $_POST tương ứng
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//gán biến
$name = $_POST['name'];
$description = $_POST['description'];
//xử lý validate form
//xử lý lưu data gửi lên từ ajax vào CSDL
// + Tạo câu truy vấn
$sql_insert = "INSERT INTO categories(`name`, `description`)
 VALUES ('$name', '$description')";
$is_insert = mysqli_query($connection, $sql_insert);
//trả dữ liệu về cho ajax thông qua việc echo hoặc thông qua kiểu
//dữ liệu json - kiểu dữ liệu đặc biệt thường dùng cho các nền tảng
//khác nhau
echo $is_insert;