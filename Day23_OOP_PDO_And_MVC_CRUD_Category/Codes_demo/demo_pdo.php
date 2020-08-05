<?php
/*
 * demo_pdo.php
 * 1 - Khái niệm:
 * + PDO - PHP Data Objects: là 1 cơ chế kết nối CSDL
 * + PDO hỗ trợ kết nối nhiều CSDL khác nhau, trong khi mySQLi
 * chỉ hỗ trợ 1 CSDL duy nhất là MySQL
 * + PDO sử dụng hoàn toàn cú pháp của OOP để code, khác với
 * mySQLi hỗ trợ cả 2 code thuần và OOP
 * + Thực tế nên sử dụng PDO để kết nối CSDL
 * + PDO hỗ trợ cơ chế truyền giá trị vào câu truy vấn theo kiểu
 * bind Param - gắn tham số, giúp chống dc lỗi bảo mật SQLInjection
 * 2 - Demo các chức năng CRUD danh mục sử dụng PDO
 * a/ Tạo CSDL php0520e_pdo
 * Tạo CSDL php0520e_pdo
CREATE DATABASE IF NOT EXISTS php0520e_pdo CHARACTER SET utf8
COLLATE utf8_general_ci;
 * b/ Trong CSDL này tạo 1 bảng tên categories, có 3 trường:
 * id: khóa chính
 * name: tên danh mục
 * amount: số lượng danh mục
 * Tạo bảng categories: id, name, amount
CREATE TABLE categories(
	id INT(11) AUTO_INCREMENT,
    name VARCHAR(255),
    amount INT(11),
    PRIMARY KEY (id)
);
 */
//DEMO sử dụng cơ chế PDO tương tác với CSDL
// 1 - Khởi tạo kết nối
// Sử dụng các hằng số để lưu thông tin kết nối
// DSN - Data Source Name - Chuỗi khai báo theo cơ chế PDO, cú pháp:
//<tên-driver-CSDL>:host=<tên-host>;dbname=<tên-db>;port=<port>;
//charset=utf8
//chuỗi này ko dc chứa 1 dấu cách nào
const DB_DSN = 'mysql:host=localhost;dbname=php0520e_pdo;port=3306;charset=utf8';
//username kết nối CSDL
const DB_USERNAME = 'root';
//password kết nối CSDL
const DB_PASSWORD = '';
//thực hiện kết nối = cách khởi tạo 1 đối tượng từ class PDO có sẵn
// của PHP, cần truyền các giá trị cho việc khởi tạo class này
//nên sử dụng khối lệnh try catch để bắt các ngoại lệ liên quan
//đến kết nối
try {
//  cần truyền vào 3 giá trị khi khởi tạo class PDO, do trong class
  //này đang có 1 phương thức khởi tạo sử dụng 3 tham số
  $connection = new PDO(DB_DSN, DB_USERNAME,
      DB_PASSWORD);
} catch (Exception $e) {
  die("Lỗi kết nối: " . $e->getMessage());
}
echo "<h2>Kết nối CSDL thành công</h2>";

//2 - DEMO thêm dữ liệu vào bảng categories sử dụng PDO
// + Viết câu truy vấn
// Nên sử dụng kiểu bind param - truyền tham số - thay vì truyền
//giá trị thật vào câu truy vấn, giúp chống dc lỗi bảo mật SQLInjection
// Giúp code trở nên đơn giản hơn vì ko phải nối chuỗi các giá trị
$sql_insert = "INSERT INTO categories(`name`, `amount`)
VALUES (:name, :amount)";
// + Tạo đối tượng truy vấn dựa trên câu truy vấn trên, sử
//dụng phương thức prepare trên đối tượng kết nối $connection
$obj_insert = $connection->prepare($sql_insert);
//echo "<pre>";
//print_r($obj_insert);
//echo "</pre>";
// + Tạo mảng kết hợp để truyền giá trị thật cho câu truy vấn
//trong trường hợp câu truy vấn có truyền theo kiểu tham số
// Mảng này sẽ có số phần tử mảng = số lượng các tham số trong
//câu truy vấn, key = <tên-tham-số>, value=<giá-trị-của-bạn>
$arr_insert = [
    ':name' => 'Danh mục new',
    ':amount' => 4
];
// + Thực thi truy vấn dựa trên đối tượng truy vấn sinh ra, sử dụng
//phương thức execute
//cần truyền mảng nếu có
//với truy vấn insert, update, delete thì giá trị trả về là boolean
$is_insert = $obj_insert->execute($arr_insert);
var_dump($is_insert);

//3 - Cập nhật dữ liệu theo cơ chế PDO
//Cập nhật name = new, amount = 123 với bản ghi có id = 1
// + Viết câu truy vấn update truyền kiểu tham số
$sql_update = "UPDATE categories 
SET `name` = :name, `amount` = :amount WHERE id = :id";
// + Tạo đối tượng truy vấn từ câu truy vấn trên
$obj_update = $connection->prepare($sql_update);
// + Tạo mảng truyền giá trị thật cho các tham số trong câu truy vấn
$arr_update = [
    ':name' => 'New',
    ':amount' => 123,
    ':id' => 1
];
// + Thực thi truy vấn dựa trên đối tượng truy vấn có đc
$is_update = $obj_update->execute($arr_update);
//trong trường hợp muốn debug xem việc tạo mảng truyền giá trị cho
//các tham số có đúng số lượng ko, thì có thể sử dụng 1 phương thức
//debugDumpParams() trên đối tượng truy vấn, sau khi execute()
//$obj_update->debugDumpParams();
var_dump($is_update);

//4  - Xóa với PDO
//Xóa bản ghi có id > 8
// + Viết câu truy vấn, ko cần sử dụng tham số nếu nhu biết chắc
//chắn giá trị đó là số, do lỗi bảo mật SQLInjection thường xảy ra
// với 1 chuỗi hơn
$sql_delete = "DELETE FROM categories WHERE id > 8";
// + Tạo đối tượng truy vấn
$obj_delete = $connection->prepare($sql_delete);
// + Do câu truy vấn ko có tham số nào nên ko tạo mảng
// + Thực thi truy vấn, do ko có mảng đầu vào nên ko truyền giá
//trị nào cho phương thức execute
$is_delete = $obj_delete->execute();
var_dump($is_delete);

// 5 - Truy vấn lấy dữ liệu: có 2 kiểu lấy: nhiều và lấy 1
// - Lấy nhiều dữ liệu: lấy tất cả bản ghi trong bảng categories
// + Tạo câu truy vấn
$sql_select_all = "SELECT * FROM categories ORDER BY amount DESC";
// + Tạo đối tượng truy vấn, prepare
$obj_select_all = $connection->prepare($sql_select_all);
// + Do câu truy vấn ko có tham số , bỏ qua bước tạo mảng
// + Thực thi truy vấn,execute, tuy nhiên với truy vấn SELECT ko cần
//sử dụng kết quả trả về của phương thức execute này
$obj_select_all->execute();
// + Sau khi execute xong, thì mới có bước cuối cùng để trả về
//1 mảng dữ liệu mong muốn
//cần truyền 1 hằng số của class PDO, cú pháp để gọi hằng trong
//1 class sẽ giống với gọi thuộc tính/phương thức tĩnh
//<tên-class>::<tên-hằng>
$categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($categories);
echo "</pre>";
// - Select 1 bản ghi duy nhất, lấy ra thông tin bản ghi có id = 1
// + Tạo câu truy vấn
$sql_select_one = "SELECT * FROM categories WHERE id = 1";
// + Tạo đối tượng truy vấn, prepare
$obj_select_one = $connection->prepare($sql_select_one);
// + Do câu truy vấn ko có tham số nên bỏ qua bước tạo mảng
// + Thực thi truy vấn, execute
$obj_select_one->execute();
// + Lấy mảng dữ liệu từ đối tượng truy vấn
//Trong trường hợp biết chắc chắn chỉ có 1 bản ghi trả về, dùng
//phương thức fetch() trên đối tượng truy vấn
$category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($category);
echo "</pre>";
