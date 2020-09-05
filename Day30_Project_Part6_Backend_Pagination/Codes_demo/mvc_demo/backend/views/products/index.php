<?php
//views/products/index.php
require_once 'helpers/Helper.php';
?>
<h1>Form tìm kiếm</h1>
<!--Với các chức năng tìm kiếm, thường sẽ sử dụng phương thức
GET, tuy nhiên cần chú ý khi sử dụng cùng mô hình MVC-->
<!-- Form tìm kiếm theo tên danh mục, theo tên sp, theo giá -->
<!--Chú ý: với phương thức GET của form: chỉ truyền url các giá
trị của thuộc tính name trong form, như vậy 2 tham số controller
và action mặc định sẽ bị mất -> chức năng tìm kiếm đang hoạt
động chưa chính xác
ĐỂ fix trường hợp này, sẽ khai báo 2 input ở dạng ẩn, chứa name
= controller và action, giá trị thì sẽ lấy từ tham số controller
và action trên trình duyệt
-->
<form action="" method="GET">
    <input type="hidden" name="controller"
           value="<?php echo $_GET['controller']; ?>" />
    <input type="hidden" name="action"
           value="<?php echo $_GET['action'] ?>" />

    <div class="row form-group">
        <div class="col-md-4">
            <label for="category_id">Chọn danh mục</label>
            <!--         Dữ liệu của danh mục là dữ liệu động   -->
            <select name="category_id" id="category_id"
                    class="form-control">
                <option value="-1">--Chọn danh mục--</option>
                <?php foreach($categories AS $category): ?>
                    <option value="<?php echo $category['id']?>">
                      <?php echo $category['name']; ?>
                    </option>
                <?php endforeach; ?>
<!--                <option value="1">Thể thao</option>-->
<!--                <option value="2">Thế giới</option>-->
            </select>
        </div>
        <div class="col-md-4">
            <label for="title">Nhập tên sp</label>
            <input type="text" name="title" id="title"
                   class="form-control" />
        </div>
        <div class="col-md-4">
            <label for="price">Nhập giá sp</label>
            <input type="number" name="price" id="price"
                   class="form-control" />
        </div>
    </div>

    <div class="form-group">
<!--    nút submit sử dụng thêm icon search, trong trường hợp
   này sẽ sử dụng button với type=submit -->
        <button type="submit" name="search" class="btn btn-primary">
            <i class="fa fa-search"></i> Tìm kiếm
        </button>
        <a href="index.php?controller=product&action=index"
           class="btn btn-default">
            Hủy tìm kiếm
        </a>
    </div>
</form>

<h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=product&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Category name</th>
        <th>Title</th>
        <th>Avatar</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['category_name'] ?></td>
                <td><?php echo $product['title'] ?></td>
                <td>
                    <?php if (!empty($product['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo number_format($product['price']) ?></td>
                <td><?php echo $product['amount'] ?></td>
                <td><?php echo Helper::getStatusText($product['status']) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
                <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=product&action=detail&id=" . $product['id'];
                    $url_update = "index.php?controller=product&action=update&id=" . $product['id'];
                    $url_delete = "index.php?controller=product&action=delete&id=" . $product['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>