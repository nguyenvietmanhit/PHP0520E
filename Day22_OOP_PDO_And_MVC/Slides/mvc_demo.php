<?php
/**
 * mvc_demo.php
 * 1 - Khái niệm
 * + MVC - Model - View - Controller: là 1 mô hình kiến trúc phần
 * mềm, bao gồm 3 lớp Model, View, Controller
 * + MVC rất phổ biến trong các Framework và CMS của PHP
 * + MVC tách ứng dụng web -> 3 lớp, giúp cho việc quản lý và bảo
 * trì code dễ dàng hơn
 * + MVC khá khó tiếp cận với các bạn mới, do sử dụng OOP làm nền
 * tảng để xây dựng
 * 2 - Thành phần của MVC
 * + M - Model: chứa các class chỉ dùng để tương tác với CSDL
 * + V - View: chứa các file chỉ dùng để hiển thị dữ liệu tới user
 * + C - Controller: tầng trung gian, luân chuyển dữ liệu giữa
 * Model và View
 * 3  -Luồng xử lý dữ liệu của MVC
 * 4 - Cấu trúc thư mục code của mô hình MVC trong khóa học
 * + Do mô hình MVC là do chính các bạn tự định nghĩa ra, nên có
 * thể sẽ có nhiều cấu trúc thư mục code khác nhau
 * + Demo tạo cấu trúc thư mục MVC
 * mvc_demo/
 *         /index.php: đây là file index gốc của ứng dụng, bất cứ
 *                     mô hình MVC nào cũng có 1 file có tên là
 *                     index.php ngay dưới thư mục gốc. File này
 *                     nhận tất cả các yêu cầu gửi lên từ user, phân
 *                     tích để gọi controller tương ứng xử lý
 *         /.htaccess: chứa các rule cho việc rewrite URL - viết
 *                     lại các đường dẫn đẹp
 *         /assets: chứa các thư mục/file liên quan đến frontend
 *                /css: chứa các file .css
 *                    /style.css: file css chính của ứng dụng
 *                /js: chứa các file .js
 *                   /script.js: file js chính của ứng dụng
 *                /images: chứa các ảnh tĩnh của ứng dụng
 *                /fonts
 *                /webfonts
 *         /configs: chứa các class cấu hình hệ thống như db, system...
 *                 /Database.php: class chứa các hằng số kết nối CSDL
 *                              tên class thường trùng với tên file
 *                              ,viết hoa từ đầu tiên của từng từ
 *         /controllers: chứa các class controller của ứng dụng
 *                     /CategoryController.php: class quản lý
 *                      category, với mô hình MVC hiện tại, thì
 *                      class là controller bắt buộc phải có
 *                      từ Controller phía sau
 *        /models: chứa các class model của ứng dụng
 *               /Category.php: class model của category
 *        /views: chứa các thư mục view theo chức năng
 *              /categories: thư mục chứa các view của qly category
 *                         /index.php: liệt kê category
 *                         /create.php: thêm mới category
 *                         /update.php: cập nhật category
 *                         /detail.php: chi tiết category
 *              /layouts: chứa các file layout của hệ thống
 *                      /header.php: file header của ứng dụng
 *                      /footer.php: file footer của ứng dụng
 *                      /main.php: file layout chính, nhúng header
 *                                 và footer vào
 *
 */