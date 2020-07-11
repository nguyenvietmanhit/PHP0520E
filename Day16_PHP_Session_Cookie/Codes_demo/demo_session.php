<?php
session_start();
//demo_session.php
//Tìm hiểu cơ bản về khái niệm session, ứng dụng trong thực tế
//Ứng dụng điển hình của việc áp dụng cơ chế session là chức năg
//đăng nhập, giỏ hàng
//1 - KHái niệm: hiểu đơn giản như 1 phiên làm việc trên trang web,
//nếu close trình duyệt đi thì lần sau vào lại sẽ mất hết các thông
//tin, ví dụ như thông tin đưang nhập, thông tin giỏ hàng ...
// 2 - Đặc điểm:
// + Giá trị đc lưu trong session có thể được truy cập tại bất cứ
//nơi nào trong hệ thống. vd: ở file A.php khai báo 1 giá trị bằng
//session, thì ở các file B.php, C.php ... hoàn toàn có thể truy cập
//và sử dụng đc biến session đã khai báo ở file A.php
// + PHP cũng đã tạo ra sẵn 1 biến toàn cục lưu tất cả các thông
//tin liên quan đến session trên hệ thống, là mảng $_SESSION, đây
//là mảng kết hợp (key của mảng luôn ở dạng string)
// thử debug để xem thông tin session đang có trên hệ thống
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
//3 - Khởi tạo session:
//Session phải đc đăng ký thì mới cho phép file hiện tại thao tác
//với biến $_SESSION, luôn phải sử dụng hàm session_start(), luôn
//khai báo hàm này ngay trên đầu file, sau thẻ mở PHP
//4 - Thêm dữ liệu cho session: bản chất là thêm phần tử cho mảng
//thêm phần tử có key = name, giá trị = Mạnh cho session
$_SESSION['name'] = 'Mạnh';
$_SESSION['info'] = [
  'name' => 'ABC',
  'age' => 30
];
//thử cố tình cho key của session ở dạng số sẽ báo lỗi
//$_SESSION[2] = 'abc';
//5 - Lấy giá trị của session: bản chất vẫn là lấy giá trị theo
//key của mảng
echo $_SESSION['name']; //Mạnh
print_r($_SESSION['info']);
//tạo 1 biến thông thường, để so sánh với biến session khi thao
//tác ở 1 file khác
$test = 'Test';
echo $test; //Test

// 6 - Thao tác xóa session: bản chất là xóa phần tử theo key của
//của mảng
//Sử dụng hàm unset để xóa phần tử của session
unset($_SESSION['name']); //xóa session có key = name
//để xóa tất cả session đang có trên hệ thống, sử dụng hàm
//session_destroy
//tuy nhiên nên xóa thủ công các session mà do bạn tạo ra, để dễ
//kiểm soát, chứ ko nên xóa toàn bộ session nếu ko kiểm soát đc
//phạm vi ảnh hưởng của các session đó
session_destroy();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";


