<!--Timeline items start -->
<!--Nếu tồn tại giỏ hàng, thì hiển thị ra màn hình-->
<div class="timeline-items container">
    <h2>Giỏ hàng của bạn</h2>
    <form action="" method="post">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th width="40%">Tên sản phẩm</th>
                <th width="12%">Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th></th>
            </tr>

            <tr>
                <td>
                    <img class="product-avatar img-responsive"
                         src="../backend/assets/uploads/1596790118-product-logo3.png" width="80">
                    <div class="content-product">
                        <a href="chi-tiet-san-pham/samsung-s9/5" class="content-product-a">
                            dsadsa </a>
                    </div>
                </td>
                <td>
                    <!--                      cần khéo léo đặt name cho input số lượng, để khi xử lý submit form update lại giỏ hànTin nổi bậtg sẽ đơn giản hơn    -->
                    <input type="number" min="0" name="3" class="product-amount form-control" value="4">
                </td>
                <td>
                    11
                </td>
                <td>
                    44
                </td>
                <td>
                    <a class="content-product-a" href="xoa-san-pham/3.html">
                        Xóa
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <img class="product-avatar img-responsive"
                         src="../backend/assets/uploads/1596790088-product-img.jpg" width="80">
                    <div class="content-product">
                        <a href="chi-tiet-san-pham/samsung-s9/5" class="content-product-a">
                            SP 2 </a>
                    </div>
                </td>
                <td>
                    <!-- cần khéo léo đặt name cho input số lượng, để khi xử lý submit form update lại giỏ hànTin nổi bậtg sẽ đơn giản hơn    -->
                    <input type="number" min="0" name="2" class="product-amount form-control" value="2">
                </td>
                <td>
                    1
                </td>
                <td>
                    2
                </td>
                <td>
                    <a class="content-product-a" href="xoa-san-pham/2.html">
                        Xóa
                    </a>
                </td>
            </tr>

            <tr>
                <td colspan="5" style="text-align: right">
                    Tổng giá trị đơn hàng:
                    <span class="product-price">
                                            46 vnđ
                                                </span>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="product-payment">
                    <input type="submit" name="submit" value="Cập nhật lại giá" class="btn btn-primary">
                    <a href="thanh-toan.html" class="btn btn-success">Đến trang thanh toán</a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<!--Timeline items end -->