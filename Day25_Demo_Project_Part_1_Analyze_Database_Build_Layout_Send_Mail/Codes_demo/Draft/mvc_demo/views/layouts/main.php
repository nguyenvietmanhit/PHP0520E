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
<div class="main-content">
<!--  Hiển thị tất cả các thông báo liên quan đến lỗi,
  session lỗi , thành công tại file layout -->
    <h3 style="color: red">
        <?php echo $this->error; ?>
    </h3>
    <?php
    if (isset($_SESSION['success'])) {
        //có thể dùng cặp {} để hiển thị giá trị 1 mảng mà ko
      //cần nối chuỗi
      echo "<h3 style='color: green'>{$_SESSION['success']}</h3>";
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
      //có thể dùng cặp {} để hiển thị giá trị 1 mảng mà ko
      //cần nối chuỗi
      echo "<h3 style='color: red'>{$_SESSION['error']}</h3>";
      unset($_SESSION['error']);
    }
    ?>

    <!--  Hiển thi nội dung động  -->
<!-- cơ chế render view động   -->
    <?php echo $this->content; ?>
</div>
<!--  Nhúng footer  -->
<div class="footer">
  <?php require_once 'footer.php'; ?>
</div>
</body>
</html>
