<?php
/**
 * cac_chuc_nang_backend.php
 * Liệt kê và ý tưởng các chức năng chính có thể có trong
 * backend
 * + Các chức năng CRUD: về mặt cơ bản, mỗi 1 table trong CSDL
 * đều có 1 CRUD quản lý
 * + Đăng ký/Đăng nhập:
 * Đăng ký: khi lưu password vào trong CSDL, bắt buộc phải
 * mã hóa trc khi lưu, về mặt truy vấn SQL là INSERT, trước khi
 * đăng ký cần phải check trùng username hay chưa, về mặt truy
 * vấn SELECT kết hợp WHERE
 * Đăng nhập: khi login cần mã hóa password trước r mới check
 * trong CSDL, SELECT kết hợp WHERE
 * + THống kê:
 * - Tổng số đơn hàng trên hệ thống, SELECT COUNT(id) của bảng
 * đơn hàng
 * - Số đơn hàng chưa thanh toán, đã thanh toán, đang giao hàng
 * ..., SELECT COUNT(id) dựa trên trường payment_status của
 * bảng đơn hàng
 * - Sản phẩm bán chạy nhất: dựa theo đơn hàng có sản phẩm đó,
 * dựa vào bảng chi tiết đơn hàng với các trường order_id,
 *product_id, quantity -> truy vấn SELECT COUNT(quantity)
 * GROUP BY product_id
 * - Số tin tức trên hệ thống -> SELECT COUNT(id) từ bảng news
 * + Quên mật khẩu:
 * - Nhập username vào form quên mật khẩu, check
 * xem username đã tồn tại hay chưa , nếu tồn tại thì sẽ gửi
 * 1 mail reset password, trong mail sẽ có 1 url để cho phép
 * user click vào thì tới trang đổi mật khẩu. VD 1 url đơn giản
 * nhất theo mô hình mvc hiện tại:
 * http://localhost/index.php?controller=user&action=reset_password
 * &username=<chuỗi-mã-hóa-của-username>
 * - Mọi URL khi gửi qua mail đều phải là url dạng domain, có http,
 * có tên domain
 * - Khi user click vào url trên -> tới 1 form đổi mật khẩu
 * + Phân quyền: Cho phép các user có quyền đc làm gì đó trên
 * hệ thống
 * - Có thể tạo 1 bảng để lưu các quyền trên hệ thống:
 * roles: id, name, description
 * vd name có thể là: super admin, admin, sales, editor...
 * Cần tự quy định các role này có quyền gì trên hệ thống
 * Cần thêm 1 trường role_id vào bảng users
 * - Logic check quyền: giả sử với quyền sales chỉ truy cập đc
 * chức năng liên quan đến đơn hàng, sales thì ko thể truy cập
 * đc product và news -> chặn ở controller producr và news tương
 * ứng
 * + Tìm kiếm, phân trang: demo trên lớp
 *
 * 2 - Cách ghép giao diện (template) vào mô hình MVC
 * + Copy toàn bộ mã HTML vào file layout chính của mô hình MVC,
 * với MVC hiện tại -> copy vào views/layouts/main.php
 * + Chuyển toàn bộ cấu trúc các file css,js, images nếu có
 * từ template đó -> assets của mô hình MVC
 * + Trong file layout main.php cần kiểm tra lại đường dẫn
 * của các file .css, .js, các images xem đã nhúng đúng
 * đường dẫn chưa
 * + Phân tích layout để tách bố cục thành các phần header,
 * footer, main nếu cần
 * + Sau khi kiểm tra giao diện đã hiển thị đúng, ghép nội dung
 * động vào file layout main.php này: content, title_page,
 * seo_title, seo_description, seo_keyword
 * + Luôn hiển thị các thông báo lỗi, thành công, session liên
 * quan đến lỗi/thành công tại file layout này
 *
 *
 * - DEMO chức năng đăng ký, đăng nhập, đăng xuất bên backend
 * + Chức năng đăng ký:
 * - Về cơ bản form đăng ký bao gồm các input
 * nhập username, nhập password và confirm password
 * - Mật khẩu khi lưu vào CSDL bắt buộc phải mã hóa, có rất nhiều
 * cơ chế mã hóa như AES .... Khi demo sử dụng cơ chế mã hóa
 * md5 - là cơ chế mã hóa chỉ dùng để demo , ko áp dụng trong
 * thực tế
 * - Khi xử lý đăng ký, cần phải check xem username đã tồn tại
 * chưa
 * - Giao diện của form đăng ký đang hoàn toàn khác so với giao
 * diện chính của backend -> tạo ra 1 file layout mới chỉ dùng
 * cho các chức năng mà user chưa đăng nhập, còn nếu đăng nhập
 * r thì sẽ dùng layout main.php chính của ứng dụng
 *
 * + Chức năng Đăng xuất/Logout: logout tài khoản hiện tại
 * Cơ chế: xóa các session mà khi đăng nhập thành công đã tạo ra
 * , ko nên sử dụng session_destroy vì hàm này chỉ hoạt động
 * tại thời điểm thứ 2
 * + Chức năng tìm kiếm sản phẩm: giúp tìm kiếm sản phẩm theo
 * thông tin mà user mong muốn
 * - Về mặt truy vấn: sử dụng truy vấn SELECT, chia làm 2 cơ chế
 * tìm kiếm:
 * + Tìm kiếm tương đối: cứ chứa chuỗi tìm kiếm là đc,
 * sử dụng LIKE, áp dụng cho dữ liệu mà user có thể nhập đc:
  tên sp, giá sp
 * + Tìm kiếm tuyệt đối: sử dụng điều kiện =, áp dụng với các
 *dữ liệu mà hệ thống đã tạo ra từ trước, vd: tìm kiếm theo tên
 *danh mục mà sản phẩm đó đang thuộc về
 * - Với backend, thông thường chức năng tìm kiếm sản phẩm,
 * sẽ để tại màn hình danh sách sản phẩm
 */
