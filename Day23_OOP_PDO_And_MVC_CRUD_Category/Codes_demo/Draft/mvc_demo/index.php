<?php
session_start();
/**
mvc_demo/index.php
file index gốc của ứng dụng
1 - Tạo CSDL: php0320e_mvc
CREATE DATABASE IF NOT EXISTS php0320e_mvc
CHARACTER SET utf8 COLLATE utf8_general_ci;
2 - Tạo 1 bảng categories: id, name, amount
CREATE TABLE categories(
id INT(11) AUTO_INCREMENT,
name VARCHAR(255),
amount INT(11),
PRIMARY KEY (id)
);
 */
//+ File mvc_demo/index.php là file index gốc của ứng dụng
//+ Bất cứ 1 mô hình MVC nào cũng phải có 1 file index gốc,
//tên file luôn là index.php
//+ Khi code mô hình MVC, code file index gốc đầu tiên
//+ Mục đích của file này: đón tất cả request từ user gửi
//lên, xử lý để gọi đúng controller tương ứng
// + Về mặt code, cần phân tích url
// + Url trong MVC là do các bạn tự quy định, và với mô
//hình MVC trong khóa học, url luôn có định dạng như sau:
//index.php?controller=<tên-controller>&action=
//<tên-phương-thưc-tương-ứng>&....
//+ File index.php gốc sẽ phân url trên, lấy đc controller
//và action tương ứng, nhúng file chứa class controller này
//, sau đó khởi tạo đối tượng từ class này, lấy đối tượng
//đó gọi đến phương thức action bắt được từ url
//+ Vd: url thêm mới danh mục sẽ kiểu như sau:
//index.php?controller=category&action=create
//+ BẮT ĐẦU CODE
// - Set múi giờ mặc định cho hệ thống
//Cách xác định múi giờ tham khảo ở link:
//https://www.php.net/manual/en/timezones.asia.php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// - Phân tích url để lấy ra controller và action
//index.php?controller=category&action=create
// - Lấy ra controller, nếu ko set thì
// mặc định controller=category
$controller = isset($_GET['controller']) ?
    $_GET['controller'] : 'category';
// - Lấy ra action (phương thức) từ url
$action = isset($_GET['action']) ?
    $_GET['action'] : 'index';
// - Phân tích giá trị của controller, chuyển đổi giá
//trị này thành đúng tên file chứa controller tương ứng
//index.php?controller=category&action=create
//$controller=category
//File cần nhúng: CategoryController.php
// - Chuyển ký tự đầu tiên của controller -> chữ hoa
$controller = ucfirst($controller); //Category
// - Nối thêm chuỗi Controller vào biến $controler
$controller .= "Controller";//CategoryController
// - Tạo biến khác để nối thêm chuỗi .php vào, dùng
//để nhúng file
$controller_file = $controller . ".php";
//CategoryController.php
// - Nhúng file trên vào hệ thống, chú ý trong mô hình MVC
//mọi đường dẫn khi nhúng file đều phải tư duy đứng từ
//file index.php của ứng dụng để nhúng
$path_controller = "controllers/$controller_file";
//controllers/CategoryController.php
//cần kiểm tra đường dãn trên tồn tại thì mới nhúng, nếu
//không sẽ báo Not found
if (!file_exists($path_controller)) {
    die("Trang bạn tìm ko tồn tại");
}
require_once "$path_controller";
//- Sau khi nhúng thành công file controller tương ứng
//chắc chắn đã có class tương ứng, khởi tạo đối tượng
//từ class đó
$object = new $controller();
// - Kiêm tra nếu tồn tại phương thức trong class trên
//thì mới gọi, còn ko thì sẽ die
if (!method_exists($object, $action)) {
    die("Không tồn tại
     phương thức $action trong class $controller");
}
$object->$action();




