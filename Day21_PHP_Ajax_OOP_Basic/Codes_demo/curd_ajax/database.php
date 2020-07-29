<?php
//crud_ajax/database.php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'php0520e_crud';
const DB_PORT = 3306;
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
if (!$connection) {
  die('Error: ' . mysqli_connect_error());
}
//echo "<h2>Kết nối CSDL thành công</h2>";