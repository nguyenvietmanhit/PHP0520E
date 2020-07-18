<?php
//demo_php_connection_mysql.php
//Bài toán đặt ra: vì PHP và ngôn ngữ truy vấn SQL là 2 ngôn
//ngữ độc lập, làm thế nào để kết nối dc từ PHP vào mySQL?
//PHP đc rất nhiều bên thứ 3 viết ra các thư viện để hỗ trợ
//kết nối tới CSDL, 1 trong số đó là thư viện mySQLi
// + XAMPP đã hỗ trợ cài dặt thư viện mySQLi này rồi
// + Thư viên mySQLi này hỗ trợ cả 2 cách tiếp cận: theo hướng
// sử dụng các hàm thuần của PHP và theo hướng lập trình
//hướng đối tượng
//Tuy nhiên để dễ học và dễ tiếp cận, thì sẽ học theo hướng sử
//dụng các hàm PHP thuần
// + Các framework cũng như CMS thực tế sẽ ít khi dùng thư viên
//mySQLi này để kết nối CSDL, vì thư viện này chỉ hỗ trợ kết nối
//đúng 1 CSDL duy nhất là MySQL
// + Thực tế sẽ dùng cơ chế PDO - PHP Data Object để kết nối
//CSDL, vì cơ chế này hỗ trợ kết nối tất cả CSDL đang có trên
//thực tế như mySQL, Oracle, SQL Server, NoSQL, SQLite ..., tuy
//nhiên cơ chế này code sử dụng hoàn toàn lập trình hướng đối
//tượng
// + Việc kết nối CSDL từ PHP vào MySQL thì ko khó, chủ yếu
//nằm ở kỹ năng viết truy vấn của chính các bạn

//CÁC BƯỚC KẾT NỐI CSDL TỪ PHP ĐẾN MYSQL SỬ DỤNG THƯ VIÊN
//MYSQLI
//+ Tạo CSDL php0520e_crud có 1 bảng duy nhất: categories
//+ Bảng categories sẽ có các trường sau:
// - id: khóa chính, tự tăng, kiểu số, tối đa 11 ký tự
// - name: tên danh mục, kiểu chuỗi tối đa 255 ký tự,
// ko cho phép null
// - description: mô tả chi tiết danh mục, kiểu chuỗi, ko giới
//hạn ký tự
// - avatar: lưu tên file ảnh đại diện của danh mục, kiểu chuỗi,
//cho phép null, với các trường lưu ảnh thì thường sẽ lưu tên
//file ảnh, chứ ko lưu nguyên ảnh vào CSDL
// - created_at: ngày tạo danh mục, kiểu ngày tháng, tự động
//sinh dựa theo thời gian hiện tại
#1  - Tạo CSDL php0520e_crud
//CREATE DATABASE IF NOT EXISTS php0520e_crud
//CHARACTER SET utf8 COLLATE utf8_general_ci;
#2 - Tạo bảng categories: id, name, description, avatar,
#created_at
//CREATE TABLE IF NOT EXISTS categories(
//    id INT(11) AUTO_INCREMENT,
//    name VARCHAR(255) NOT NULL,
//    description TEXT,
//    avatar VARCHAR(255),
//    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//    #khai báo khóa chính, khóa phú nếu có sau khi khai báo
//    # tất cả các trường
//    PRIMARY KEY (id)
//);
//1 - Khởi tạo kết nối
//các hàm của php khi sử dụng thư viên mysql luôn có tiền tố
//là: mysqli
//khai báo các hằng số dùng cho việc kết nối csdl
//khai báo hằng chứa tên máy chủ của CSDL cần kết nối
//mặc định trên local thì sẽ là localhost
const DB_HOST = 'localhost';
//khai báo hằng username để kết nối vào CSDL
//mặc định khi cài XAMPP thì đã có sẵn username=root
const DB_USERNAME = 'root';
//khai báo hằng password để kết nối CSDL
//mất khẩu mặc định khi cài XAMPP là giá trị rỗng
const DB_PASSWORD = '';
//khai báo hằng tên CSDL muốn kết nối
const DB_NAME = 'php0520e_crud';
//khai báo hằng cổng của CSDL sẽ kết nối
const DB_PORT = 3306;
//sử dụng hàm mysqli_connect để kết nối
$connection = mysqli_connect(DB_HOST, DB_USERNAME,
    DB_PASSWORD, DB_NAME, DB_PORT);
if (!$connection) {
  die("Lỗi kết nối. Thông tin lỗi: " . mysqli_connect_error());
}
echo "<h2>Kết nối CSDL thành công</h2>";
//set thủ công utf8 cho kết nối, để lưu đc các ký tự có dấu
//mà ko bị lỗi font chữ
mysqli_query($connection, "SET NAMES 'utf8'");

//2 - Thực hiện thêm dữ liệu vào bảng categories sử dụng PHP
// + Tạo câu truy vấn INSERT
//Cần xác định trường nào sinh tự động thì ko cần insert, chỉ
//insert các trường thêm thủ công. Với bảng categories hiện tại
//đang có các trường id, name, description, avatar, created_at
// ngoài ra cần bao tên trường bởi cặp ký tự `` để tránh lỗi, vì
//tên trường có thể sẽ bị trùng với từ khóa của MYSQL mà bạn
//ko biết
//Các giá trị khi thêm cho các trường phải có kiểu dữ liệu
//tương ứng với nhau
$sql_insert = "
INSERT INTO categories(`name`, `description`, `avatar`)
VALUES ('Thể thao', 'Mô tả thể thao', 'the-thao.jpg')";
// + Thực thi truy vấn vừa tạo, sử dụng hàm mysqli_query
//Với các truy vấn INSERT, UPDATE, DELETE thì hàm mysqli_query
//luôn trả về giá trị true/false
$is_insert = mysqli_query($connection, $sql_insert);
var_dump($is_insert);

//3  - Update dữ liệu sử dụng PHP
//vd: update tên danh mục = 'new name' cho các danh mục mà
// có id < 3
// + Tạo câu truy vấn
//với truy vấn UPDATE và DELETE luôn cần phải xác định điều kiện
//sẽ update/delete, nếu ko sẽ là thao tác update/delete toàn
//bộ bảng
$sql_update = "UPDATE categories SET `name` = 'New name'
WHERE id < 3";
// + Thực thi truy vấn, update -> trả về true/false
$is_update = mysqli_query($connection, $sql_update);
var_dump($is_update);

//4 - Truy vấn xóa dữ liệu sử dụng PHP
//vd: xóa các bản ghi nào mà có id > 8 của categories
// + Tạo câu truy vấn, với truy vấn UPDATE/DELETE luôn phải xác
//định điều kiện đi kèm
$sql_delete = "DELETE FROM categories WHERE id > 8";
// + Thực thi truy vấn, với truy vấn DELETE -> true/false
$is_delete = mysqli_query($connection, $sql_delete);
var_dump($is_delete);

// 5 - Truy vấn lấy dữ liệu: có 2 kiểu lấy: lấy nhiều dữ liệu
//tại 1 thời điểm và lấy 1 dữ liệu tại 1 thời điểm
// + Truy vấn lấy nhiều dữ liệu:
//vd: lấy tất cả bản ghi đang có trong bảng categories
// - Tạo câu truy vấn:
$sql_select_all = "SELECT * FROM categories";
// - Thực thi câu truy vấn, tuy nhiên với truy vấn SELECT thì
//hàm mysqli_query trả về 1 đội tượng trung gian gì đó, chứ ko
//trả về true/false như INSERT,UPDATE,DELETE
$result_all = mysqli_query($connection, $sql_select_all);
echo "<pre>";
print_r($result_all);
echo "</pre>";
//cần thêm 1 bước để trả về 1 mảng dữ liệu chứa các danh mục
//tương ứng, sử dụng hàm mysqli_fetch_all
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
echo "<pre>";
print_r($categories);
echo "</pre>";
//hiển thị tên của các danh mục
foreach($categories AS $category) {
  echo "Name: " . $category['name'] . "<br />";
}
// + Demo truy vấn lấy 1 bản ghi
//vd: lấy bản ghi có id = 1 trong bảng categories
// - Tạo câu truy vấn
$sql_select_one = "SELECT * FROM categories WHERE id = 1";
// - Thực thi truy vấn
$result_one = mysqli_query($connection, $sql_select_one);
// - Lấy mảng dữ liệu tương ứng với đối tượng trung gian trên
//nếu câu truy vấn chỉ trả về đúng 1 bản ghi duy nhất, thì sẽ
//sử dụng hàm mysqli_fetch_assoc để lấy dữ liệu
$category = mysqli_fetch_assoc($result_one);
echo "<pre>";
print_r($category);
echo "</pre>";
//DEMO với truy vấn đếm tổng số bản ghi theo id và theo name
//của bảng danh mục
// - Tạo câu truy vấn
$sql_count = "SELECT COUNT(id) AS count_id, 
              COUNT(name) AS count_name
              FROM categories";
// - Thực thi truy vấn select
$result_count = mysqli_query($connection, $sql_count);
// - Lấy mảng dữ liệu trả về từ đối tượng trung gian trên
//với truy vấn count thì sẽ chỉ trả về 1 bản ghi duy nhất
$count = mysqli_fetch_assoc($result_count);
echo "<pre>";
print_r($count);
echo "</pre>";
