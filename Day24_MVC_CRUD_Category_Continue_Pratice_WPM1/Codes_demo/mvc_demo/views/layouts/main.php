<?php
//mvc_demo/views/layouts/main.php
//File layout chính của ứng dụng
?>
<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
</head>
<body>
<!--  Nhúng header  -->
<div class="header">
  <?php require_once 'header.php'; ?>
</div>
<!--
Hiển thị các thông báo lỗi validate, hoặc các session tại
file layout
-->
<h3 style="color: red">
    <?php echo $this->error; ?>
</h3>
<div class="main-content">
    <!--  Hiển thi nội dung động  -->
<!--  Do file layout luôn đc nhúng trong phương thức của class,
  nên có thể sử dụng đc $this như bình thường
  -->
    <?php echo $this->content; ?>
</div>
<!--  Nhúng footer  -->
<div class="footer">
  <?php require_once 'footer.php'; ?>
</div>
</body>
</html>
