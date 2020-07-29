<?php
// + Tạo cấu trúc thư mục như sau:
// crud_ajax/
//          /create.php
//          /update.php
//          /database.php
//          /index.php
//          /delete.php
//          /js
//             /jquery-3.2.1.min.js
//             /main.js
// + Khái niệm Ajax: là 1 kỹ thuật của Javascript tạo ra các trang
//web theo cơ chế ko đồng bộ. PHP thuần về mặt cơ bạn hoạt đông
//theo cơ chế đồng bộ: chức năng gọi trc sẽ chạy trước, các chức
//năng phía sau nó phải chờ chức năng trước chạy xong thì mới
//đc chạy. Như vậy bất đồng bộ nghĩa là chức năng phía sau vẫn
//có thể chạy xong trước cả chức năng phía trước
//+ Ajax - Asynchronous Javascript And XML - do dùng Javascipt nên
//có thể tương tác với dữ liệu mà ko cần tải lại trang
//+ Ajax có cơ chế tương tự như các framwork của JS như Node,
// Angular, React ...
//+ Với web sử dụng PHP, thì nên dùng thư viện jQuery để gọi ajax,
//thay vì dùng Javascript, vì tính dễ sử dụng của jQuery
//DEMO: tạo chức năng thêm mới category mà ko cần xử lý form, chỉ
//demo với các input nhập tên và mô tả, còn input file thì sẽ đặc
//thù xử lý hơi phức tạp nên sẽ ko demo
?>
<!--Nhúng thư viện jQuery vào để sử dụng ajax cho đơn giản-->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!--Nhúng file custom js của bạn-->
<script type="text/javascript" src="js/main.js"></script>

<form method="post" id="form" action="" enctype="multipart/form-data">
  Nhập tên:
  <input type="text" name="name" value="" />
  <br />
  Nhập mô tả:
  <textarea name="description"></textarea>
  <br />
  Upload file:
  <input type="file" />
  <br />
  <input type="submit" name="submit" value="Lưu" />
</form>