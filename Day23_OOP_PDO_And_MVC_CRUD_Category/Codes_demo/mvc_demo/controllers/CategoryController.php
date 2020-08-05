<?php
//luôn tư duy đứng từ file index gốc để nhúng file
require_once 'models/Category.php';
//mvc_demo/controllers/CategoryController.php
//Class controller quản lý danh mục
class CategoryController {
  //thuộc tính chứa nội dung view động, dc hiển thị trong
  //file layout
  public $content;
  //thuộc tính chứa thông tin lỗi, đc hiển thị trong layout
  public $error;

  //Xây dựng 1 phương thức dùng để lấy nội dung view
  //từ đường dẫn cho trước, và có xử lý nếu như view đó có thao
  //tác với biến từ controller truyền sang view
  // $view_path: đường dẫn tới file view muốn lấy nội dung
  // $variables: 1 mảng chứa các biến sẽ xử lý ở view đó
  public function render($view_path, $variables = []) {
    $render_view = '';
    //để sử dụng đc các biến bên trong view, cần giải nén biến đó
    extract($variables);
    //bắt đầu ghi nhớ việc đọc nội dung file view
    ob_start();
    //Nhúng file view vào để đọc nội dung
    require_once "$view_path";
    //kết thúc việc đọc file
    $render_view = ob_get_clean();
    return $render_view;
  }

  //tạo phương thức thêm mới danh mục
  public function create() {
    //+ Việc xử lý form luôn viết ở trên phần hiển thị layouts
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    //Nếu user submit form
    if (isset($_POST['submit'])) {
      //tạo biến trung gian
      $name = $_POST['name'];
      $amount = $_POST['amount'];
      // Validate form: ko đc để trống cả 2 trường
      if (empty($name) || empty($amount)) {
        $this->error = 'Không dc để trống các trường';
      }
      //Xử lý lưu dữ liệu chỉ khi ko có lỗi xảy ra
      if (empty($this->error)) {
        // Theo đúng mô hình MVC, controller sẽ ko trực tiếp
        //lưu vào CSDL, mà sẽ gọi model để nhờ model lưu
        // + Nhúng model Category vào, nhúng trên đầu file để
        //tất cả các chức năng sau đều sử dụng chung
        // + Khởi tạo đối tượng từ model
        $category_model = new Category();
        //Gán các giá trị từ form cho các thuộc tính của model
        $category_model->name = $name;
        $category_model->amount = $amount;
        // + Gọi phương thức của model để insert data
        $is_insert = $category_model->insert();
        if ($is_insert) {
          $_SESSION['success'] = 'Thêm mới thành công';
          //chuyển hướng về trang ds
          header
          ('Location: index.php?controller=category&action=index');
          exit();
        } else {
          $this->error = "Thêm mới thất bại";
        }

      }
    }

    // + Cần xử lý để lấy nội dung view tương ứng, đặt đúng
    //vào vị trí nội dung động trong file layout
    $this->content =
        $this->render("views/categories/create.php");
    // + Ko nên gọi thẳng view ra, mà sẽ gọi file layout vào
    require_once 'views/layouts/main.php';
  }

//  url truy cập chúc năng liệt kê danh mục như sau:
// index.php?controller=category&action=index
  public function index() {
    echo "Bảng danh mục";
  }
}