<?php
require_once 'database.php';
//crud_ajax/get_category_ajax
//Xử lý lấy dữ liệu từ bảng categories, hiển thị thị dưới
//dạng bảng HTML
// + Tạo câu truy vấn lấy dữ liệu
$sql_select_all = "SELECT * FROM categories ORDER BY id DESC";
// + Thực thi câu truy vấn vừa tạo
$result_all = mysqli_query($connection, $sql_select_all);
// + Lấy mảng kết hợp dựa vào đối tượng trung gian phía trên
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo "<pre>";
////print_r($categories);
////echo "</pre>";
///
?>
<!--Khi gọi ajax với kiểu dataType=text, PHP hiển thị gì ra
 thì đó chính là kết quả trả về cho ajax -->
<table border="1" cellspacing="0" cellpadding="8">
  <tr>
    <th>ID</th>
    <th>Name</th>
  </tr>
  <?php foreach($categories AS $category): ?>
    <tr>
      <td><?php echo $category['id']; ?></td>
      <td><?php echo $category['name']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

