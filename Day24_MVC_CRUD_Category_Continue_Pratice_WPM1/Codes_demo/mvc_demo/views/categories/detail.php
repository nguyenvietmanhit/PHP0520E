<?php
//mvc_demo/views/categories/detail.php
//Hiển thị chi tiết category
//var_dump($category);
?>
<p>
  ID: <?php echo $category['id']; ?>
</p>
<p>
  Name: <?php echo $category['name']; ?>
</p>
<p>
  Amount: <?php echo $category['amount']; ?>
</p>
<a href="index.php?controller=category&action=index">
  Về trang danh sách
</a>
