<?php
session_start();
//nhúng file database.php vào để sử dụng đc biến $connection
require_once 'database.php';
//crud/create.php
//Thông thường sẽ code chức năng thêm mới trước, vì CSDL ban
//đầu đang chưa có dữ liệu
//Chứa form thêm mới
//bảng categories đang có trường:
//id, name, description, avatar, created_at
//do trường id và created_at đã sinh tự động nên chỉ tạo 3
//input trong form để lấy giá trị của name, description, avatar

//XỬ LÝ FORM THÊM MỚI: lưu các thông tin mà user nhập từ form
//vào trong bảng categories
// 1- khai báo các biến chứa lỗi và kết quả
$error = '';
$result = '';
//2 - debug các thông tin liên quan đến mảng $_POST, $_FILES
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
//3 - Check nếu như user submit form thì mới xử lý form
if (isset($_POST['submit'])) {
    //khai báo biến trung gian để thao tác cho dễ
    $name = $_POST['name'];
    $description = $_POST['description'];
    $avatar_arr = $_FILES['avatar'];
    //4 - Validate form:
    // + Name và description ko đc để trống
    // + File upload phải có dạng ảnh, dung lượng ko quá 2Mb
    //bất cứ lỗi nào xảy ra, đổ dữ liệu cho biến $error
    if (empty($name) || empty($description)) {
        $error = 'Name hoặc description ko đc để trống';
    }
    //chỉ xử lý validate file upload nếu có file đc tải lên
    //dựa vào thuộc tính error của mảng $_FILES
    else if ($avatar_arr['error'] == 0) {
        //validate file upload phải có dạng ảnh
        //lấy ra đuôi file
        $extension = pathinfo($avatar_arr['name'],
            PATHINFO_EXTENSION);
        // chuyển về ký tự thường
        $extension = strtolower($extension);
        //tạo mảng chứa các đuôi file ảnh hợp lệ
        $extension_allowed = ['jpg', 'png', 'gif', 'jpeg'];
        //lấy dung lượng của file upload theo đơn vị Mb
        //1MB = 1024KB = 1024 * 1024 B
        $file_size_mb = $avatar_arr['size'] / 1024 / 1024;
        //giữ lại 2 số thập phân sau dấu .
        $file_size_mb = round($file_size_mb, 2);
        if (!in_array($extension, $extension_allowed)) {
            $error = 'Cần upload file dạng ảnh';
        } elseif ($file_size_mb > 2) {
            $error = 'File upload ko đc vượt quá 2MB';
        }
    }
    //5 - Xử lý upload file nếu có và lưu vào bảng categories
    //chỉ xử lý khi ko có lỗi xảy ra
    if (empty($error)) {
        $avatar = '';
        //xử lý upload file nếu có hành động upload
        if ($avatar_arr['error'] == 0) {
            //tạo thư mục chứa file sẽ upload lên
            //tạo thư mục có tên = uploads, ngang hàng với file
            //hiện tại
            $dir_uploads = 'uploads';
            //tạo thư mục chỉ khi thư mục chưa tồn tại
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            //tạo ra tên file mang tính duy nhất, để tránh trường
            //hợp bị đè file khi user upload cùng 1 file lên hệ
            //thống nhiều lần
            $avatar = time() . '-' . $avatar_arr['name'];
            //upload file từ thư mục tạm của XAMPP vào trong
            //thư mục uploads bạn đã tạo
            move_uploaded_file($avatar_arr['tmp_name'],
                $dir_uploads . '/' . $avatar);
        }
        //xử lý lưu dữ liệu vào bảng categories
        // + tạo câu truy vấn
        //dùng cặp ký tự `` để bao lấy các trường để tránh trường
        //tên trường bị trùng với từ khóa của MySQL
        //ngoài ra, giá trị tương ứng của trường phải đúng với
        //kiểu dữ liệu của trường đó trong bảng
        $sql_insert =
    "INSERT INTO categories(`name`, `description`, `avatar`)
      VALUES ('$name', '$description', '$avatar')";
        // + Thực thi truy vấn vừa tạo
        //với các truy vấn INSERT, UPDATE, DELETE thì hàm
        //mysqli_query luôn trả về giá trị true/false
        $is_insert = mysqli_query($connection, $sql_insert);
//        var_dump($is_insert);
        if ($is_insert) {
            $_SESSION['success'] = 'Insert thành công';
            header('Location: index.php');
            exit();
        } else {
            $error = 'Insert thất bại';
        }
    }
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
<!--do trong form có input file nên bắt buộc
phương thức của form phải là post và phải khai báo enctype-->
<form action="" method="post" enctype="multipart/form-data">
    Name:
    <input type="text" name="name" value="" />
    <br />
    Description:
    <textarea name="description" cols="20"></textarea>
    <br />
    Upload avatar:
    <input type="file" name="avatar" />
    <br />
    <input type="submit" name="submit" value="Save" />
    <a href="index.php">Cancel</a>
</form>
