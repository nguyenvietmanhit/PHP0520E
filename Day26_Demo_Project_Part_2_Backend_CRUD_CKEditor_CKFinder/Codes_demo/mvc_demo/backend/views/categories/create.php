<?php
//views/categories/create.php
//Hiển thị form thêm mới category
?>
<h1>Form thêm mới</h1>
<form action="" method="post" enctype="multipart/form-data">
  Name:
  <input type="text" name="name" value="" />
  <br />
  Avatar:
  <input type="file" name="avatar" />
  <br />
<!--
Tích hợp CKEditor - Trình soạn thảo văn bản :
- Chỉ có thể tích đc CKEditor với thẻ <textarea>
- Tích hợp thông qua thuộc tính name của textarea này
- Nhúng file js sau vào hệ thống:
assets/ckeditor/ckeditor.js
- Chú ý name ko đc đặt = description vì bị trùng với thẻ
<meta> có name=desciprtion
-->
  Description:
  <textarea name="category_description"></textarea>
  <br />
  <input type="submit" name="submit" value="Save" />
</form>
