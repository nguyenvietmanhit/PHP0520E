<?php
#Tạo CSDL tên day22
//CREATE DATABASE IF NOT EXISTS day22
//CHARACTER SET utf8 COLLATE utf8_general_ci;
#Tạo bảng categories có các trường sau:
# - id: khóa chính, kiểu int, tự tăng
# - name: kiểu varchar, 255, ko cho phép null
# - description: kiểu text, cho phép null
# - avatar: kiểu text, lưu tên file ảnh
# - created_at: ngày tạo, timestamp
//CREATE TABLE categories(
//    id INT(11) AUTO_INCREMENT,
//    name VARCHAR(255) NOT NULL,
//    description TEXT DEFAULT NULL,
//    avatar VARCHAR(255),
//    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//    #định nghĩa khóa chính là trường nào
//    PRIMARY KEY (id)
//)
//crud/database.php
//File này dùng để khai báo các hằng số kết nối tới CSDL MySQL
//sử dụng thư viện MySQLi, tạo ra 1 biến kết nối để sử dụng
//cho các chức năng khác
//3 hằng số này là do khi cài XAMPP đã sinh ra mặc định
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

const DB_NAME = 'day22';
const DB_PORT = 3306;
//tạo ra biến kết nối
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
if (!$connection) {
    die('Kết nối thất bại. Lỗi: ' . mysqli_connect_error());
}
echo "<h2>Kết nối CSDL day22 thành công</h2>";
