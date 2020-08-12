<?php
session_start();
//example_demo/thuc_hanh_3.php
//Tạo form đăng ký thông tin như sau, với trường
// Quốc gia có 3 option sau: --Chọn quốc gia – (giá trị -1), Việt Nam – (giá trị 1), USA – (giá trị 2)
//Yêu cầu validate:
//Tất cả các trường không được để trống
//Có xử lý đổ lại dữ liệu cho các trường đã nhập đúng khi
// validate lỗi
//Sau khi validate thành công,  hiển thị Họ tên vừa nhập
// tại 1 màn hình (url) khác
//XỬ LÝ SUBMIT FORM
$error = '';
$result = '';
echo "<pre>";
print_r($_POST);
echo "</pre>";
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    //kiểm tra validate -> tự làm
    //xử lý logic submit form , khi user nhập họ tên và submit
    //form thì sẽ hiển thị họ tên user đó ở 1 file khác
    if (empty($error)) {
        $_SESSION['fullname'] = $fullname;
        //chuyển hướng tới trang show.php và hiển thị họ tên
        //ở file này
        header('Location: show.php');
        exit();
    }
}
?>

<form method="post" action="">
    <h2>Form đăng ký thông tin</h2>
    Họ tên: <input type="text" name="fullname" value="" />
    <br />
    Giới tính:
    <input type="radio" name="gender" value="0" /> Nữ
    <input type="radio" name="gender" value="1" /> Nam
    <br />
    Nghề nghiệp:
    <input type="checkbox" name="jobs[]" value="0" /> Developer
    <input type="checkbox" name="jobs[]" value="1" /> Tester
    <input type="checkbox" name="jobs[]" value="2" /> BA
    <br />
    Quốc gia:
    <select name="country">
        <option value="0">Việt Nam</option>
        <option value="1">USA</option>
    </select>
    <br />
    <input type="submit" name="submit" value="Đăng ký" />
</form>
