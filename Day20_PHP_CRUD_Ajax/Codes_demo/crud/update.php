<?php
session_start();
require_once 'database.php';
//crud/update.php
//Hiển thị 1 form chứa các thông tin mặc định cho bản ghi
//tương ứng, form hiển thị về mặt cấu trúc form sẽ giống hệt
//form của chức năng Thêm mới
//CÁc bước cần thực hiện để xử lý update
// 1 - Truy cập CSDL để lấy ra bản ghi tương ứng dựa vào
//id bắt từ url, hiển thị các giá trị lấy đc từ bản ghi
//ra các input của form thông qua thuộc tính value
// 2 - Xử lý submit form khi user click Cập nhật, về mặt cơ
//bản thì khá giống việc xử lý form với chức năng thêm mới, chỉ
//khác ở viêc xử lý upload lên, trong trường hợp bản ghi đã tồn
//tại trường avatar r thì khi cập nhật sẽ có 2 trường hợp xảy ra:
// + User ko up đè ảnh -> giữ phải nguyên đường dẫn ảnh cũ
// + User up đè ảnh -> upload ảnh mới như bình thường, xóa ảnh
//cũ đi để tránh rác hệ thống, dùng hàm
// unlink('đường-dẫn-tương-đối') để xóa


//1 - LẤy dữ liệu tương ứng với bản ghi dựa theo id truyền từ
//trình duyêt
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  $_SESSION['error'] = 'ID ko hợp lệ';
  header('Location: index.php');
  exit();
}
$id = $_GET['id'];
//lấy danh mục theo id lấy đc
// + Tạo câu truy vấn
$sql_select_one = "SELECT * FROM categories WHERE id = $id";
// + Thực thi truy vấn
$result_one = mysqli_query($connection, $sql_select_one);
// + lấy dữ liệu dưới dạng mảng kết hợp
$category = mysqli_fetch_assoc($result_one);
if (empty($category)) {
  echo "Bản ghi với id = $id ko tồn tại";
  //sử dụng từ khóa return để ngăn ngừa code phía sau chạy
  return;
}

//2  - Xử lý submit form, bước này sẽ dựa trên chức năng thêm mới
//copy code xử lý submit form từ chức năng thêm mới -> update
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
    //với chức năng update, thì tên file ban đầu đã có giá trị
    //dựa vào thông tin bản ghi lấy đc theo id
    $avatar = $category['avatar'];
    //xử lý upload nếu user có tải file lên
    if ($avatar_arr['error'] == 0) {
      //xóa file ảnh cũ đi, để tránh rác hệ thống, sau đó mới upload
      //đè lại
      @unlink("uploads/$avatar");
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
    //xử lý cập nhật các thông tin vào bảng categories
    // + Tạo câu truy vấn cập nhật
    $sql_upate = "UPDATE categories SET `name` = '$name',
                 `description` = '$description', 
                 `avatar` = '$avatar' WHERE id = $id";
    // + Thực thi truy vấn
    $is_update = mysqli_query($connection, $sql_upate);
    if ($is_update) {
      //tạo session chứa thông báo thành công
      //sau đó mới chuyển hướng về trang danh sách
      $_SESSION['success'] = 'Cập nhật danh mục thành công';
      header('Location: index.php');
      exit();
    } else {
      $error = 'Cập nhật thất bại';
    }
  }
}
?>
<!--Copy form thêm mới sang cho form update-->
<h3 style="color: red"><?php echo $error; ?></h3>
<!--ACtion của form thường để là rỗng, chính file khai báo
form sẽ xử lý submit form-->
<!--Do form có input file nên BẮT BUỘC method=post và
phải khai báo enctype-->
<form action="" method="post" enctype="multipart/form-data">
  Nhập tên danh mục:
  <input type="text" name="name"
value="<?php echo $category['name']; ?>" />
  <br />
  Nhập mô tả:
  <textarea name="description" cols="15"><?php echo $category['description']; ?></textarea>
  <br />
  Tải ảnh đại diện
  <input type="file" name="avatar" />
  <img src="uploads/<?php echo $category['avatar']; ?>"
       height="80px" />
  <br />
  <input type="submit" name="submit" value="Cập nhật" />
  <input type="reset" value="Reset" />
</form>


