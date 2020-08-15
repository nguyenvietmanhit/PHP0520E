<?php
//mvc_demo/views/categories/update.php
//Hiển thị form cập nhật category
//Copy form từ create.php sang
?>
<form action="" method="post">
  Name:
  <input type="text" name="name"
         value="<?php echo $category['name']; ?>" />
  <br />
  Amount:
  <input type="number" name="amount"
         value="<?php echo $category['amount'];?>" />
  <br />
  <input type="submit" name="submit" value="Update" />
  <a href="index.php?controller=category&action=index">
    Về trang danh sách
  </a>
</form>
