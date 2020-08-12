<?php
//practice_wpm1/practice_1.php
// + Bài thực hành 1 trong slide 2_PHP_Basic_Pratice.ppt
// + Kiến thức của phần thi chỉ là xử lý thao tác với Form
//và thêm 1 bài thao tác với session. Ko có tương tác với
//CSDL

// XỬ LÝ SUBMIT FORM
// + Tạo các biến lỗi và thành công
$error = '';
$result = '';
// + Debug thông tin mảng dựa vào phương thức của form
echo "<pre>";
print_r($_POST);
echo "</pre>";
// + Nếu user submit form thì mới xử lý
if (isset($_POST['submit'])) {
  // + Gán biến trung gian cho dễ thao tác
  $number = $_POST['number'];
  // + Xử lý validate: để trống hoặc ko phải số thì báo lỗi
  if (empty($number)) {
    $error = "Ko đc để trống";
  } elseif (!is_numeric($number)) {
    $error = 'Phải nhập số';
  }
  // + Xử lý logic bài toán chỉ ko có lỗi xảy ra
  if (empty($error)) {
    //chạy vòng lặp for từ 3 đến $number, tại mỗi thời
    //điểm lặp cần kiểm tra nếu là số nguyên tố -> hiển thị
    //ra, khai báo 1 hàm kiểm tra số nguyên tố
    for ($i = 3; $i <= $number; $i++) {
      //gọi hàm để ktra số nguyên tố
      $is_prime = isPrime($i);
      //nếu là số nguyên tố thì nối chuỗi vào kết quả
      if ($is_prime) {
        $result .= "$i, ";
      }
    }
  }
}

function isPrime($number)
{
  if ($number < 2) {
    return FALSE;
  }
  //mặc định hàm này trả về TRUE
  $is_prime = TRUE;
  for ($i = 2; $i <= sqrt($number); $i++) {
    //tại từng thời điểm lặp, nếu phát hiện chia hết cho biến
    //lặp thì gán giá trị = FALSE, và thoát khỏi vòng lặp luôn
    if ($number % $i == 0) {
      $is_prime = FALSE;
      break;
    }
  }
  return $is_prime;
}

?>
<h3 style="color: red;">
  <?php echo $error; ?>
</h3>
<h3 style="color: green;">
  <?php echo $result; ?>
</h3>
<form action="" method="post">
    <b>Tìm các số nguyên tố nhỏ hơn số nhập vào:</b>
    <br/>
    Nhập số cần kiểm tra:
<!--  Đổ lại dữ liệu đã nhập cho input  -->
    <input type="text" name="number"
           value="<?php echo isset($_POST['number'])
               ? $_POST['number'] : ''?>"/>
    <br/>
    <input type="submit" name="submit" value="Kiểm tra"/>
</form>