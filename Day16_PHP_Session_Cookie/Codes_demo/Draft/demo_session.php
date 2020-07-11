<?php
session_start();
//bắt buộc phải khởi tạo session thì mới dùng được biến $_SESSION
//sử dung hàm session_start, thường sẽ được khai báo ở trên cùng
//của file


//demo_session.php
//1 - KHái niệm
//Session được hiểu như 1 phiên làm việc, sẽ mất đi khi close hẳn
//trình duyệt
//Các giá trị được lưu session có thể được truy cập ở bất cứ
////file nào trên hệ thống
//1 số ứng dụng của session: login, giỏ hàng
//session chỉ được lưu trên server, ko phải trên trình duyệt nên
//có độ bảo mật cao
// PHP có sẵn 1 biến toàn cục để lưu trữ tất cả thông tin session
//trên hệ thống, $_SESSION, là biến kiểu mảng
//thử debug
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

//2 - Thao tác với session, giống hệt thao tác với mảng
//+ Thêm dữ liệu cho session, thêm phần tử cho mảng
//chú ý: key của phần tử trong session ko thể là số
$_SESSION['name'] = 'Mạnh';
$_SESSION['age'] = 30;
$_SESSION['a'] = 1; // thêm phần tử cho session với key = a
$_SESSION['b'] = 'abc'; //thêm phần tử cho session với key = b
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

//+ Lấy giá trị của session, chính là lấy giá trị theo key của
//phần tử
echo $_SESSION['name']; //Mạnh

//Xóa session, chính là xóa phần tử theo key tương ứng
//sử dụng hàm unset
unset($_SESSION['name']);

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
//muốn xóa tất cả session hệ thống, sử dụng hàm session_destroy
//tuy nhiên hàm này chỉ hoạt động khi chạy code lần thứ 2
//nên thông thường vẫn sử dụng hàm unset để xóa session tương ứng