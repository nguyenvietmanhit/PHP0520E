<?php
session_start();
//nhúng file database.php để có thể sử dụng đc biến $connection
require_once 'database.php';
//crud/create.php
//Hiển thị 1 form nhập các thông tin danh mục, và 1 nút Thêm mới
//bảng categories đang có các trường sau: id, name, status,
//created_at
//XỬ LÝ SUBMIT FORM
//1 - Tạo 2 biến chứa thông tin lỗi và kết quả
$error = '';
$result = '';
//2 - Debug thông tin mảng tương ứng với phương thức của form
echo "<pre>";
print_r($_POST);
echo "</pre>";
//3 Nếu user submit form thì mới xử lý
if (isset($_POST['submit'])) {
    //4 - gán các biến trung gian để thao tác cho dễ
    $name = $_POST['name'];
    $status = $_POST['status'];
    //5 - Xử lý validate form:
    //+ Name và status ko đc để trống
    // + Status phải nhập số
    if (empty($name) || empty($status)) {
        $error = 'Name hoặc status ko đc để trống';
    } elseif (!is_numeric($status)) {
        $error = 'Status phải nhập số';
    }

    //6 - Xử lý logic submit form theo yêu cầu chỉ khi nào ko
    //có lỗi xảy ra, logic đang là lưu dữ liệu
    //user đã nhập vào bảng categories
    if (empty($error)) {
        //tạo câu truy vấn thêm dữ liệu
        $sql_insert = "INSERT INTO categories(`name`, `status`)
        VALUES('$name', $status)";
        //thực thi truy vấn
        $is_insert = mysqli_query($connection, $sql_insert);
        if ($is_insert) {
            //tạo session chứa thông báo thành công
            //để hiển thị ở trang danh sách
            $_SESSION['success'] = 'Thêm danh mục thành công';
            //chuyến hướng về trang danh sách danh mục
            header('Location: index.php');
            exit();
        } else {
            $error = 'Insert thất bại';
        }
    }
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
<form action="" method="post">
    <h3>Form thêm mới danh mục</h3>
    Name:
    <input type="text" name="name" value="" />
    <br />
    Status
    <input type="text" name="status" value="" />
    <br />
    <input type="submit" name="submit" value="Lưu" />
</form>
