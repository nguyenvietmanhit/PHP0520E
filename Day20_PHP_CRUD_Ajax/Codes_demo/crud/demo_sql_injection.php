<?php
//crud/demo_sql_injection.php
// DEMO về lỗi bảo mật SQL Injection trong câu truy vấn
// + Là kỹ thuật tấn công vào CSDL thông qua các lỗ hổng bảo mật,
//chủ yếu thông qua form, để thay đổi câu truy vấn của bạn, mục đích
//là phá hoại hệ thống
// + Với cách viết truy vấn CSDL từ trc đến giờ thì đều đang bị dính
//lỗi bảo mật này
// Demo: dựng 1 form cho phép tìm kiếm tương đối danh mục thông
//qua tên danh mục
require_once 'database.php';
//kiểm tra nếu user submit form thì xử lý
if (isset($_GET['submit'])) {
  //can thiệp vào bước lấy giá trị từ form, sử dụng
  //hàm mysqli_real_escape_string để chống SQL Injection
  $name = $_GET['name'];
  $name = mysqli_real_escape_string($connection, $name);
  //+ Tạo câu truy vấn để tìm kiếm tương đối dựa theo name
  $sql_select_all =
      "SELECT * FROM categories WHERE `name` LIKE '%$name%' ";
  //debug câu truy vấn
  var_dump($sql_select_all);
  //+ Thực thi truy vấn
  $result_all = mysqli_query($connection, $sql_select_all);
  //+ Lấy ra dữ liệu dưới dạng mảng kết hợp
  $categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
  //debug
  echo "<pre>";
  print_r($categories);
  echo "</pre>";
  //thử nhập 1 chuỗi sau, để xem có tìm đc kết quả ko
  //nếu show ddc hết dữ liệu ra thì chắc chắn form của bạn đang
  //bị dính lỗi bảo mật SQL Injection
//  123456' OR TRUE#
}

?>
<form action="" method="get">
  Nhập tên
  <input type="text" name="name" value="" />
  <br />
  <input type="submit" name="submit" value="Tìm kiếm" />
</form>
