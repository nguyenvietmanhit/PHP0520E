<?php
//thuc_hanh_form_2.php
//xử lý form đăng nhập, gồm 2 input nhập username và password
//slide Thực hành 2
//XỬ LÝ FORM
//1 - Debug thông tin dựa vào method form
echo "<pre>";
print_r($_POST);
echo "</pre>";
//2 - Tạo các biến chứa lỗi và kết quả
$error = '';
$result = '';
//3 - Kiểm tra xem đã submit form hay chưa, nếu submit form
//thì mới xử lý
if (isset($_POST['login'])) {
  //tạo biến trung gian và gán giá trị
  $username = $_POST['username'];
  $password = $_POST['password'];
  //4 - Xử lý validate form:
  // + Username, password ko đc để trống
  // -> dùng hàm empty()
  // + Username phải có định dạng email
  // -> dùng hàm filter_var()
  // + Password phải có độ dài >= 6 ký tự
  // -> dùng hàm strlen()
  if (empty($username) || empty($password)) {
    $error = 'Username hoặc password ko đc để trống';
  } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $error = 'Username phải có định dạng email';
  } elseif (strlen($password) < 6) {
    $error = 'Password ko đc < 6 ký tự';
  }
//  5 - Xử lý logic submit form theo yêu cầu đề bài chỉ khi nào
//ko có lỗi xảy ra
  if (empty($error)) {
    if ($username == 'nguyenvietmanhit@gmail.com'
        && $password == 123456) {
      $result = 'Đăng nhập thành công';
    } else {
      $error = 'Sai tài khoản hoặc mật khẩu';
    }
  }
}
?>
<!--7 - Hiển thị biến error và result ra màn hình-->
<h3 style="color: red"><?php echo $error; ?></h3>
<h3 style="color: green"><?php echo $result; ?></h3>
<!--8 - Đổ dữ liệu ra form -> bỏ qua cho đỡ mất thời gian-->
<form action="" method="post">
  Username:
  <input type="text" name="username" value="" />
  <br />
  Password:
  <input type="password" name="password" value="" />
  <br />
  <input type="submit" name="login" value="Đăng nhập" />
</form>


