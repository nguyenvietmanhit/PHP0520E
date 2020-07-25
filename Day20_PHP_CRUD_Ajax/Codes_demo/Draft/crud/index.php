<?php
session_start();
//tạo cấu trúc thư mục như sau, quản lý danh mục
//crud: create - read - update - delete
//crud
//    /index.php: liệt kê danh mục
//    /create.php: form thêm mới danh mục
//    /update.php: form cập nhật danh mục
//    /delete.php: chức năng xóa danh mục
//    /database.php: dùng để kết nối csdl sử dụng thư viện
//                   mysqli
//file crud/index.php
//hiển thị danh sách categories và các chức năng tương ứng
//TRUY VẤN CSDL ĐỂ LẤY RA TOÀN BỘ DANH MỤC TRONG BẢNG categories
require_once 'database.php';
// - Viết truy vấn lấy dữ liệu
$sql_select_all = "SELECT * FROM categories";
// - Thực thi truy vấn vừa tạo, với truy vấn SELECT thì hàm
//mysqli_query sẽ trả về 1 đối tượng trung gian, ko phải giá trị
//true/false như INSERT, UPDATE , DELETE
$result_all = mysqli_query($connection, $sql_select_all);
//echo "<pre>";
//print_r($result_all);
//echo "</pre>";
//lấy ra mảng dữ liệu categories bằng cách gọi
// hàm mysqli_fetch_all
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
echo "<pre>";
print_r($categories);
echo "</pre>";
//hiển thị ra session error và success nếu có
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}

?>
<a href="create.php">Thêm mới</a>
<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Avatar</th>
        <th>Created_at</th>
        <th></th>
    </tr>
    <?php foreach($categories AS $category): ?>
        <tr>
            <td><?php echo $category['id']; ?></td>
            <td><?php echo $category['name']; ?></td>
            <td><?php echo $category['description']; ?></td>
            <td>
                <img src="uploads/<?php echo $category['avatar']?>"
               height="80" />
            </td>
            <td>
                <?php
                //format lại ngày tạo
                echo date('d-m-Y H:i:s',
                    strtotime($category['created_at'])) ?>;
            </td>
            <td>
                <?php
                //khai báo 3 url tương ứng với 3 chức năng Chi tiết,
                //sửa, xóa
                //luôn phải truyền theo id tương ứng lên url
                $url_detail = 'detail.php?id=' . $category['id'];
                $url_update = 'update.php?id=' . $category['id'];
                $url_delete = 'delete.php?id=' . $category['id'];
                ?>
                <a href="<?php echo $url_detail; ?>">Chi tiết</a>
                <a href="<?php echo $url_update; ?>">Sửa</a>
                <a href="<?php echo $url_delete; ?>"
                onclick="return confirm('Are you delete?')">
                    Xóa
                </a>
            </td>
    </tr>
    <?php endforeach; ?>
</table>
