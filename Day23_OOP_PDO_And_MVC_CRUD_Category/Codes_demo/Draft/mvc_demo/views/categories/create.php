<?php
//mvc_demo/views/categories/create.php
//Hiển thị form thêm mới category
?>
<form action="" method="post">
    Name:
    <input type="text" name="name" value="" />
    <br />
    Amount:
    <input type="number" name="amount" value="" />
    <br />
    <input type="submit" name="submit" value="Save" />
    <a href="index.php?controller=category&action=index">
        Về trang danh sách
    </a>
</form>


