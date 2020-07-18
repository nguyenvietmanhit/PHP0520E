<?php
//php_connect_mysql.php
//DEMO CÁCH PHP KẾT NỐI VÀO CSDL MYSQL
//+ Hiện tại sẽ sử dụng thư viên mySQLi do PHP xây dựng sẵn
//để kết nối từ PHP vào mysql
//+ Thư viên mySQLi cung cấp 2 cơ chế để kết nối tới mysql:
// - kết nối sử dụng các hàm PHP thuần: hiện tại sẽ sử dụng
//cơ chế này do chưa học về OOP, và cơ chế sẽ dễ học dễ viết
// - kết nối sử dụng lập trình hướng đối tương
// + Web thực tế sẽ ít khi dùng thư viện mySQLi để kết nối, vì
// thư viện này chỉ hỗ trợ kết nối vào 1 CSDL duy nhất là mySQL,
//nghĩa là ko thể kết nối đc vào CSDL SQL Server, Oracle ...
// + Học kết nối sử dụng mySQLi nhằm mục đích hiểu đc các bước
//kết nối và việc thực thi truy vấn
// + Trong thực tế, sẽ hay dùng 1 cơ chế kết nối CSDL khác là:
//PDO - PHP Data Object - viết hoàn toàn dựa vào lập trình
//hướng đối tượng, cơ chế này hỗ trợ kết nối tới tất cả CSDL hiện
//tại
// + Việc viết code kết nối thì ko khó, cái khó là kỹ năng viết
//truy vấn của bạn

//DEMO 1 hệ thống đơn giản: thêm, sửa, xóa, liệt kê dư liệu
//sử dụng mySQLi
//1 - dùng câu truy vấn tạo CSDL tên day_21
//CREATE DATABASE day_21 CHARACTER SET utf8 COLLATE utf8_general_ci;
//2 - trong CSDL day_21, tạo 1 bảng tên là categories có các
//trường sau:
//id: khóa chính, tự tăng
//name: tên danh mục, varchar, 255
//status: trạng thái, tinyint, 3
//created_at: ngạy tạo, timestamp, tự động tạo theo thời gian
//hiện tại
/*
CREATE TABLE categories(
id INT(11) AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
status TINYINT(3) DEFAULT 0,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
);
 */
//3 Sử dụng PHP kết nối với mySQL thông qua các hàm mà thư
//viện mySQLi cung cấp sẵn
//+ Kết nối tới CSDL day_21;
//khai báo các hằng số dùng để kết nối vào CSDL
const DB_HOST = 'localhost';
//username và password với localhost khi cài đặt XAMPP đã tự
//động tạo ra username='root' và password=''
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'day_21';
const DB_PORT = 3306;
//sử dụng hàm mysqli_connection để kết nối tới CSDL
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
if (!$connection) {
    die('Kết nối thất bại: ' . mysqli_connect_error());
}
echo "<h2>Kết nối thành công</h2>";

//+ Code truy vấn Thêm dữ liệu cho bảng categories
// -  Viết câu truy vấn insert: id, name, status, created_at
//nhớ thêm cặp ký tự `` bao lấy tên trường của bảng
$sql_insert = "INSERT INTO categories(`name`, `status`) 
VALUES ('Name 1', 0), ('Name 2', 1)";
// - Thực thi truy vấn vừa tạo, sử dụng hàm mysqli_query
$is_insert = mysqli_query($connection, $sql_insert);
//nếu mà trả về false, thì có thể test bằng cách copy câu truy
//vấn $sql_insert paste thẳng lên tab SQL trong PHPMyadmin để
//test trực tiếp
if ($is_insert) {
    echo "Insert thành công";
} else {
    echo 'Insert thất bại';
}
//với các truy vấn INSERT, UPDATE, DELETE thì hàm mysqli_query
//luôn trả về giá trị true/false

// - Code sửa dữ liệu UPDATE
//vd: sửa tên danh mục có id =1 thành giá trị = New name
//+ Tạo câu truy vấn update
//với truy vấn update và delete, luôn phải xác định điều kiện đi
//kèm, nếu ko sẽ update/delete toàn bộ bảng!
$sql_update = "UPDATE categories SET `name` = 'New name'
WHERE id = 1";
// + Thực thi câu truy vấn vừa tạo
$is_update = mysqli_query($connection, $sql_update);
if ($is_update) {
    echo "Update bản ghi có id = 1 thành công";
} else {
    echo "Update bản ghi có id = 1 thất bại";
}
//var_dump($is_update);
//với truy vấn insert, update, delete thì hàm mysqli_query luôn
//trả về true/false

// - Code xóa dữ liệu - DELETE
//vd: xóa các bản ghi mà có id > 8
// + Viết truy vấn xóa
//với truy vấn update/delete luôn phải xác định điều kèm, nếu ko
//sẽ update/delete toàn bộ bảng!
$sql_delete = "DELETE FROM categories WHERE id > 8";
// + Thực thi truy vấn xóa
$is_delete = mysqli_query($connection, $sql_delete);
//var_dump($is_delete);
if ($is_delete) {
    echo "Xóa các bản ghi có id > 8 thành công";
} else {
    echo "Xóa các bản ghi có id > 8 thất bại";
}
//với 3 truy vấn insert/update/delete thì hàm mysqli_query luôn
//trả về true/false

// Code truy vấn LẤy dữ liêu - SELECT
//a/ Demo lấy nhiều bản ghi, vd: lấy tất cả bản ghi đang có
//trong bảng categories
// - Viết câu truy vấn
$sql_select_all = "SELECT * FROM categories";
// - Thực thi truy vấn, vẫn dùng hàm mysqli_query, tuy nhiên
//kết quả trả về của hàm này sẽ ko phải là true/false như với
//truy vấn insert/update/delete nữa, mà sẽ là 1 đối tượng
// trung gian
$result_all = mysqli_query($connection, $sql_select_all);
//echo "<pre>";
//print_r($result_all);
//echo "</pre>";
//lấy dữ liệu trả về bằng cách sử dụng hàm mysqli_fetch_all
//chú ý phải truyền hằng số MYSQLI_ASSOC thì hàm này mới trả
//về kiểu dữ liệu mảng kết hợp
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
foreach ($categories AS $category) {
    echo "Id category: " . $category['id'] . "<br />";
}

// /b Lấy 1 bản ghi duy nhất
//vd: lấy thông tin bản ghi của bảng categories có id = 2
// - Tạo câu truy vấn
$sql_select_one = "SELECT * FROM categories WHERE id = 2 LIMIT 1";
// - Thực thi truy vấn, trả về đối tượng trung gian
$result_one = mysqli_query($connection, $sql_select_one);
// - Lấy dữ liệu thật, nếu chỉ có 1 bản ghi duy nhất, sử dụng hàm
//mysqli_fetch_assoc
$category = mysqli_fetch_assoc($result_one);
echo "<pre>";
print_r($category);
echo "</pre>";
