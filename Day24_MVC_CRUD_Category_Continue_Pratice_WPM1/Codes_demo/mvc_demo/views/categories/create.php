<?php
//mvc_demo/views/categories/create.php
//Hiển thị form thêm mới category
?>
<!--action để rỗng thì url xử lý submit sẽ là:
index.php?controller=category&action=create
-->
<form action="" method="post">
  Name: <input type="text" name="name" value="" />
  <br />
  Amount: <input type="number" name="amount" value="" />
  <br />
  <input type="submit" name="submit" value="Save" />
  <a href="index.php?controller=category&action=index">
    Về trang sách sách
  </a>
</form>
