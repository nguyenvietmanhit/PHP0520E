<?php
session_start();
//nếu như tồn tại cookie username và password
//thì tương đương user đăng nhập thành công
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    //phải set lại session username
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['success'] = 'Đăng nhập thành công từ cookie';
    header('Location: login_success.php');
    exit();
}


//trong trường hợp user đã login thành công r mà cố tình
//truy cập lại form login (file hiện tại), thì cần chuyển
//hướng họ tới trang đăng nhập thành công
if (isset($_SESSION['username'])) {
    $_SESSION['success'] = 'Bạn đã đăng nhập rồi';
    header('Location: login_success.php');
    exit();
}

//thuc_hanh_session.php
//demo chức năng đăng nhập đơn giản sử dụng session
//trường hợp đăng nhập thành công, username bất kỳ, password > 3
//ký tự
$error = '';
//ko cần khai báo biến $result như các buổi trước
//vì các message thành công sẽ hiển thị ở file khác
//debug thông tin biến $_POST
echo "<pre>";
print_r($_POST);
echo "</pre>";
//kiểm tra xem đã submit hay chưa
if (isset($_POST['submit'])) {
    //gán biến
    $username = $_POST['username'];
    $password = $_POST['password'];
    //validate form,
    // + username phải có định dạng email
    // + username và password ko đc để trống
    if(!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $error = 'Username phải là email';
    } else if (empty($password)) {
        $error = 'Password ko đc để trống';
    }
    //xử lý logic submit form chỉ khi ko có lỗi xảy ra
    if (empty($error)) {
        //lấy ra độ dài của password
        $password_length = strlen($password);
        if ($password_length >= 3) {
            //do trong form có chức năng ghi nhớ đăng nhập
            //nên nếu đăng nhập thành công và có tích vào checkbox
//            Ghi nhớ đăng nhập thì mới lưu cookie username và
            //password
            if (isset($_POST['remember']) && $_POST['remember'] == 1) {
                //khởi tạo 2 cookie có thời gian sống = 120s
                setcookie('username', $username, time() + 1120);
                setcookie('password', $password, time() + 1120);
            }

            //chuyển hướng sang 1 trang khác, tại trang đó
            //sẽ hiển thị username vừa đăng nhập kèm theo thông
            //báo: đăng nhập thành công
            //cần sử dụng session để lưu thông tin username và
            //message thành công để tại file khác có thể sử dụng
            //lại
            $_SESSION['username'] = $username;
            $_SESSION['success'] = 'Đăng nhập thành công';
            //chuyển hướng user sang trang khác, sử dụng hàm
            // header()
            header('Location: login_success.php');
            //kết thúc chuyển hướng luôn dùng hàm exit để đảm
//            bảo chuyển hướng thành công trong mọi trường hợp
            exit();
        } else {
            //nếu hiển thị lỗi vẫn ở trang hiện tại
            //thì sẽ gán thông tin lỗi đó cho biến $error
            $error = 'Sai tài khoản hoặc mật khẩu';
        }
    }
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
<!--chỉ hiển thị session error khi tồn tại-->
<?php if (isset($_SESSION['error'])): ?>
    <h3 style="color: red">
        <?php
        echo $_SESSION['error'];
        //sau khi hiển thị ra lỗi, cần xóa session error đi
        //để các lần refresh trang sau sẽ ko hiển thị nữa
        unset($_SESSION['error']);
        ?>
    </h3>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <h3 style="color: green">
        <?php
        echo $_SESSION['success'];
        //sau khi hiển thị ra thành công, cần xóa session đi
        //để các lần refresh trang sau sẽ ko hiển thị nữa
        unset($_SESSION['success']);
        ?>
    </h3>
<?php endif; ?>

<form action="" method="post">
    Username
    <input type="text" name="username" value="" />
    <br />
    Password:
    <input type="password" name="password" value="" />
    <br />
<!--  nếu chỉ có 1 checkbox duy nhất, thì ko cần khai báo
  name dạng mảng
  vẫn cần check nếu tích vào checkbox thì mới xử lý
  -->
    <input type="checkbox" name="remember" value="1" />
    Ghi nhớ đăng nhập
    <br />
    <input type="submit" name="submit" value="Login" />
</form>

