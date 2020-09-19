<?php
/**
 * cac_chuc_nang_frontend.php
 * LIỆT KÊ 1 SÔ CHỨC NĂNG CÓ THỂ CỦA CỦA FRONTEND VỚI TRANG
 * BÁN HÀNG
 * + Giỏ hàng:
 * + Thanh toán: tích hợp thanh toán trực tuyến
 * + Tìm kiếm / Lọc
 * - Chức năng Lọc sản phẩm theo giá, hãng, ... sử dụng
 * truy vấn SELECT với điều kiện OR
 * - Chức năng tìm kiếm thường sẽ sử dụng AND
 * + Top sản phẩm bán chạy nhất, mới nhất ...
 * - Bán chạy nhất
 * Về mặt truy vấn: sử dụng SELECT COUNT(quantiry) GROUP BY
 * product_id
 * Mới nhất: SELECT kết hợp với ORDER BY
 * + Mã giảm giá:
 * - Chức năng này có thể đặt tại màn hình Thanh toán
 * - Về mặt code: có thể tạo 1 bảng: discounts
 * id
 * code: tên mã giảm giá
 * expired_date: ngày hết hạn
 * status: trạng thái mã giảm giá
 * amount: số lượng tối đa của mã này
 * discount: số tiền giảm (vnđ hoặc %)
 * created_at
 * Giả sử 1 đơn hàng chỉ đc sử dụng 1 mã giảm giá, thêm 1 trường
 * discount_id vào bảng orders
 * + Với chức năng tạo ra sản phẩm với giá đã đc giảm, tạo
 * thêm 2 trường sau bảng products:
 * discount: Số tiền sẽ giảm (% hoặc vnđ)
 * price_discount: giá sau khi giảm (ko cho phép user nhập, bằng
 * cách thêm thuộc tính readonly cho input đó)
 * Khi hiển thị ra cần check nếu trường discount
 * và price_discount khác rỗng -> sp đang đc giảm giá
 * + Login/Register
 * + Chức năng đánh giá/feedback sản phẩm
 * Chức năng này sẽ thực hiện sau khi mua hàng thành công
 * Về logic code: tạo 1 bảng feedbacks với các trường như sau:
 * id
 * product_id: sản phẩm đc feedback
 * user_id: user feedback
 * comment: nội dung feedback
 * vote: số sao vote cho sản phẩm
 * created_at
 *
 * Chức năng hiển thị 5 sao để vote thường dùng plugin js, để
 * có thể lưu đc giá trị sao vừa vote vào bảng feedbacks, sẽ tạo
 * ra 1 input ở dạng ẩn, khi click chọn sao, sử dụng js để đổ
 * số sao đó vào input đang ẩn
 * + Sản phẩm yêu thích:
 * Thêm các sản phẩm yêu thích mà user đã chọn khi lướt trang
 * Cơ chế: nên lưu bằng COOKIE hoặc Database
 * - Với COOKIE có thể lưu ở dạng sau: <user_id>|<list_product_id>
 * VD: 3||1,2,3,4,5
 * Khi xử lý sử dụng hàm explode() của PHP để tách chuỗi trên
 * thành 1 mảng dựa theo ký tự phân tách
 * - Lưu bằng CSDL, có thể tạo 1 bảng favorites, có các thông tin
 * sau:
 * id
 * user_id
 * product_id
 * + Tích điểm khi mua hàng thành công
 * Sau khi mua hàng thành công, tích điểm cho user, điểm này
 * có thể dùng để đổi thưởng hoặc giảm giá cho các sản phẩm sau
 * Thêm trường point cho bảng users
 * Tạo 1 bảng points có các thông tin sau
 * id
 * point: số điểm (nếu >= 100đ)
 * discount: số tiền đc giảm
 *
 * Phân tích chức năng giỏ hàng:
 * Chức năng này giống như đi siêu thị
 * Cơ chế xử lý: có thể lưu bằng cách nào cũng đc, hay dùng
 * SESSION để lưu giỏ hàng
 * Chức năng giỏ hàng khó nhất ở bước xác định cấu trúc của giỏ
 * hàng. Trong quá trình demo cấu trúc giỏ hàng có dạng như sau
 */
//$_SESSION['cart'] = [
//    4 => [
//        'name' => 'Sản phẩm 1',
//        'avatar' => 'sp1.jpg',
//        'price' => 300,
//        'quantity' => 4
//    ],
//    7 => [
//        'name' => 'Sản phẩm 2',
//        'avatar' => 'sp2.png',
//        'price' => 500,
//        'quantity' => 1
//    ]
//];
//hàm  array_keys_exitst() dùng để kiểm tra sản phẩm khi thêm
//vào giỏ đã tồn tại trong giỏ hàng hay chưa
// Xử lý Thêm vào giỏ bằng cơ chế Ajax để mang tới sự tiện
//dụng cho người dùng
/**
 * Demo chức năng Thanh toán
 * + Khi user đặt hàng, tiến hành Thanh toán: thông tin người mua
 * hàng: tên, t uổi, địa chỉ .. và thông tin đơn hàng(giỏ hàng)
 * + Ngoài ra còn có các kiểu Thanh toán: thanh toán trực tuyến
 * và thanh toán COD
 * + Luôn gửi mail cho khách hàng sau khi họ mua hàng
 * + Cơ chế code theo mô hình MVC và DB hiện tại:
 * Lưu thông tin ng mua hàng vào bảng orders
 * Lưu thông tin chi tiết đơn hàng trong bảng order_details
 * - Cần phải lưu đồng thời vào 2 bảng orders và order_detail,
 * cần lưu vào bảng orders trước để có được order_id vừa insert,
 * mục đích để sử dụng khi insert vào bảng order_details
 */