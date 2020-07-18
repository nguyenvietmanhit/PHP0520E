<?php
//crud/database.php
//Code file này đầu tiên
//Mục đích của file này: chứa các hằng số kết nối CSDL,
//và tạo ra biến kết nối $connection theo cơ chế mySQLi
//, để các chức năng crud sẽ chỉ việc nhúng file này vào
//là có thể sử dụng đc luôn biến kết nối $connection
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'day_21';
const DB_PORT = 3306;
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
if (!$connection) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
echo "<h2>Kết nối thành công</h2>";