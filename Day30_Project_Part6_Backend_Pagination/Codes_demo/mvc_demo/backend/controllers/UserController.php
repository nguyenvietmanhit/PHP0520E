<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';

class UserController extends Controller {
  //Chức năng đăng ký:index.php?controller=user&action=register
  public function register() {
    //Xử lý submit form
    // + Debug mảng $_POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // + Nếu user submit thì mới xử lý
    if (isset($_POST['register'])) {
      // + Tạo biến, gán giá trị
      $username = $_POST['username'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      // + Validate form:
      // Các trường ko đc để trống
      // Mật khẩu nhập lại phải trùng với mật khẩu
      if (empty($username) || empty($password)
          || empty($confirm_password)) {
        $this->error = 'Các trường ko đc để trống';
      } elseif ($password != $confirm_password) {
        $this->error = 'Mật khẩu phải trùng nhau';
      }
      // + Xử lý logic bài toán chỉ khi ko có lỗi xảy ra
      if (empty($this->error)) {
        // + Kiểm tra xem username đã tồn tại trong CSDL hay chưa
        //, cần gọi model để truy vấn CSDL
        $user_model = new User();
        $is_exist_username =
            $user_model->isExistUsername($username);
//        var_dump($is_exist_username);
        // + Nếu tồn tại username thì báo lỗi
        if ($is_exist_username) {
          $this->error = 'Username này đã tồn tại';
        } else {
          // + Đăng ký user:
          // Cần mã hóa mật khẩu trước khi so sánh với
//          trường password của bảng users, sử dụng mã hóa
          //md5 thông qua 1 hàm của php: md5(password)
          $password = md5($password);
          $is_register =
              $user_model->register($username, $password);
          if ($is_register) {
            $_SESSION['success'] = 'Đăng ký thành công';
            header
            ('Location: index.php?controller=user&action=login');
            exit();
          } else {
            $this->error = 'Có lỗi, ko thể đăng ký';
          }
        }
      }
    }

    //+ Lấy nội dung file view register.php
    $this->content =
    $this->render('views/users/register.php');
    //+ Gọi layout để hiển thị ra nội dung file vừa lấy đc
    //Do giao diện chức năng đky đang khác so với giao diện
    //chính -> taọ 1 file layout mới
    // views/layouts/main_login.php
    // Copy layout chính main.php -> main_login.php, chỉnh sửa
    // cho phù hợp

    require_once 'views/layouts/main_login.php';
  }

  //Xử lý login
  public function login() {
    // Xử lý submit form
    // + Debug mảng $_POST
    // Có thể tham khảo công cụ Tools/Save As Live templates
    //để dùng các phím tắt tự động sinh các mã code
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // + Nếu user submit form thì mới xử lý
    if (isset($_POST['login'])) {
      // + Tạo biến và gán giá trị
      $username = $_POST['username'];
      $password = $_POST['password'];
      // + Validate form:
      // Các trường ko đc để trống
      if (empty($username) || empty($password)) {
        $this->error = 'Ko đc để trống';
      }
      // + Xử lý logic bài toán chỉ khi ko có lỗi xảy ra
      if (empty($this->error)) {
        // + Xử lý login
        $user_model = new User();
        // + Với chức năng đăng nhập, ko trả về true/false, vì
        //khi đăng nhập thành công, mà cần trả về đối tượng
        //user tương ứng để hiển thị trong giao diện admin
        //khi đăng nhập thành công, dùng session để lưu lại
        //đối tượng hiện tại
        // + Cần mã hóa password theo đúng cơ chế đã lưu vào
        //trong CSDL , md5
        $password = md5($password);
        $user = $user_model->getUser($username, $password);
        if (!empty($user)) {
          $_SESSION['user'] = $user;
          $_SESSION['success'] = 'Đăng nhập thành công';
          header
          ('Location: index.php?controller=product&action=index');
          exit();
        } else {
          $this->error = 'Sai tài khoản hoặc mật khẩu';
        }
      }
    }

    // + Lấy nội dung view tương ứng: views/users/login.php
    $this->content =
    $this->render('views/users/login.php');
    // + Gọi layout để hiển thị nội dung vừa lấy đc
    require_once 'views/layouts/main_login.php';
  }

  //Phương thức để logout khỏi hệ thống
  //index.php?controller=user&action=logout
  public function logout() {
    // Chức này sẽ ko có view, sau khi logout thành công ->
    //chuyển hướng về trang login
    unset($_SESSION['user']);
    //ko nên sử dụng session_destroy nếu
    // muốn hiển thị 1 thông báo bằng session
    // vì sẽ xóa mọi session đang tồn tại trên hệ thống
//    session_destroy();
    $_SESSION['success'] = 'Đăng xuất thành công';
    header('Location: index.php?controller=user&action=login');
    exit();
  }
}