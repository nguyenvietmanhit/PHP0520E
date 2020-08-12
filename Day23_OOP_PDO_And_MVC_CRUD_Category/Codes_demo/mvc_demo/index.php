<?php
//mvc_demo/index.php
//file index gốc của ứng dụng
/**
 * 1 - Mục đích: Xây dựng 1 ứng dụng web CRUD Danh mục
 * dựa trên mô hình MVC thuần
 * 2 - Tạo CSDL: php0520e_mvc
 * CREATE DATABASE IF NOT EXISTS php0520e_mvc
CHARACTER SET utf8 COLLATE utf8_general_ci;
 * 3 - Tạo bảng: categories: id, name, amount
 * CREATE TABLE categories(
  id INT(11) AUTO_INCREMENT,
  name VARCHAR(255),
  amount INT(11),
  PRIMARY KEY (id)
  );
 *
 * + Với mô hình MVC, sẽ code file đầu tiên
 * là file index.php gốc của ứng dụng
 * + File index gốc của ứng dụng là sẽ là nơi đầu tiên nhận dc
 * các request từ user gửi lên, sau đó phân tích URL của user, và
 * gọi đúng controller cần thiết xử lý
 * + Mọi framework cũng như CMS của PHP đều có 1 file index.php gốc
 * này
 * + Về mặt code, cần phân tích URL để lấy ra đc controller và
 * action (phương thức) tương ứng, nhúng class controller đó vào,
 * khởi tạo đối tượng từ controller đó, dùng đối tượng đó truy
 * cập phương thức
 * + Do mô hình MVC là do bạn tự định nghĩa cấu trúc thư mục, nên
 * URL cũng là do bạn tự định nghĩa ra, với khóa học thì URL bắt
 * buộc phải có định dạng như sau:
 * index.php?controller=<tên-class-controller>
 * &action=<tên-phương-thức-tương-ứng-của-class>&.....
 * + Với mô hình MVC, luôn tư duy là đang đứng tại file index.php
 * gốc của ứng dụng để nhúng file, và luôn phải chạy ứng dụng
 * từ file index gốc, chứ ko chạy thẳng file như từ trước đến giờ
 * + VD 1 URL cho chức năng tạo mới danh mục:
 * http://localhost/mvc_demo/index.php
 * ?controller=category&action=create
 *
 */
// + Lấy ra các giá trị của tham số controller và action từ url
//, cần check nếu ko truyền lên thì sẽ set controller/action mặc d
//định nào đó
$controller = isset($_GET['controller']) ? $_GET['controller'] :
    'home'; //category
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
//create
// + Chuyển đổi giá trị của controller thành tên file tương ứng
//để nhúng, category -> CategoryController, chú ý tên file
// controller trong mô hình MVC hiện tại luôn là <tên>Controller
//Chuyển ký tự đầu tiên thành ký tự hóa
$controller = ucfirst($controller); //Category
$controller .= "Controller"; //CategoryController
// + Tạo biến chứa đường dẫn đến file controller vừa lấy dc, để
//chuẩn bị nhúng file
$path_controller = "controllers/$controller.php";
//controllers/CategoryController.php
// + Nhúng file controller theo đường dẫn trên, tuy nhiên cần phải
//xử lý nếu đường dẫn ko tồn tại thì báo lỗi
if (!file_exists($path_controller)) {
  die("Trang bạn tìm ko tồn tại");
}

// + Thực hiện nhúng file
require_once "$path_controller";
// + Khởi tạo đối tượng từ class controller sau khi nhúng file
$obj = new $controller();
//+ Trước khi truy cập phương thức $action, cần phải kiểm tra nếu
//tồn tại phương thức đó trong controller thì mới truy cập đc
if (!method_exists($obj, $action)) {
  die("Không tồn tại phương thức $action trong class $controller");
}
// + Dùng đối tượng truy cập phương thức
$obj->$action();
//index.php?controlle
//r=category&action=create
$_COOKIE['cart'] = [
  'nvmanh' => [
    1 => [
      'name' => 'SP1',
      'price' => 123456,
      'avatar' => 'avatar.jpg',
      'quantity' => 4
    ]
  ]
];