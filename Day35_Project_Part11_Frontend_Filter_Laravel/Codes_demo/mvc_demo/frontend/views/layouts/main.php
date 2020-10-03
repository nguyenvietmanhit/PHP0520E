<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo $_SERVER['SCRIPT_NAME'] ?>" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC Demo Frontend</title>


    <link rel="canonical" href="http://localhost"/>
    <link rel="alternate" href="http://localhost" hreflang="vi-vn"/>

    <meta name="robots" content="index,follow,noodp">
    <meta name="author" content="http://localhost">
    <meta name="copyright" content="http://localhost"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="MVC Demo Frontend"/>
    <meta property="og:url" content="http://localhost"/>
    <meta property="og:site_name" content="http://localhost"/>
    <!-- SEO META DESCRIPTION -->
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,900&amp;subset=latin-ext"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/all.min.css"/>
    <!--<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Tooltip plugin (zebra) css file -->
    <link rel="stylesheet" href="assets/css/zebra_tooltips.min.css"/>
    <!-- Owl Carousel plugin css file. only used pages -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css"/>

    <!-- Ideabox responsive css file -->
    <link rel="stylesheet" href="assets/css/responsive-style.css"/>
    <!-- Ideabox main theme css file. you have to add all pages -->
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php require_once 'header.php'; ?>


<div class="main-content">
    <div class="container">
      <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
          </div>
      <?php endif; ?>

      <?php if (!empty($this->error)): ?>
          <div class="alert alert-danger">
            <?php
            echo $this->error;
            ?>
          </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
          </div>
      <?php endif; ?>
    </div>
    <!--    hiển thị nội dung động -->
  <?php echo $this->content; ?>
</div>


<?php require_once 'footer.php'; ?>

</body>

</html>