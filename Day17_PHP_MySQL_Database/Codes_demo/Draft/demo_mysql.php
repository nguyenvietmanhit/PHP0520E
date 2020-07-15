<?php
//demo_mysql.php
//1 - CSDL MySQL luôn đi kèm với ngôn ngữ PHP
//2 - MySQL mặc định đc cài sẵn khi cài XAMPP
// (cùng với Apache và PHP)
// 3 - XAMPP cũng tự cài đặt 1 công cụ để quản trị CSDL về mặt
//đồ họa là PHPMyAdmin, thực tế khi đi làm sẽ dùng các phần mềm
//chuyên dụng hơn để quản lý CSDL như Workbench (free),
// Navicat (crack)

//4 - Trong CSDL sẽ có các bảng, vd: với trang bán hàng thì sẽ
//có các bảng sau, tên bảng thì nên viết ở dạng số nhiều,
// và viết bằng chữ thường hết:
// categories : quản lý thông tin các danh mục trên hệ thống
// products: quản lý thông tin sản phẩm
// users: quản lý user
// order_details:
//5 - Trong các bảng thì sẽ có:
//+ Các trường/cột: mô tả cấu trúc bảng
// vd: bảng categories: id, name, status, created_at ....
//+ Các hàng/bản ghi: là các thông tin cụ thể của từng đối tương
//bảng
//vd: id=1, name=Thể thao, status=1, created_at = 06/07/2020
//  + Khóa chính của bảng: thể hiên cho việc các bản ghi đc phân
////biệt với nhau, 1 bảng thường sẽ có 1 khóa chính là id, về
/// //mặt kỹ thuật thì khóa chính sẽ đc tự động tăng mỗi khi bảng
/// //sinh ra bản ghi mới
// + Khóa ngoại của bảng: là khóa chính của bảng khác, để thể
////hiện cho sự liên kết (relation) giữa các bảng
/// các relation chính: 1 - 1, 1 - n, n - n
///
//Thực hành thao cơ bản với CSDL MySQL sử dụng PHPMyadmin
//1 - Tạo CSDL php0320e:
//2 Trong CSDL này tạo bảng categories, có các trường:
// id, name, status, created_at
//3 - Thêm các bản ghi mới cho bảng categories dùng tab Insert
//4 - Export CSDL vừa tạo để sử dụng ở 1 nơi khác, đuôi file của
//CSDL là .sql, dùng tab Export
//5 - Xóa CSDL vừa tạo sử dụng tab Operations


//CÁC CÂU TRUY VẤN THAO TÁC VỚI CSDL MYSQL
//trong MYSQL sẽ ko phân biệt hoa thường, các từ khóa viết
//hoa hay thường đều được, nhưng thường từ khóa sẽ viết hoa


#1 - Tạo CSDL
#CREATE DATABASE demo1;
# tạo csdl nếu chưa tồn tại, đồng thời set cho phép lưu
# ký tự có dấu (utf8)
CREATE DATABASE IF NOT EXISTS php0320e CHARACTER SET utf8 COLLATE utf8_general_ci;
#2 - Sử dụng CSDL muốn thao tác, giả sử sẽ thao tác với CSDL categories vừa tạo
USE php0320e;
#3 - Xóa CSDL
DROP DATABASE demo1;


#6 - Xóa bảng
# DROP TABLE abc;
#7 - THêm dữ liệu vào bảng: INSERT INTO
#Thêm 1 số dữ liệu mẫu vào bảng categories, sẽ dùng cặp ký tự `` để bao lấy tên trường, để đề phòng tên trường bị trùng với từ khóa trong mySQL
#Bảng categories đang có các trường sau: id, name, status, created_at
#INSERT INTO categories(`name`, `status`)
#cú pháp thêm nhiều giá trị trong 1 câu truy vấn
#VALUES ('Thể thao', 1), ('Thế giới', 2), ('Thời sự', 3)

#Thêm dữ liệu cho bảng products, đang có các trường id, category_id, name, created_at
#INSERT INTO products(`category_id`, `name`)
#chú ý, khi thêm dữ liệu cho khóa ngoại category_id, cần tham chiếu đến bảng mà trường đó đang làm khóa chính, cụ thể là cần tham chiếu đến trường id của bảng categories
#VALUES
#(1, 'Sản phẩm thể thao 1'), (2, 'Sp thế giới 1'), (3, 'Sp thời sự 1');

#8 - Truy vấn SELECT
#LẤy dữ liệu từ bảng
#Lấy tất cả thông tin từ bảng categories:
SELECT * FROM categories;
#LẤy trường cụ thể từ bảng, chứ ko lấy tất cả trường
SELECT id, created_at FROM categories;
#Lấy tất cả bản ghi với điều kiện gì đó
SELECT * FROM categories WHERE id > 2; #chỉ lấy các bản ghi có id > 2
#lấy các bản ghi có id = 1 hoặc id = 2;
SELECT * FROM categories WHERE id = 1 OR id = 2;
#lấy giới hạn các bản ghi
SELECT * FROM categories LIMIT 2; #chỉ lấy ra bản ghi đầu tiên
#lấy từ bản ghi thứ 2, và chỉ lấy 1 bản ghi tính từ bản ghi thứ 2 đó
SELECT * FROM categories LIMIT 2,1;

#9 - Update
# Cập nhật dữ liệu cho bản ghi
#VD: cập nhật name = Name update cho category đang có id = 1
#chú ý: với truy vấn update, delete thì luôn cần xác định điều kiện đi kèm, nếu ko sẽ update/delete toàn bộ bảng
UPDATE categories SET `name` = 'Name update' WHERE id = 1;

#10 - Delete
#Xóa bản ghi của bảng
#chú ý: với truy vấn update, delete thì luôn cần xác định điều kiện đi kèm, nếu ko sẽ update/delete toàn bộ bảng
#Xóa các bản ghi nào mà có id > 4 của bảng categories
DELETE FROM categories WHERE id > 4;

#11 - Từ khóa LIKE
#Thường dùng để tìm kiếm tương đối
#ký tự % là đại diện cho các ký tự bất kỳ
#lấy các thông tin của bảng categories mà name có chứa chuỗi Th
SELECT * FROM categories WHERE name LIKE '%th%'; #abcth12, th, th123

#12 - Từ khóa ORDER BY
#Sắp xếp bản ghi trả về theo thứ tự nào đó
#sắp xếp giảm dần: DESC (descending)
#sắp xếp tăng dần: ASC (ascending)
#vd: lấy tất cả bản ghi từ bảng categories, sắp xếp theo thứ tự giảm dần
#của trường id
SELECT * FROM categories ORDER BY id DESC;

#13 - JOIN
#Thực tế các hệ thống web sẽ bao gồm rất nhiều bảng, nên sẽ cần cơ chế join các bảng để lấy các thông tin tương ứng
#JOIN chỉ hoạt động trên các bảng mà có sự liên kết (khóa ngoại)
#vd: lấy tất cả bản ghi từ bảng products kèm theo tên danh mục tương ứng của từng bản ghi
#chú ý: khi join bảng, thì cần viết <tên-bảng>.<tên-trường-tương-ứng> khi muốn thao tác với trường
#có 3 cơ chế join: inner join, left join, right join. THường dùng inner join để đảm bảo tính toàn vẹn của dữ liệu, nghĩa là các bảng liên quan phải có dữ liệu thì mới lấy ra đc
#trong trường hợp các bảng có tên trường bị trùng, thì cần đặt định danh sử dụng từ khóa AS cho 1 trường
SELECT products.*, categories.name AS category_name FROM products
INNER JOIN categories
ON products.category_id = categories.id;






