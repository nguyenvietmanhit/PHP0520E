<?php
session_start();
//nhúng file để sử dụng biến connection
require_once 'database.php';
//crud/create.php
//+ Hiển thị form thêm mới, cần xử lý form
//+ Theo như tên gọi CRUD -> dựng create trước, r đến read ,
// sau đó mới đến update và delete
//+ Bảng categories hiện tại đang có trường sau: id, name,
//description, avatar, created_at
// + XỬ LÝ SUBMIT FORM
$error = '';
//debug thông tin liên quan đến dữ liệu gửi lên từ form
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
//kiểm tra nếu user submit form thì mới xử lý
if (isset($_POST['submit'])) {
  //gán các biến trung gian để thao tác cho dễ
  $name = $_POST['name'];
  $description = $_POST['description'];
  //gán lại thành mảng 1 chiều để thao tác cho dễ
  $avatar_arr = $_FILES['avatar'];
  //Xử lý validate form:
  //+ Name ko đc để trống
  //+ File tải lên phải có dạng ảnh, và dung lương tối đa 2Mb
  if (empty($name)) {
    $error = 'Name ko đc để trống';
  }
  elseif ($avatar_arr['error'] == 0) {
    //xử lý file upload phải có dạng ảnh
    //xử lý lấy ra đuôi file tải lên
    $extension = pathinfo($avatar_arr['name'],
        PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $extension_allowed = ['jpg', 'jpeg', 'png', 'gif'];
    //xử lý lấy dung lương file tải lên theo đơn vị MB
    //đơn vị 1MB = 1024KB = 1024 * 1024B
    $filezise_mb = $avatar_arr['size'] / 1024 / 1024;
    //làm tròn phần thập phân sau phép chia bên trên
    $filezise_mb = round($filezise_mb, 2);
    if (!in_array($extension, $extension_allowed)) {
      $error = 'File upload phải có định dạng ảnh';
    } elseif ($filezise_mb > 2) {
      $error = 'File upload dung lượng ko đc vượt quá 2MB';
    }
  }

  // Xử lý logic form theo như đề bài, trong trường hợp ko có
  //  lỗi validate nào xảy ra
  if (empty($error)) {
    $avatar = '';
    //xử lý upload nếu user có tải file lên
    if ($avatar_arr['error'] == 0) {
      //tạo thư mục upload theo đường dẫn tương đối
      $dir_uploads = 'uploads';
      //tạo thư mục chỉ khi thư mục chưa tồn tại
      if (!file_exists($dir_uploads)) {
        mkdir($dir_uploads);
      }
      //tạo ra tên file mang tính duy nhất, để tránh tình trang
      //bị ghi đè file khi user upload nhiều 1 lần file cùng tên
      $avatar = time() . '-' . $avatar_arr['name'];
      //chuyển file upload từ thư mục tạm đến thư mục đích
      move_uploaded_file($avatar_arr['tmp_name'],
          $dir_uploads . '/' . $avatar);
//     //để format code, dùng phím tắt: Ctrl + Alt + L
    }
    //xử lý lưu các thông tin vào bảng categories
    // + Viết câu truy vấn để thêm dữ liệu, các giá trị khi
    //truyền cho các trường phải có cùng kiểu dữ liệu
    $sql_insert = "
INSERT INTO categories(`name`, `description`, `avatar`)
VALUES ('$name', '$description', '$avatar')";
    //+ Thực thi truy vấn
    $is_insert = mysqli_query($connection, $sql_insert);
//    var_dump($is_insert);
    if ($is_insert) {
      //tạo session chứa thông báo thành công
      //sau đó mới chuyển hướng về trang danh sách
      $_SESSION['success'] = 'Thêm mới danh mục thành công';
      header('Location: index.php');
      exit();
    } else {
      $error = 'Thêm mới thất bại';
    }
  }
}

?>
<h3 style="color: red"><?php echo $error; ?></h3>
<!--ACtion của form thường để là rỗng, chính file khai báo
form sẽ xử lý submit form-->
<!--Do form có input file nên BẮT BUỘC method=post và
phải khai báo enctype-->
<form action="" method="post" enctype="multipart/form-data">
  Nhập tên danh mục:
  <input type="text" name="name" value="" />
  <br />
  Nhập mô tả:
  <textarea name="description" cols="15"></textarea>
  <br />
  Tải ảnh đại diện
  <input type="file" name="avatar" />
  <br />
  <input type="submit" name="submit" value="Lưu" />
  <input type="reset" value="Reset" />
</form>
