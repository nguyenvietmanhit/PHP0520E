<?php
//demo_form.php
//+ Chú ý về cách đặt thuộc tính name cho các input
//- với các input mà chỉ cho phép nhập/chọn 1 giá trị tại 1 thời
//điểm, thì name sẽ ở dang text đơn, vd: type=text, number, radio,
//select ở dạng chọn 1, password, textarea
//- với các input mà cho phép chọn nhiều giá trị tại 1 thời điểm,
//thì cần khai báo name ở dạng mảng, vd: checkbox, select ở dạng
//chọn nhiều - multiple, input type=file cũng ở dạng chọn nhiều
// -> sử dụng thêm cặp ký tự [] sau tên thuộc tính name,
// vd: name='jobs[]'

//+ Phương thức GET/POST trong form
//1 - GET
//truyền hết giá trị lên url, các tham số truyền lên
// cách nhau bởi ký tự &, vd:
//abc.php?name=manh&age=123
//url sử dụng GET giới hạn độ dài = 1024 ký tự
//về mặt lập trình, PHP đã ra sẵn 1 biến toàn cục, chứa tất cả
//các dữ liệu từ form gửi lên thông qua GET, là biến $_GET, biến
//này có kiểu dữ liệu mảng
//2 - POST
//Dữ liệu sẽ ko truyền lên url như GET, mà truyền ngầm
//POST sẽ bảo mật hơn GET, chú ý ko sử dụng GET cho các form
//có dữ liệu nhạy cảm, vs: password, banking
//về mặt lập trình, PHP cũng đã tạo ra 1 biến tương ứng, có kiểu
//mảng là $_POST chứa tất cả các dữ liệu gửi từ form sử dụng
//phương thúc POST

//+ Biến $_REQUEST
//đây là 1 biến toàn cục mà PHP đã tạo ra sẵn, chứa các thông tin
//về $_GET, $_POST, $_COOKIE (chứa thông tin cookie trên hệ thông)
//Có thể dùng biến $_REQUEST để lấy dữ liệu của form thay cho
//$_GET hoặc $_POST, tuy nhiên sẽ ko khuyến khích

//+ Biến $_SERVER: là 1 mảng chứa các thông tin về máy chủ
//của bạn, PHP tạo ra sẵn
//debug thông tin biến $_SERVER
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
?>
<!--thuộc tính action của form thường để giá trị rỗng, nghĩa
là chính file mà khai báo ra form đó sẽ xử lý form đó luôn-->
<form action="" method="get">
  Username:
  <input type="text" name="username" value="" /><br />
  Age:
  <input type="number" name="age" value="" /><br />
  Email:
  <input type="email" name="email" value="" /><br />
  Gender:
<!-- với radio, cần khai báo giá trị của thuộc tính name
 trùng nhau, radio vẫn chỉ chọn đc 1 giá trị tại 1 thời điểm
 nên name vẫn ở dạng text đơn-->
  <input type="radio" name="gender" value="0" /> Female
  <input type="radio" name="gender" value="1" /> Male
  <br />
  Note:
  <textarea name="note" cols="20"></textarea><br />
  Country:
<!-- select ở dạng chọn 1 giá trị thì name vẫn ở dạng text đơn -->
  <select name="country">
    <option value="0">VN</option>
    <option value="1">Japan</option>
  </select>
  <br />
  Country multiple:
<!-- select ở dạng multiple thì name bắt buộc phải ở dạng mảng -->
  <select multiple name="country_multiple[]">
    <option value="0">Country 0</option>
    <option value="1">Country 1</option>
    <option value="2">Country 2</option>
  </select>
  <br />
  Jobs:
<!-- với checkbox, name luôn ở dạng mảng -->
  <input type="checkbox" name="jobs[]" value="0" /> Job 0
  <input type="checkbox" name="jobs[]" value="1" /> Job 1
  <input type="checkbox" name="jobs[]" value="2" /> Job 2
  <br />
  Avatar:
<!-- chọn file ở chế độ chỉ upload đc 1 file thì name ở dạng
 text đơn, với input type=file thì thuộc tính value sẽ ko có
 ý nghĩa-->
  <input type="file" name="avatar" />
  <br />
  Avatar multiple
<!-- chon file ở dạng multiple, name phải ở dạng mảng -->
  <input type="file" multiple name="avatar_multiple[]" />
  <br />
<!--  luôn khai báo name cho nút submit để PHP biết đc
đang submit chức năng nào-->
  <input type="submit" name="submit" value="Send" />
</form>



