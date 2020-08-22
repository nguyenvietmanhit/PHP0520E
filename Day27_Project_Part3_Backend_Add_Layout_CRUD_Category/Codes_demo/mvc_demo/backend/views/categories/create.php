<?php
//views/categories/create.php
//Hiển thị form thêm mới category
//Các trường trong bảng categories: id,name, type, avatar
//, description, status, created_at, updated_at
?>
<h1>Form thêm mới</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"
               class="form-control" />
    </div>
    <div class="form-group">
        <label for="avatar">Upload avatar:</label>
        <input type="file" id="avatar" name="avatar"
               class="form-control" />
<!--    Sử dụng JS để show preview, nên cần khai báo 1 đoạn
    HTML sau -->
        <img src="" id="img-preview" width="100" height="100"
            style="display: none" />
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Create"
             class="btn btn-primary"  />
    </div>
</form>
