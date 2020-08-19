<?php
//views/layouts/main.php
//File layout - bố cục chính của ứng dụng
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
<!--  Xử lý động tile như xử lý view động  -->
    <title>
      <?php echo $this->title_page; ?>
    </title>
<!--
Hiển thị các thẻ meta liên quan đến seo trong thẻ head
Đây đang là các dữ liệu tĩnh, xử lý động tương tự như title_page
và content
-->
    <meta name="title" content="Seo về title" />
    <meta name="description" content="Seo về description" />
    <meta name="keywords" content="Seo về keyword" />
<!--  Nhúng demo 1 file css  -->
    <link href="assets/css/style.css" rel="stylesheet" />
<!--  Nhúng file .js hoặc các font ...  -->
  </head>
  <body>
    <div class="header">
      <h1>Header</h1>
    </div>
    <div content="main-content">
<!--      Nội dung động-->
<!--   Cần hiển thị các thông tin lỗi, thành công, các
   session lỗi, thành công tại file layout này
   -->
      <?php echo $this->content; ?>
    </div>
    <div class="footer">
      <h1>Footer</h1>
    </div>
<!--  Tích hợp CKEditor  -->
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js">

  </script>
<!-- Nhúng file js của chính bạn, là file nhúng cuối cùng -->
  <script type="text/javascript" src="assets/js/script.js"></script>
  </body>
</html>
