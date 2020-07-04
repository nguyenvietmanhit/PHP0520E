<?php
//thuc_hanh_form_1.php
//xây dựng form có 1 input nhập tên, 1 nút submit
//khi click nút submit thì show ra tên vừa nhập
//quy trình vẫn là: HTML -> CSS -> JS -> PHP
//code xử lý form sẽ viết trước vùng khai báo HTML
//để có thể sử dụng lại các biến 1 cách thuận lợi nhất
//QUY TRÌNH XỬ LÝ FORM
//1 - Debug thông tin biến $_GET/$_POST dựa vào phương thức của
//form
echo "<pre>";
print_r($_GET);
echo "</pre>";
//2 - Tạo các biến lưu thông tin lỗi validate và
// kết quả thành công
$error = '';
$result = '';
//3 - Kiểm tra xem form đã được submit hay chưa, chỉ xử lý khi
//form đc submit, vì khi đó biến $_GET/$_POST mới có đc giá trị
//từ form gửi lên
//sử dụng hàm isset() để kiểm tra biến đã từng tồn tại hay chưa
//luôn dựa vào thuộc tính name của nút submit để check
if (isset($_GET['submit'])) {
  //gán biến cho đỡ phải sử dùng biết $_GET, hơi dài dòng
  $name = $_GET['name'];
  //4 - Xử lý validate cho form, với form này sẽ có 2 yêu cầu
  //validate như sau:
  // + Name ko đc để trống, sử dụng hàm empty() để check
  // + Name phải có độ dài >= 6 ký tự, sử dụng hàm strlen()
  //khi xử lý validate, nếu có lỗi sẽ gán thông tin lỗi
  //cho biến $error
  if (empty($name)) {
    $error = 'Name ko đc để trống';
  } elseif (strlen($name) < 6) {
    $error = 'Name ko đc nhỏ hơn 6 ký tự';
  }
//  5 - Xử lý logic submit form theo yêu cầu đề bài
// chỉ khi nào ko có lỗi xảy ra,
  //tương đương biến $error đang rỗng
  if (empty($error)) {
    $result = "Tên vừa nhập: $name";
  }
}
?>
<!--6 - Hiển thị thông tin lỗi và kết quả ra form-->
<h3 style="color: red">
  <?php echo $error; ?>
</h3>
<h3 style="color: green">
  <?php echo $result; ?>
</h3>
<!--7 -
Nên có bước đổ lại dữ liệu mà user đã nhập ra form,
tăng tính trực quan với user hơn
can thiệp vào thuộc tính value của input để đổ lại dữ liệu
 -->
<form action="" method="get">
  Nhập tên của bạn:
  <input type="text" name="name"
 value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" />
  <br />
  <input type="submit" name="submit" value="Show thông tin" />
</form>

