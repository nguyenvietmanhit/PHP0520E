<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 3/13/2020
 * Time: 11:02 PM
 */

class Controller
{
    // + Sau khi xây dựng chức năng login, cần phải check các lỗi
    //bảo mật với chức năng login, vd:
    // - Nếu chưa login thì ko cho phép truy cập backend
    // - Nếu login rồi thì ko cho truy cập lại form login
    // + Việc check bảo mật về login sẽ check tại phương thức
    //khởi tạo của class cha
    // Phương thức khởi tạo là phương thức đc chạy đầu tiên khi
    //khởi tạo đối tượng
    //
    public function __construct() {
      //+ Với điều kiện hiện tại sẽ bị lỗi Chuyển hướng quá nhiều
      //lần
      // + Để fix trường hợp này, loại trừ controller=user
      if (!isset($_SESSION['user'])
          && $_GET['controller'] != 'user') {
        $_SESSION['error'] = 'Bạn chưa đăng nhập';
        header
        ('Location: index.php?controller=user&action=login');
        exit();
      }
    }

  //chứa nội dung view
    public $content;
    //chứa nội dung lỗi validate
    public $error;

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = []) {

        //Nhập các giá trị của mảng vào các biến có tên tương ứng chính là key của phần tử đó.
        //khi muốn sử dụng biến từ bên ngoài vào trong hàm
        extract($variables);
        //bắt đầu nhớ mọi nội dung kể từ khi khai báo, kiểu như lưu vào bộ nhớ tạm
        ob_start();
        //thông thường nếu ko có ob_start thì sẽ hiển thị 1 dòng echo lên màn hình
        //tuy nhiên do dùng ob_Start nên nội dung của nó đã đc lưu lại, chứ ko hiển thị ra màn hình nữa
        require_once $file;
        //lấy dữ liệu từ bộ nhớ tạm đã lưu khi gọi hàm ob_Start để xử lý, lấy xong rồi xóa luôn dữ liệu đó
        $render_view = ob_get_clean();

        return $render_view;
    }
}