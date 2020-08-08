<?php
//mvc_demo/views/categories/index.php
//Hiển thị danh sách category
echo "<pre>";
print_r($categories);
echo "</pre>";
?>
<a href="index.php?controller=category&action=create">
    Thêm mới danh mục
</a>
<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Amount</th>
        <th></th>
    </tr>
  <?php foreach ($categories AS $category): ?>
      <tr>
          <td><?php echo $category['id']; ?></td>
          <td><?php echo $category['name']; ?></td>
          <td><?php echo $category['amount']; ?></td>
          <td>
              <!--   Các chức năng Xem chi tiết, Cập nhật, Xóa luôn phải
                 truyền tham số id lên url, thì mới biết thao tác đối tượng nào
                 -->
              <a href="index.php?controller=category&action=detail&id=<?php echo $category['id']; ?>">
                  Chi tiết
              </a>
              <a href="index.php?controller=category&action=update&id=<?php echo $category['id']; ?>">
                  Cập nhật
              </a>
              <a href="index.php?controller=category&action=delete&id=<?php echo $category['id']; ?>"
                 onclick="return confirm('Chắc chắn muốn xóa?')">
                  Xóa
              </a>
          </td>
      </tr>
  <?php endforeach; ?>
</table>

