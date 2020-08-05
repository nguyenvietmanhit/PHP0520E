<?php
//mvc_demo/controllers/CategoryController.php
//Class controller quản lý danh mục
// + Nhúng model Category trên đầu file, để tất cả
//các phương thức khác của class đếu sử dụng đc
require_once 'models/Category.php';

class CategoryController {
    //khai báo 1 thuộc tính thể hiện cho nội dung động
    //của từng view
    public $content;
    //khai báo thuộc tính hiển thị lỗi
    public $error;

    public function index() {
       $this->content = "Bảng liệt kê danh mục";
        require_once 'views/layouts/main.php';
    }
    //tạo phương thức thêm mới danh mục
    public function create() {
        //+ Xử lý submit form, do action của form đang
        //để rỗng nên chính url hiện tại sẽ xử lý form
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        // + Lưu ý, xử lý submit form, vị trí của nó
        //cần đứng trước phần hiển thị view
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $amount = $_POST['amount'];
            // + Xử lý validate form: 2 trường bắt buộc
            //phải nhập
            if (empty($name) || empty($amount)) {
                $this->error = 'Name hoặc amount phải nhập';
            }
            //+ Xử lý lưu dữ liệu vào bảng categories chỉ khi
            //không có lỗi validate
            if (empty($this->error)) {
                //+ Theo đúng mô hình MVC, sẽ gọi model để
                //insert vào DB, chứ ko lưu trực tiếp tại
                //đây
                //+ Nhúng file model tương ứng nhúng ở đầu file
                $category_model = new Category();
                //+ Gán các giá trị từ form cho các thuộc
                //tính của model
                $category_model->name = $name;
                $category_model->amount = $amount;
                //+ Gọi phương thức insert trên model
                //để lưu vào bảng categories
                $is_insert = $category_model->insert();
                var_dump($is_insert);
                if ($is_insert) {
                    $_SESSION['success'] = 'THêm mới thành công';
                    header('Location: 
                    index.php?controller=category&action=index');
                    exit();
                } else {
                    $this->error = "Thêm mới thất bại";
                }
            }

        }
        //+ Cần phải lấy đc nội dung view create.php
        //tương ứng, đổ vào thuộc tính content
        $this->content =
            $this->render('views/categories/create.php');
//        $this->content = "Form thêm mới";
//        index.php?controller=category&action=create
//        echo "Phương thức create";
        //gọi layout để hiển thị view tương ứng
        //nhúng file layout tương ứng vào
        require_once 'views/layouts/main.php';
    }
    //phương thức update
    public function update() {
        echo "Phương thức update";
    }
    //phương thức detail
    public function detail() {
        echo "PHương thức detail";
    }
    //phương thức delete
    public function delete() {
        echo "Phương thức delete";
    }

    //phương thức lấy nội dung view động dựa vào
    //đường dẫn tới file view đó
    //có 2 tham số:
    // + $file: đường dẫn tới file muốn lấy
    // + $variables: mảng kết hợp chứa các biến muốn
    //sử dụng ở file view tương ứng
    public function render($file, $variables = []) {
        $render_view = '';
        //+ khi muốn sử dụng biến từ bên ngoài trong view,
        //cần sử dụng hàm sau
        extract($variables);
        //+ sử dụng hàm sau để ghi nhớ việc đọc nội dung
        //view, lưu tạm vào bộ nhớ
        ob_start();
        //+ nhúng view vào để lấy nội dung
        require_once "$file";
        //+ Kết thúc việc đọc nội dung file
        $render_view = ob_get_clean();
        return $render_view;
    }

}