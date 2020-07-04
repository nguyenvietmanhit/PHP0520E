<?php
//thuc_hanh_form_3.php
//Demo cách xử lý với các input radio, checkbox, select
//XỬ LÝ FORM
//1 - Debug thông tin dựa vào phương thức form
echo "<pre>";
print_r($_POST);
echo "</pre>";
//2 - Tạo biến error và result
$error = '';
$result = '';
//3 - Kiểm tra nếu submit form thì mới xử lý
if (isset($_POST['submit'])) {
  //tạo biến và gán giá trị cho biến từ mảng $_POST
  $username = $_POST['username'];
  $note = $_POST['note'];
  //với radio và checkbox, sẽ có trường hợp user ko tích chọn
  //cái nào mà submit form, khi đó $_POSt/$_GET sẽ ko bắt đc
  //các giá trị này, nên việc gán giá trị cho radio và checkbox
  //như bên dưới là ko an toàn
//  $gender = $_POST['gender'];
//  $jobs = $_POST['jobs'];
  //khi xử lý với radio và checkbox luôn phải kiểm tra sự tồn
  //tại của các giá trị đó, nếu tồn tại r thì mới xử lý
  $country = $_POST['country'];
//  4 - Xử lý validate form
//  + Username phải có định dạng email
  //+ Tất cả các trường ko đc để trống, radio/checkbox bắt buộc
  //phải chọn
  if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $error = 'Username phải có định email';
  } elseif (empty($username) || empty($note)
      || !isset($_POST['gender']) || !isset($_POST['jobs'])) {
    $error = 'Phải nhập/chọn tất cả các trường';
  }
//  5 - Xử lý logic submit form theo yêu cầu đề bài, chỉ khi nào
  //ko có lỗi xảy ra
  if (empty($error)) {
    //hiển thị các thông tin mà user nhập ra màn hình
    //với các trường text thì lấy giá trị như bình thường
    $result .= "Username: $username <br />";
    $result .= "Note: $note <br />";
    //với radio, cần xử lý để hiển thị ra giá trị có ý nghĩa
    //thay vì hiển thị ra giá trị số trong thuộc tính value
    //value của radio, checkbox, select thường sẽ ở dạng số
    //để tiết kiệm dung lượng trong CSDL
    //nếu tồn tại/đã tích chọn radio thì mới xử lý
    if (isset($_POST['gender'])) {
      $gender = $_POST['gender'];
      switch ($gender) {
        case 0: $result .= "Gender: Nữ";break;
        case 1: $result .= "Gender: Nam";break;
      }
      $result .= "<br />";
    }
    //xử lý checkbox của jobs
    if (isset($_POST['jobs'])) {
      $jobs = $_POST['jobs'];
      //lặp từng phần tử để lấy giá trị text tương ứng
      //với value của từng phần tử
      foreach($jobs AS $job) {
        switch ($job) {
          case 0: $result .= "Job: Dev"; break;
          case 1: $result .= "Job: Tester"; break;
          case 2: $result .= "Job: BA";break;
        }
      }
    }
    //xử lý select country,
    //xử lý select ở dạng đơn thì khá giống với radio
    switch ($country) {
      case 0: $result .= "Country: VN";break;
      case 1: $result .= "Country: Japan";break;
    }
  }
}
?>
<!--6 hiển thị error và result ra màn hình-->
<h3 style="color: red"><?php echo $error; ?></h3>
<h3 style="color: green"><?php echo $result; ?></h3>
<form action="" method="post">
  Username:
  <input type="text" name="username" value="" />
  <br />
  Note:
  <textarea name="note" cols="20"></textarea>
  <br />
  Gender:
<!-- bản chất radio vẫn chỉ là chọn 1 giá trị tại 1 thời điểm
 nên thuộc tính name vẫn ở dạng text đơn-->
<!-- radio, checkbox, select cần khai báo giá trị cho
 thuộc tính value để PHP biết đc đang chọn giá trị nào-->

<!--  7 - Đổ lại dữ liệu ra form với các input radio, checkbox,
 select
 + Với radio, checkbox sẽ dựa vào thuộc tính checked
 + Với select thì sẽ dựa vào thuộc tính selected cho các option
 -->
  <?php
  //đổ lại dữ liệu cho radio
  //có bao nhiêu input thì tạo từng đó biến tương ứng
  $checked_female = '';
  $checked_male = '';
  if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
    switch ($gender) {
      case 0: $checked_female = 'checked';break;
      case 1: $checked_male = 'checked';break;
    }
  }
  ?>
  <input type="radio" name="gender"
         value="0" <?php echo $checked_female; ?>  /> Nữ
  <input type="radio" name="gender" value="1"
      <?php echo $checked_male; ?> /> Nam
  <br />
  Jobs:
  <input type="checkbox" name="jobs[]" value="0" /> Dev
  <input type="checkbox" name="jobs[]" value="1" /> Tester
  <input type="checkbox" name="jobs[]" value="2" /> BA
  <br />
  Country:
  <select name="country">
    <option value="0">VN</option>
    <option value="1">Japan</option>
  </select>
  <br />
  <input type="submit" name="submit" value="Show info" />
</form>
