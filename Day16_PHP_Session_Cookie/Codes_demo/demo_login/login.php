<?php
session_start();
//nếu user đã tích vào chức năng ghi nhớ đăng nhập khi đăng nhập
//thành công, cần xử lý chuyển hướng họ về trang success.php
//kiểm tra nếu tồn tại cookie username và password thì sẽ chuyển
//hướng
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
  //cần phải khởi tạo session liên quan đến username
  $_SESSION['username'] = $_COOKIE['username'];
  $_SESSION['success'] = 'Auto login';
  header('Location: success.php');
  exit();
}

//sẽ có trường hợp user đã login thành công nhưng vẫn truy cập lại
//được vào trang login.php hiện tại thì là ko hợp lý
//cần phải xử lý: nếu user đã login rồi mà truy cập lại vào file
//này thì chuyển hướng về trang đăng nhập thành công
if (isset($_SESSION['username'])) {
  $_SESSION['success'] = 'Bạn đã đăng nhập rồi';
  header('Location: success.php');
  exit();
}


//Tạo cấu trúc thư mục như sau:
//demo_login/
//          /login.php: xử lý form login
//          /success.php: hiển thị thông tin khi user login
                        //thành công

//Bài toán: nhập username, password. Nếu username là kiểu email và
//mật khẩu có độ dài > 3 ký tự -> đăng nhập thành công, ngược lại
//là sai tài khoản hoặc mật khẩu
//XỬ LÝ SUBMIT FORM
//1 - khởi tạo biến chứa thông tin lỗi và thành công
$error = '';
$result = '';
//2 - Debug thông tin mảng dựa vào phương thức hiện tại của form
echo "<pre>";
print_r($_POST);
echo "</pre>";
//3 - Nếu user submit form thì mới xử lý
if (isset($_POST['login'])) {
  //tạo biến trung gian để gán giá trị
  $username = $_POST['username'];
  $password = $_POST['password'];
  //chưa xử lý chức năng ghi nhớ đăng nhập tại thời điểm này
  //mà chức năng này chỉ đc xử lý lưu cookie khi đăng nhập thành
  //công
  //4 - Xử lý validate form:
  // + Username, password ko đc để trống
  // + Username phải có định dạng email
  if (empty($username) || empty($password)) {
    $error = 'Username hoặc password ko đc để trống';
  } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $error = 'Username phải có định dạng email';
  }
//  5 - Xử lý logic submit form theo  yêu cầu đề bài chỉ khi nào
  //ko có lỗi xảy ra
  if (empty($error)) {
    //điều kiện đăng nhập thành công: username là email và password
    //có độ dài >= 3 ký tự
    if (strlen($password) >= 3) {
      //nếu có tích vào checkbox ghi nhớ đăng nhập, thì sẽ lưu cookie
      //username và password
      if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
        //set thời gian sống = 1h = 3600s
        setcookie('username', $username, time() + 3600);
        setcookie('password', $password, time() + 3600);
      }

      //khi đăng nhập thành công, thì hiển thị username vừa đăng nhập
      //kèm theo thông báo Đăng nhập thành công ở file success.php
      //nên cần sử dụng session để lưu các thông tin này
      $_SESSION['username'] = $username;
      $_SESSION['success'] = 'Đăng nhập thành công';
      //sử dụng hàm chuyển hướng tới url khác, là hàm header()
      //hàm này luôn có từ khóa cố định là Location:, theo sau là url
      //dang domain hoặc đường dẫn tương đối
      header("Location: success.php");
      //kết thúc header luôn phải có hàm exit() để tránh trường hợp
      //ko chuyển hướng được
      exit();
    } else {
      $error = 'Sai tài khoản hoặc mật khẩu';
    }
  }
}
?>

<?php
//hiển thị ra thông báo lỗi liên quan đến session có key=error
//luôn kiểm tra nếu tồn tại session theo key đó thì mới xử lý đc
if (isset($_SESSION['error'])) {
  $session_error = $_SESSION['error'];
  echo "<h3 style='color: red'>$session_error</h3>";
  //sau khi hiển thị xóa luôn session error này, để tránh trường
  //hợp refresh lại trang đó vẫn còn session
  unset($_SESSION['error']);
}
//hiển thị thông báo thành công liên quan đến session key=success
if (isset($_SESSION['success'])) {
  $session_success = $_SESSION['success'];
  echo "<h3 style='color: green'>$session_success</h3>";
  unset($_SESSION['success']);
}
?>

<h3 style="color: red"><?php echo $error; ?></h3>
<form action="" method="post">
  Username: <input type="text" name="username" value="" />
  <br />
  Password: <input type="password" name="password" />
  <br />
<!-- nếu như chỉ có 1 checkbox hoặc 1 radio duy nhất, thì
 name của input đó ko cần ở dạng mảng, name ở dạng mảng
 chỉ cần khi có nhiều input checkbox/radio-->
  <input type="checkbox" name="remember_me" value="1" />
  Ghi nhớ đăng nhập
  <br />
  <input type="submit" name="login" value="Đăng nhập" />
</form>
