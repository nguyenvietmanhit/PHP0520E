<!--demo_upload_file.php-->
<!--
Xử lý upload file trong form
Khi trong form của bạn có input file, thì bắt buộc form đó
//phải có các tính chất sau:
- Phương thức của form bắt buộc phải là POST
- Phải thêm thuộc tính sau cho form, enctype, giá trị tương
ứng của thuộc tính enctype=multipart/form-data

PHP cũng sinh ra 1 biến chứa toàn bộ thông tin file upload lên
: $_FILES, ko thể dùng biến $_POST để lấy thông tin file đc

Mô tả về biến $_FILES: là mảng 2 chiều, có dạng như sau
$_FILES[tên-input-file][thuộc-tính]
thuộc-tính bao gồm 5 thuộc tính sau:
- name: tên file đc upload
- type: kiểu dữ liệu của file
- tmp_name: đường dẫn tạm mà server đã upload tạm cho bạn
- size: kích thước file upload, tính bằng đơn vị Byte,
1Mb = 1024Kb = 1024 * 1024B
- error: trạng thái lỗi khi upload, có các giá trị cụ thể sau
0: ko có lỗi khi upload
1: file upload vượt quá dung lượng cho phép trong file cấu hình
2: số file upload vượt quá số file cho phép trong file cấu hình
...
Chỉ cần quan tâm đến giá trị 0 - nếu = 0 thì upload ko lỗi,
khác 0 là lỗi


-->
<?php
//debug mảng $_POST
echo "<pre>";
print_r($_POST);
echo "</pre>";
//debug mảng chứa thông tin file $_FILES
echo "<pre>";
print_r($_FILES);
echo "</pre>";

$error = '';
$result = '';
//xử lý submit form
if (isset($_POST['submit'])) {
    //tạo ra các biến chứa thông tin file
    $avatar_name = $_FILES['avatar']['name'];
    $avatar_type = $_FILES['avatar']['type'];
    $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
    $avatar_error = $_FILES['avatar']['error'];
    $avatar_size = $_FILES['avatar']['size'];
    //xử lý validate nếu có file upload lên
//    - phải có dạng ảnh: png, jpg, jpeg, gif
//    - file upload dung lượng ko đc vượt quá 2Mb
    //theo yêu cầu đề bài, nếu user upload file lên
    //thì mới check validate, sẽ dựa vào thuộc tính error, nếu
//    error = 0 tương đương có file upload lên thì mới xử lý
    if ($avatar_error == 0) {
        //validate phải là ảnh, sử dụng hàm pathinfo để lấy
        //ra đuôi file dựa vào tên file
        $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
        $extension_allowed = ['png', 'jpg', 'jpeg', 'gif'];
        //chuyển đuôi file tìm được thành chữ thường
        $extension = strtolower($extension);
        //chuyển size từ Byte về Mb
        $avatar_size_mb = $avatar_size / 1024 / 1024;
        //giữ lại 2 ký tự sau phần thập phân để nhìn cho gọn
        $avatar_size_mb = round($avatar_size_mb, 2);
        if(!in_array($extension, $extension_allowed)) {
            $error = 'Phải upload file ảnh';
        }
        //để test, thì để size > 0.2Mb
        elseif($avatar_size_mb > 2) {
            $error = 'Dung lượng file ko đc vượt quá 2Mb';
        }
    }

    //xử lý logic submit form khi ko có lỗi nào xảy ra
    if (empty($error)) {
        //xử lý upload file lên hệ thống
        //chỉ upload lên khi user có hành đông upload lên
        if ($avatar_error == 0) {
            //tạo 1 thư mục chứa các file ảnh sẽ upload lên
            //, với tên là uploads, thư mục này sẽ ngang hàng
            //với file code hiện tại
            //tạo thư mục sử dụng code thì cần phải sử dụng đường
            //dẫn tuyệt đối tới thư mục đó: __DIR__
            $dir_uploads = __DIR__ . '/uploads';
            //tạo thư mục, cần kiểm tra nếu thư mục uploads
            //chưa tồn tại thì mới tạo
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            //tạo tên file mang tính duy nhất, để tránh trường
            //hợp user upload nhiều file trùng tên -> mất file
            //sử dụng hàm time() để sinh chuỗi ngẫu nhiên
            $avatar_name = time() . '-' . $avatar_name;
            //upload file vào thư mục uploads đã tạo
            $is_upload = move_uploaded_file($avatar_tmp_name,
                $dir_uploads . '/' . $avatar_name);
//            var_dump($is_upload);
            //hiển thị thông tin ảnh ra
            if ($is_upload) {
                $result .= "Tên file ảnh: $avatar_name <br />";
                $result .= "<img src='uploads/$avatar_name' height='80' />";
                $result .= "<br />Định dạng file: $extension <br />";
                $result .= "Đường dẫn vật lý: $dir_uploads/$avatar_name <br />";
                $result .= "Kích thước file Mb: $avatar_size_mb";
            }
        }
    }

}
?>
<h3 style="color: green">
    <?php echo $result; ?>
</h3>
<h3 style="color: red">
    <?php echo $error; ?>
</h3>
<!--khi trong form có input file thì thẻ form sẽ đc
khai báo như sau
-->
<form action="" method="post" enctype="multipart/form-data">
    Upload avatar
<!--  với input file, thuộc tính value sẽ ko có tác dụng  -->
    <input type="file" name="avatar" />
    <br />
    <input type="submit" name="submit" value="Upload" />
</form>