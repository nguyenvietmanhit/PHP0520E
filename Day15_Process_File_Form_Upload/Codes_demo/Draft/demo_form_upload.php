<!--demo_upload_form.php-->
<?php
$error = '';
$result = '';
//debug thông tin mảng
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
//xử lý submit form
if (isset($_POST['submit'])) {
    //tạo các biến trung gian
    $name = $_POST['name'];
    $age = $_POST['age'];
    //với radio và checkbox sẽ có trường hợp ko tích vào
    //radio/checkbox nào mà submit form, nên cần check isset
    //nếu tồn tại thì mới gán đc biến
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['jobs'])) {
        $jobs = $_POST['jobs'];
    }
    $avatar = $_FILES['avatar'];
    //check validate cho form
//    - tất cả các trường ko đc để trống
    // - phải tích chọn ít nhất 1 radio và checkbox
    //- file upload nếu có phải có dạng ảnh
    if (empty($name)) {
        $error = 'Name ko đc để trống';
    } elseif(empty($age) || !is_numeric($age)) {
        $error = 'Age ko đc trống và phải là số';
    }
    //kiểm tra nếu chưa tích vào radio nào thì báo lỗi
    elseif(!isset($_POST['gender'])) {
        $error = 'Cần chọn gender';
    }
    //validate chưa chọn job nào
    elseif(!isset($_POST['jobs'])) {
        $error = 'Cần chọn ít nhất 1 jobs';
    }
    //validate file upload phải là ảnh
    elseif($avatar['error'] == 0) {
        $extension = pathinfo($avatar['name'],
            PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $extension_allowed = ['png', 'jpg', 'jpeg', 'gif'];
        if (!in_array($extension, $extension_allowed)) {
            $error = 'Phải upload file ảnh';
        }
    }
    //hiển thị lỗi
    echo "<b>$error</b>";
    //xử lý logic submit form chỉ khi ko có lỗi
    if (empty($error)) {
        //xử lý hiển thị các thông tin user đã chọn trên form
    }
}
?>
<form action="#" method="post" enctype="multipart/form-data">
    Name:
    <input type="text" name="name" value="" />
    <br />
    Age:
    <input type="text" name="age" value="" />
    <br />
    Gender:
    <input type="radio" name="gender" value="0" /> Male
    <input type="radio" name="gender" value="1" /> Female
    <br />
    Jobs:
    <input type="checkbox" name="jobs[]" value="0" /> Coder
    <input type="checkbox" name="jobs[]" value="1" /> Tester
    <br />
    Avatar:
    <input type="file" name="avatar" />
    <br />
    <input type="submit" name="submit" value="Show info" />
</form>