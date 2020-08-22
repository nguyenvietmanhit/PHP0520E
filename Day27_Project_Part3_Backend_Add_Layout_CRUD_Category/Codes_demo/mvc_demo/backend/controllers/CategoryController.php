<?php
require_once 'controllers/Controller.php';
require_once 'models/Category.php';
//controllers/CategoryController.php
class CategoryController extends Controller {
  //với hệ thống thực tế, thì sẽ có rất nhiều mvc cho từng
//  chức năng, áp dụng tính chất kế thừa để các class con
//có thể sử dụng lại các thuộc tính và phương thức của class cha
  public function create() {
    //XỬ LÝ SUBMIT FORM
    // + Debug các mảng dữ liệu từ form gửi lên
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    // + Kiểm tra nếu user submit form thì mới xử lý
    if (isset($_POST['submit'])) {
      // + Gán biến trung gian
      $name = $_POST['name'];
      $avatars = $_FILES['avatar'];
      $description = $_POST['description'];
      // + Validate form:
      // Name ko đc để trống, ít nhất 2 ký tự trở lên
      // File upload phải là file ảnh, dung lượng ko quá 2Mb
      if (empty($name)) {
        $this->error = 'Name ko đc để trống';
      } elseif (strlen($name) < 2) {
        $this->error = 'Name phải có ít nhất 2 ký tự';
      } elseif ($avatars['error'] == 0) {
        // Validate file phải là ảnh
        // Lấy ra đuôi file dựa vào tên file
        $extension = pathinfo($avatars['name'],
            PATHINFO_EXTENSION);
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];

        // Lấy dung lượng file upload tính bằng Mb
        //1MB = 1024Kb = 1024*1024 B;
        $size_mb = $avatars['size'] / 1024 / 1024;
        //Giữ lại 2 số sau phần thập phân
        $size_mb = round($size_mb, 2);

        if (!in_array($extension, $extensions)) {
          $this->error = 'File upload phải là ảnh';
        } else if ($size_mb > 2) {
          $this->error = 'File upload ko dc vượt quá 2Mb';
        }
        // + Xử lý logic chỉ khi ko có lỗi xảy ra
        if (empty($this->error)) {
          // Xử lý upload file nếu có
          $avatar = '';
          if ($avatars['error'] == 0) {
            // Khai báo thư mục sẽ upload file
            $dir_upload = 'assets/uploads';
            // Kiểm tra nếu chưa tồn tại thư mục uploads thì mới tạo
            if (!file_exists($dir_upload)) {
              mkdir($dir_upload);
            }
            // Tạo ra tên file mang tính duy nhất để tránh bị upload
            // đè file
            $avatar = time() . '-' . $avatars['name'];
            // Gọi hàm upload file
            move_uploaded_file($avatars['tmp_name'],
                $dir_upload . '/' . $avatar);
          }
          //Lưu dữ liệu vào bảng categories, gọi model Category
          //để lưu
          $category_model = new Category();
          // Xây dựng sẵn phương thức trong model để insert
          //dữ liệu
          // Gán các giá trị từ form cho các thuộc tính của
          //đối tượng trên
          $category_model->name = $name;
          $category_model->avatar = $avatar;
          $category_model->description = $description;
          $is_insert = $category_model->insert();
          var_dump($is_insert);
        }


      }

    }

    //set title page cho chức năng thêm mới
    $this->title_page = 'Trang thêm mới danh mục';
//    echo "CREATE";
    // + Lấy nội dung view create
    $this->content =
    $this->render('views/categories/create.php');
    // + Nhúng file layout để hiển thị nội dung view trên
    require_once 'views/layouts/main.php';
  }
}