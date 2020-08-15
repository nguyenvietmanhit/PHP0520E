<?php
/**
 * cac_buoc_dung_web_mvc_tu_dau.php
 * 1 . Cần có ý tưởng đầu tiên như sau:
 * + Chọn tên project sẽ làm: bán hàng, tin tức, thi online
 * + Làm độc lập/ Làm theo nhóm (tối đa 3 member) ?
 * 2 . Chuẩn bị giao diện HTML cho backend và frontend
 * + Backend: hướng tới số ít người dùng hơn frontend, vd:
 * các nhà quản trị, sales, editor ... Backend sẽ CRUD dữ liệu,
 * frontend sẽ hiển thị ra. Giao diện backend thường sẽ ko quan
 * trọng bằng frontend, có thể tham khảo các template backend
 * trên mạng. Trong project demo dùng 1 template backend:
 * AdminLTE. mockup_html/backend/
 * + Frontend: hướng tới user, giao diện nên chau chuốt, có thể
 * tự code hoặc đi tìm 1 template free.
 * Phân tích CSDL sẽ dựa chủ yếu vào giao diện frontend, cần liệt
 * kê tất cả các trang có thể có với chủ đề project, có thể vào
 * các trang bán hàng mẫu, trải nghiệm chức năng, xác định các
 * trang có thể có sao cho phù hợp với project
 * Với project bán hàng demo trong khóa học, có các trang sau:
 * trang chủ, chi tiết sản phẩm, danh sách sản phẩm, liên hệ,
 * giỏ hàng, thanh toán, đăng ký/đăng nhập, tin tức ...
 * Sau khi liệt kê các trang con, cần phải xây dựng tất cả giao
 * diện HTML cho các trang con này
 * 3 - Phân tích CSDL dựa vào giao diện frontend: về mặt cơ bản
 * , cái gì mà hiển thị trên trang web, đều hoàn toàn có thể
 * tạo các trường trong bảng để lưu
 * - Với các thông tin ít thay đổi ko cần thiết phải lưu trong
 * CSDL
 * - Các thông tin hay thay đổi thì chắc chắn phải lưu trong
 * CSDL, cần tạo ra các bảng để lưu các thông tin này
 * Phân tích giao diện demo để tạo ra các bảng tương ứng:
 * Chú ý: để có thể phân tích ra các trường trong bảng: dựa vào
 * các thông tin thể hiện trên giao diện, dựa vào kinh nghiệm
 * (nghiệp vụ của đối tượng)
 * + Bảng menus: có thể xây dựng chức năng menu động
 * id: khóa chính
 * name: tên menu, varchar(100)
 * url: url để chuyển hướng varchar(200)
 * status: trạng thái menu, 0 - ẩn, 1 - hiện TINYINT(1)
 * parent_id: id cha của menu hiện tại, INT(11)
 * created_at: ngày tạo menu, TIMESTAMP CURRENT_TIMESTAMP
 * updated_at: ngày cập nhật cuối cùng, DATETIME
 * Thông thường 1 bảng bao giờ cũng có 4 trường sau: id, status,
 * created_at, updated_at
 * + Bảng products: chứa các thông tin về sản phẩm
 * id:
 * category_id: khóa ngoại, liên kết tới bảng categories,
 * 1 sp chỉ thuộc về 1 danh mục duy  nhất
 * title: varchar(100)
 * amount: số lượng sản phẩm, INT(7)
 * price: giá sp, INT(9)
 * summary: mô tả ngắn cho sp, TEXT
 * content: chi tiết sản phẩm, TEXT
 * avatar: lưu tên file ảnh, VARCHAR(100)
 * seo_title: seo về tên sản phẩm
 * seo_description: seo về mô tả cho sản phẩm
 * seo_keyword: seo về các từ khóa khi search
 * status
 * created_at
 * updated_at
 *
 * + Bảng product_images: thể hiện cho 1 sp có thể có nhiều
 * ảnh con, về mặt cơ bản nếu có mối quan hệ 1 - nhiều thì có
 * thể tạo thêm 1 bảng mới
 * id:
 * product_id: khóa ngoại, liên kết với bảng products
 * avatar: tên file ảnh tương ứng
 * status
 * created_at
 * updated_at
 *
 * + Bảng categories: chứa các thông tin về danh mục
 * id
 * name: tên danh mục, VARCHAR(100)
 * description: mô tả về danh mục, TEXT
 * avatar: chứa tên file ảnh, VARCHAR(100)
 * type: phân loại danh mục, 0 - danh mục sản phẩm, 1 - danh mục
 * tin tức, TINYINT(1)
 * status
 * created_at
 * updated_at
 * + Bảng news: chứa các thông tin về tin tức
 * id
 * category_id: khóa ngoại, liên kết với bảng categories
 * title: tên tin, VARCHAR(150)
 * summary: mô tả ngắn cho tin, TEXT
 * content: chi tiết tin, TEXT
 * avatar: chứa tên file ảnh, VARCHAR (100)
 * seo_title: seo cho tên tin
 * seo_description: seo cho phần mô tả tin
 * seo_keywords: seo cho các từ khóa khi search tin
 * status
 * created_at
 * updated_at
 *
 * + Bảng users: lưu các thông tin users:
 * id
 * avatar: chứa tên file ảnh, VARCHAR(100)
 * email: VARCHAR(100)
 * phone: VARCHAR(30)
 * first_name: VARCHAR(150)
 * last_name: VARCHAR(150)
 * address: VARCHAR(255)
 * jobs: VARCHAR(50)
 * role: quyền của user: 0 - admin, 1 - user thường, 2 - sale
 * 3  -editor .... TINYINT(1)
 * marital_status: tình trạng hôn nhân: 0 - độc thân, 1 - có gia
 * đình, 2 - mối quan hệ phức tạp TINYINT(1)
 * gender: giới tính, 0 - nam, 1 - nữ, 2 - ko xác định,
 * TINYINT(1)
 * last_login: lần đăng nhập cuối, DATETIME, lưu khi user logout
 * khỏi hệ thống
 * username: VARCHAR(100)
 * password: VARCHAR(255)
 * status
 * created_at
 * updated_at
 *
 * + Bảng orders: lưu các thông tin đơn hàng
 * id
 * fullname: tên ng mua hàng VARCHAR(100)
 * address: địa chỉ giao hàng VARCHAR(255)
 * mobile: sdt ng mua hàng VARCHAR(30)
 * note: ghi chú thêm từ khách hàng, TEXT
 * user_id: khóa ngoại, liên kết với bảng user, dùng nếu user
đã đăng nhập mà mua hàng -> hiển thị các thông tin đã có từ
user này
 * price_total: tổng giá trị đơn hàng, INT(11)
 * payment_status: trạng thái thanh toán đơn hàng, 0 - chưa
 * thanh toán, 1 - đã thanh toán, 2 - Đang giao hàng, 3 - Đang
 * trả góp
 * created_at
 * updated_at
 *
 * + Bảng order_details: thông tin chi tiết đơn hàng, nhìn vào
bảng này sẽ biết được đơn hàng có các sản phẩm nào, số lượng
của sp tương ứng đã mua là bao nhiêu, do mối quan hệ giữa bảng
orders và order_detail đang là 1-n nên sẽ tách ra bảng
order_details
 * order_id: khóa ngoại, liên kết với bảng orders
 * product_id: khóa ngoại, liên kết với bảng products
 * quantity: số lượng sản phẩm
 *
 * 4 - Tạo CSDL tên php0520e_project
Copy nội dung file file_create_db.html để tạo các bảng từ việc
phân tích trên
 */

?>