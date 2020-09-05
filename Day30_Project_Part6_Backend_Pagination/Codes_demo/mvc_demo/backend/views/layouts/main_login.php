<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="container">
    <!--  Hiển thị các thông báo lỗi, thành công  -->
    <?php
    if (!empty($this->error)) {
        echo "<p style='color: red'>$this->error</p>";
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
      echo "<p style='color: green'>{$_SESSION['success']}</p>";
      unset($_SESSION['success']);
    }
    ?>
  <?php echo $this->content; ?>
</div>
<!-- jQuery 3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!--CKEditor -->
<script src="assets/ckeditor/ckeditor.js"></script>
<!--My SCRIPT-->
<script src="assets/js/script.js"></script>
</body>
</html>
