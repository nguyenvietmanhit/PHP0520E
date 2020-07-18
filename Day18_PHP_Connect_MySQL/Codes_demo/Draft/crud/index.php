<?php
session_start();
//crud: create - read - update - delete
//crud /index.php: liệt kê danh mục
//     /create.php: form thêm mới danh mục
//     /update.php: form update danh mục
//     /delete.php: chức năng xóa danh mục
//     /database.php: chứa các hằng số và biến kết nối CSDL
//hiển thị mesasge thành công từ các file khác nếu có
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    //sau khi hiển thị xong thì xóa nó đi
    unset($_SESSION['success']);
}
