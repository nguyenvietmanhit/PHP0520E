<?php
session_start();
require_once 'database.php';
//crud/update.php
//Hiển thị 1 form chứa các thông tin mặc định cho bản ghi
//tương ứng, form hiển thị về mặt cấu trúc form sẽ giống hệt
//form của chức năng Thêm mới
//CÁc bước cần thực hiện để xử lý update
// 1 - Truy cập CSDL để lấy ra bản ghi tương ứng dựa vào
//id bắt từ url, hiển thị các giá trị lấy đc từ bản ghi
//ra các input của form thông qua thuộc tính value
// 2 - Xử lý submit form khi user click Cập nhật, về mặt cơ
//bản thì khá giống việc xử lý form với chức năng thêm mới, chỉ
//khác ở viêc xử lý upload lên, trong trường hợp bản ghi đã tồn
//tại trường avatar r thì khi cập nhật sẽ có 2 trường hợp xảy ra:
// + User ko up đè ảnh -> giữ phải nguyên đường dẫn ảnh cũ
// + User up đè ảnh -> upload ảnh mới như bình thường, xóa ảnh
//cũ đi để tránh rác hệ thống, dùng hàm
// unlink('đường-dẫn-tương-đối') để xóa

