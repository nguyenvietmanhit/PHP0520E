<?php
//form_upload.php
//DEMO XỬ LÝ UPLOAD FILE TRONG FORM
// + Nếu trong form của bạn mà có input type=file, thì khi đó
//thẻ <form> bắt buộc phải có 2 điều kiện sau:
// - Phương thức của form phải là POST
// - PHải thêm cặp thuộc tính và giá trị sau cho thẻ form:
//enctype='multipart/form-data'
// + PHP đã có sẵn 1 biến toàn cục lưu toàn bộ thông tin liên
//quan đến file upload, là $_FILES, ko thể dùng $_POST để lấy thông
//tin của file upload
// + Input file có thể cho phép upload nhiều file cùng lúc, bằng
//cách thêm thuộc tính multiple, khi đó thuộc tính name của input
//file đó sẽ ở dạng mảng,
// <input type='file' name='upload[]' multiple />


//debug thông tin mảng $_POST xem có lấy đc thông tin file upload ko
echo "<pre>";
print_r($_POST);
echo "</pre>";
//như vậy $_POST sẽ ko lấy thông tin của file upload
//sẽ phải sử dụng mảng $_FILES để lấy thông tin file upload
//đây là mảng 2 chiều
echo "<pre>";
print_r($_FILES);
echo "</pre>";
//Mảng $_FILES là mảng 2 chiều, có 5 thuộc tính sau:
// + name: tên file upload
// + type: kiểu dữ liệu của file
// + tmp_name: đường dẫn tạm của file upload, khi upload file thì
//XAMPP đã tự động chuyển file đó vào 1 thư mục tạm nó XAMPP quản lý
// + error: trạng thái lỗi khi upload, có 1 số giá trị sau:
// 0: quá trình upload file lên đường dẫn tạm ko có lỗi
// 1: báo lỗi liên quan đến file upload vượt quá dung lượng cho phép
// trong file cấu hình hệ thống
// 2: báo lỗi số file upload vượt quá số file cho phép của hệ thống
//...
// Chỉ cần quan tâm đến giá trị = 0, nếu error = 0 -> ko có lỗi,
//nếu error != 0 -> có lỗi
// + size: dung lượng của file upload, đơn vị là Byte, về đơn vị:
// 1Mb = 1024Kb = 1024 * 1024B (Byte)

//XỬ LÝ SUBMIT FORM
//1 - tạo các biến lưu lỗi và kết quả
$error = '';
$result = '';
//2 - debug thông tin mảng $_POST và $_FILES
//3 - Chỉ xử lý form nếu đã submit form
if (isset($_POST['submit'])) {
  //tạo biến trung gian
  $upload_arr = $_FILES['upload'];
  //4 - Xử lý validate form:
  // + FIle upload phải có định dạng ảnh: png, jpg, gif, jpeg
  // + File upload dung lượng ko đc vượt quá 0.1Mb
  //khi xử lý file, luôn phải kiểm tra nếu có file đc upload lên
  //thì mới xử lý đc, dựa vào thuộc tính error của mảng $_FILES
  if ($upload_arr['error'] == 0) {
    //+ Xử lý validate cho file upload phải có dạng ảnh
    $extension = pathinfo($upload_arr['name'],
        PATHINFO_EXTENSION);
//    var_dump($extension);
    //chuyển đuôi file về chữ thường
    $extension = strtolower($extension);
    //khai báo 1 mảng chứa các phần tử là các đuôi file ảnh hợp lệ
    $extension_allowed = ['png', 'jpg', 'gif', 'jpeg'];

    // + Xử lý dung lương file upload ko đc vượt quá 0.1Mb
    //chuyển đổi đơn vị từ B -> MB
    $file_size_mb = $upload_arr['size'] / 1024 / 1024;
//    var_dump($file_size_mb);
    //giữ lại 1 đơn vị sau phần thập phân, để nhìn cho tiện
    $file_size_mb = round($file_size_mb, 1);
//    var_dump($file_size_mb);
    if (!in_array($extension, $extension_allowed)) {
      $error = 'Phải upload file dạng ảnh';
    } else if ($file_size_mb > 2) {
      $error = 'File upload dung lương ko đc vượt quá 2MB';
    }

//5 - Xử lý logic submit form theo yêu cầu đề bài, đề bài yêu cầu
////nếu co file upload lên thì tạo thư mục uploads, sau đó tải file
/// vào thư mục này
    if (empty($error)) {
      //vẫn phải check nếu có file upload lên thì mới xử lý
      if ($upload_arr['error'] == 0) {
        //tạo thư mục để chứa các file uploads lên, với vd này
        //sẽ tạo 1 thư mục tên = uploads, ngang hàng với file code
        //hiện tại,
        //sử dụng đường dẫn tương đối để tạo thư mục uploads
        //lưu ý, nếu thêm ký tự / trước tên thư mục định tạo, thì
        //sẽ tạo 1 thư mucj uploads ngay bên dưới thư mục htdocs
        //của XAMPP
        $path_uploads = 'uploads';
        //xử lý tạo thư mục uploads bằng code, chỉ tạo thư mục nếu
        //nó chưa hề tồn tại, sử dụng hàm file_exists để check
        if (!file_exists($path_uploads)) {
          //tạo thư mục bằng code
          mkdir($path_uploads);
        }
        //lưu ý: có thể có trường hợp user upload 1 file trên máy tính
        //của họ nhiều lần, phải xử lý tạo ra các tên file mang tính
        //duy nhất, để đảm bảo tên file ko bị trùng, tránh bị ghi đè
        //có thể dùng hàm time() để trả về thời gian hiện tại tính
        //bằng giây, sau đó nối với tên file để ra tên file mang tính
        //duy nhất
        $file_name = time() . '-' . $upload_arr['name'];
        var_dump($file_name);
        //chuyển file từ thư mục tạm mà XAMPP đang lưu vào thư mục
        //uploads bạn đã tạo
        //dùng hàm move_uploaded_file(), có 2 giá trị:
        //giá trị đầu tiên: đường dẫn tạm
        //giá trị thứ 2: đường dẫn thật sẽ upload
        move_uploaded_file($upload_arr['tmp_name'],
            $path_uploads . '/' . $file_name);
        //hiển thị thông tin file ra form
        $result .= "Tên file: $file_name";
        $result .= "<br />";
        $result .= "Ảnh đại điện:
        <img src='$path_uploads/$file_name' height='60' />";
        $result .= "<br />";
        $result .= "Đuôi file: $extension";
        $result .= "<br />";
        //lấy ra đường dẫn vật lý đang lưu file,
        // sử dụng hằng __DIR__: trả về đường dẫn vật lý tới thư mục
        //gần nhất đang chứa file gọi hằng này
        $result .=
            "Đường dẫn vật lý của file:"
            . __DIR__ . '/' . $path_uploads . '/' . $file_name;
        $result .= "<br />";
        $result .= "Kích thước file: $file_size_mb Mb";
      }
    }
  }
}
//hiển thị lỗi ra màn hình
echo "<h3 style='color: red'>$error</h3>";
  //hiển thị kết quả ra màn hình
echo "<h3 style='color: green'>$result</h3>";
?>

<!-- Do có input file, nên bắt buộc form phải có 2 điều kiện: -->
<form action="" method="POST" enctype="multipart/form-data">
  Upload
<!-- với input type=file thì thuộc tính value sẽ ko có ý nghĩa  -->
  <input type="file" name="upload" />
  <br />
  <input type="submit" name="submit" value="Upload" />
</form>
