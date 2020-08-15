<?php
//mvc_demo/views/categories/detail.php
//Hiển thị chi tiết category
?>
ID: <?php echo $category['id']; ?> <br />
Name: Name <?php echo $category['name']; ?> <br />
Amount: <?php echo $category['amount']; ?> <br />
<a href="index.php?controller=category&action=index">
  Về trang danh sách
</a>
