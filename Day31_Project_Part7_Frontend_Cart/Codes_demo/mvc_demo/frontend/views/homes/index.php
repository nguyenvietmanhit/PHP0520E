<?php
require_once 'helpers/Helper.php';
?>
<!--    PRODUCT-->
<div class="product-wrap">
    <div class="product container">
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

                    <span class="add-to-cart">
                        <a href="#" style="color: inherit">Thêm vào giỏ</a>
                    </span>
                </div>
            <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
</div>
<!--    END PRODUCT-->

<!--NEWS-->
<div class="news-wrap">
    <div class="news container">
        <h1 class="post-list-title">
            <a href="/news.html" class="link-category-item">Tin mới nhất</a>
        </h1>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 category-two-item">
                <a href="news_detail.html" class="two-item-link-heading">
                    <span class="new-image-content">
                        <img src="assets/images/news.jpg"
                             title="BÍ MẬT SƠN TINH CAMP"
                             alt="BÍ MẬT SƠN TINH CAMP"
                             class="post-image-avatar img-responsive">
                    </span>
                </a>
                <div class="news-content-wrap">
                    <h3 class="category-heading timeline-post-title">
                        <a href="#">
                            BÍ MẬT SƠN TINH CAMP </a>
                    </h3>
                    <div class="news-description">
                        Hàng trăm năm qua, không ít những câu chuyện truyền tai nhau sản sinh ra nơi hòn đảo Sơn
                        Tinh xinh đẹp. Họ không cùng màu da, không cùng tôn giáo, họ đến từ nhiều nơi và họ là
                        những
                        con người sôi nổi, thích phiêu lưu. Có phải vì những lời kể ấy đã lôi cuốn họ tìm đến
                        Sơn
                        Tinh, hay chính vì sự hoang dã tuyệt đẹp của không gian, bởi sự trù phú của sản
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 category-two-item">
                <a href="news_detail.html" class="two-item-link-heading">
                    <span class="new-image-content">
                        <img src="assets/images/news.jpg"
                             title="BÍ MẬT SƠN TINH CAMP"
                             alt="BÍ MẬT SƠN TINH CAMP"
                             class="post-image-avatar img-responsive">
                    </span>
                </a>
                <div class="news-content-wrap">
                    <h3 class="category-heading timeline-post-title">
                        <a href="#">
                            BÍ MẬT SƠN TINH CAMP </a>
                    </h3>
                    <div class="news-description">
                        Hàng trăm năm qua, không ít những câu chuyện truyền tai nhau sản sinh ra nơi hòn đảo Sơn
                        Tinh xinh đẹp. Họ không cùng màu da, không cùng tôn giáo, họ đến từ nhiều nơi và họ là
                        những
                        con người sôi nổi, thích phiêu lưu. Có phải vì những lời kể ấy đã lôi cuốn họ tìm đến
                        Sơn
                        Tinh, hay chính vì sự hoang dã tuyệt đẹp của không gian, bởi sự trù phú của sản
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END NEWS-->