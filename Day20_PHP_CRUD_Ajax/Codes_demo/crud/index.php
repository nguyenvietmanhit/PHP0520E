<?php
session_start();
require_once 'database.php';
//Demo chức năng CRUD - Create - Read - Update - Delete cho việc
//quản lý danh mục
//Tạo cấu trúc thư mục như sau:
//crud/index.php: liệt kê danh mục theo bảng
//    /create.php: form thêm mới danh mục
//    /update.php: form cập nhật danh mục
//    /delete.php: xử lý xóa danh mục
//    /database.php: chứa thông tin kết nối tới CSDL
// XỬ LÝ LẤY DỮ LIỆU TỪ BẢNG CATEGORIES ĐỂ HIỂN THỊ RA
// + Tạo câu truy vấn lấy dữ liệu từ bảng
//hiển thị các bản ghi mới nhất lên trên cùng
$sql_select_all = "SELECT * FROM categories ORDER BY id DESC";
// + Thực thi truy vấn, với truy vấn select trả về 1 đối tượng
//trung gian nào đó, ko phải kiểu boolean như INSERT, UPDATE,
//DELETE
$result_all = mysqli_query($connection, $sql_select_all);
//+ Lấy dữ liệu dạng mảng kết hợp từ đối tượng trung gian
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
echo "<pre>";
print_r($categories);
echo "</pre>";
?>
<!--Hiển thị ra các session liên quan đến thông báo thành công
hoặc lỗi-->
<?php
if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  echo "<h2 style='color: green'>$success</h2>";
  //hiển thị xong xóa luôn để tránh hiển thị lại khi refresh
  // trang
  unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  echo "<h2 style='color: red'>$error</h2>";
  //hiển thị xong xóa luôn để tránh hiển thị lại khi refresh
  // trang
  unset($_SESSION['error']);
}

?>

<a href="create.php">Thêm mới danh mục</a>
<table border="1" cellspacing="0" cellpadding="8">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Avatar</th>
    <th>Created_at</th>
<!--  khai báo cột tiêu đề rỗng để chứa các chức năng
   như Chi tiết, Update, Delete bản ghi tương ứng-->
    <th></th>
  </tr>

  <?php foreach($categories AS $category): ?>
    <tr>
      <td><?php echo $category['id']; ?></td>
      <td><?php echo $category['name']; ?></td>
      <td><?php echo $category['description']; ?></td>
      <td>
        <img src="uploads/<?php echo $category['avatar']; ?>"
             height="80"/>
      </td>
      <td>
        <?php
        echo date('d/m/Y H:i:s',
            strtotime($category['created_at']));
        ?>
      </td>
      <td>
<!--     khi gắn link update và delete, cần phải biết là đang thao
          tác trên bản ghi nào, nên cần phải truyền id lên url-->
        <a href="update.php?id=<?php echo $category['id']; ?>">
          Update
        </a>
  <!--   chức năng xóa thường sẽ đi kèm popup dạng confirm   -->
        <a href="delete.php?id=<?php echo $category['id']; ?>"
           onclick="return confirm('Có muốn xóa ko?')">
          Delete
        </a>
      </td>
  </tr>
  <?php endforeach; ?>
</table>

