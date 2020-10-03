<?php
require_once 'helpers/Helper.php';
/**
 * views/products/filter.php
 * Hiển thị danh sách sản phẩm kết hợp chức năng Lọc theo
 * danh mục và theo khoảng giá
 * VỀ giao diện: chia làm 2 cột chính:
 * + Bên trái: phần lọc
 * + Bên phải: danh sách sản phẩm
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-12">
            <!-- phần lọc -->
            <!--   nếu dùng rewrite url, thì nên để method là post   -->
            <form action="" method="post">
                <h3>Filter</h3>
                <div class="checkbox-category">
                    <h5>Lọc theo danh mục</h5>
                  <?php foreach ($categories AS $category):
                    //xử lý giữ lại checkbox đã tích cho danh mục khi
                    //filter
                    $checked = '';
                    if (isset($_POST['categories'])) {
                      if (in_array($category['id'], $_POST['categories'])) {
                        $checked = 'checked';
                      }
                    }
                    ?>
                      <input <?php echo $checked; ?> type="checkbox"
                                                     name="categories[]"
                                                     value="<?php echo $category['id']; ?>"/>
                    <?php echo $category['name']; ?>
                      <br/>
                  <?php endforeach; ?>
                </div>
                <div class="checkbox-price">
                    <h5>Lọc theo khoảng giá</h5>
                  <?php
                  $checked_1 = '';
                  $checked_2 = '';
                  $checked_3 = '';
                  $checked_4 = '';
                  if (isset($_POST['prices'])) {
                    if (in_array(0, $_POST['prices'])) {
                      $checked_1 = 'checked';
                    }
                    if (in_array(1, $_POST['prices'])) {
                      $checked_2 = 'checked';
                    }
                    if (in_array(2, $_POST['prices'])) {
                      $checked_3 = 'checked';
                    }
                    if (in_array(3, $_POST['prices'])) {
                      $checked_4 = 'checked';
                    }
                  }
                  ?>
                    <input type="checkbox" name="prices[]" <?php echo $checked_1; ?>
                           value="0"/> < 1tr
                    <br/>
                    <input type="checkbox" name="prices[]" <?php echo $checked_2; ?>
                           value="1"/> Từ 1 đến 2tr
                    <br/>
                    <input type="checkbox" name="prices[]" <?php echo $checked_3; ?>
                           value="2"/> Từ 2 đến 3tr
                    <br/>
                    <input type="checkbox" name="prices[]" <?php echo $checked_4; ?>
                           value="3"/> > 3tr
                    <br/>
                </div>
                <input type="submit" name="filter" value="Tìm kiếm"
                       class="btn btn-success"/>
                <a href="danh-sach-san-pham.html"
                   class="btn btn-default">
                    Cancel
                </a>
            </form>

        </div>
        <div class="col-md-9 col-sm-9 col-12">
          <?php if (!empty($products)): ?>
              <h1 class="post-list-title">
                  <a href="danh-sach-san-pham.html" class="link-category-item">Sản phẩm mới nhất</a>
              </h1>
              <div class="link-secondary-wrap row">
                <?php foreach ($products AS $product):
                  $slug = Helper::getSlug($product['title']);
                  $product_link = "san-pham/$slug/" . $product['id'] . ".html";
                  $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                  ?>
                    <div class="service-link col-md-3 col-sm-6 col-xs-12">
                        <a href="<?php echo $product_link; ?>">
                            <img class="secondary-img img-responsive" title="<?php echo $product['title'] ?>"
                                 src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                 alt="<?php echo $product['title'] ?>"/>
                            <span class="shop-title">
                        <?php echo $product['title'] ?>
                    </span>
                        </a>
                        <span class="shop-price">
                            <?php echo number_format($product['price']) ?>
                </span>
                        <p><?php echo $product['category_name']; ?></p>
                        <span class="add-to-cart"
                              data-id="<?php echo $product['id']; ?>">
                        <a href="#" style="color: inherit">Thêm vào giỏ</a>
                    </span>
                    </div>
                <?php endforeach; ?>
              </div>
          <?php endif; ?>
        </div>
    </div>
</div>