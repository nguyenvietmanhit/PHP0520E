<?php
//crud/database.php
//+ Thực hiện kết nối CSDL MySQL sử dụng thư viên mySQLi, trả về
//1 biến kết nối để sử dụng ở các chức năng khác
//+ Luôn chỉ khai báo việc kết nối CSDL 1 lần duy nhất, sau đó
//các chức năng khác chỉ việc nhúng file này vào và sử dụng
//luôn biến kêt nối
//+ Thực hiện kết nối tới CSDL php0520e_crud
//+ Khai báo các hằng số kết nối tới CSDL
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'php0520e_crud';
const DB_PORT = 3306;
//thực hiện kết nối
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
//nếu kết nối ko thành công thì sẽ die trang web
if (!$connection) {
  die('Kết nối thất bại. Thông tin lỗi: '
      . mysqli_connect_error());
}
echo "<h2>Kết nối CSDL thành công</h2>";
