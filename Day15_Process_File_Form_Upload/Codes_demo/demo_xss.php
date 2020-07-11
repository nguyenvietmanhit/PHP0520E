<?php
//demo_xss.php
//DEMO TẤN CÔNG XSS TRONG FORM
//là kiểu tấn công mà hacker sẽ nhập các mã Javascript vào form
//của bạn
//xử lý submit form
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  //nhập giá trị sau:
  //<script>alert(document.cookie)</script>
  //nếu nhập giá trị trên mà hiển thị ra alert thì chứng tỏ
  //form của bạn đã bị tấn công XSS
  //để fix trường hợp này, luôn sử dụng hàm sau khi hiển thị dữ liệu
  //mà user nhập từ form, sử dụng hàm htmlspecialchars để mã hóa
  //các ký tự đặc biệt như < > .....
  $name = htmlspecialchars($name);
  echo "Tên của bạn: $name";
  echo "<script type='text/javascript'>alert('123')</script>";
}
?>
<form action="" method="post">
  Name:
  <input type="text" name="name" />
  <input type="submit" name="submit" value="Test XSS" />
</form>
