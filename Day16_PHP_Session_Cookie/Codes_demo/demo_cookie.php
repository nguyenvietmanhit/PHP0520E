<?php
//demo_cookie.php
//DEMO KHÁI NIỆM VÀ THAO TÁC CĂN BẢN VỚI COOKIE
// 1- Khái niệm
// + Cookie dùng để lưu trữ thông tin như session và biến
//thông thường
// + Cookie thường đc sử dụng để phục vụ cho quảng cáo, tăng tốc độ
//truy cập trang cho lần sau bạn truy cập lại, ghi nhớ mật khẩu ...
// + Cookie ko bị mất đi thông tin khi đóng trình duyệt như session,
//do cookie lưu thông tin trên trình duyệt, còn session lưu thông
//tin trên server
// + Cookie sẽ ko bảo mật bằng session, bất cứ ai cũng có thể xem
//đc thông tin cookie đang lưu trên máy của bạn, tuy nhiên với session
//thì ko
// + Về mặt lập trình, PHP cũng tạo ra sẵn 1 biến toàn cục lưu thông
//tin tất cả các cookie đang có trên trình duyệt, mảng $_COOKIE, là
//mảng kết hợp
// 2 - Thao tác với cookie
//debug để xem thông tin mảng $_COOKIE
//cookie ko cần phải khởi tạo như session_start của session
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
// + Khởi tạo cookie, thêm phần tử cho cookie, chú ý: ko áp dụng
//đc như kiểu thêm phần tử cho mảng khi thêm giá trị cho cookie,
//phải sử dụng hàm setcookie để làm điều này
//truyền vào 3 tham số:
//tham số đầu tiên: tên cookie sẽ set
//tham số thứ 2: giá trị tương ứng của cookie đó
//tham số thứ 3: thời gian sống của cookie, tính bằng giây, tính
//từ thời điểm hiện tại
setcookie('username', 'nvmanh', time() + 300);
//xem lại mảng cookie đã thêm đc key=username vào mảng chưa
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
// + Lấy giá trị của cookie, giống như thao tác với mảng, lấy giá
//trị của mảng theo key tương ứng
echo $_COOKIE['username'];//nvmanh
// + Xóa cookie, ko áp dụng đc theo kiểu xóa phần tử mảng, vẫn dùng
//lại hàm setcookie, tuy nhiên thời gian sống sẽ để giá trị âm
setcookie('username', '', time() - 1);
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
//do session và cookie đều là 1 mảng, nên để chắc chắn, trước khi
//hiển thị ra giá trị tương ứng theo key của mảng, thì cần sử dụng
//hàm isset
echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';

//ĐIỂM GIỐNG NHAU VÀ KHÁC NHAU GIỮA SESSION VÀ COOKIE
// + Giống nhau: đều dùng để lưu thông tin, giống như biến
// + Khác nhau:
// Session sẽ mất đi khi close trình duyệt, còn cookie thì ko
// Session bảo mật hơn cookie, ko thể xem đc thông tin session của
//1 trang web nào đó, trong khi đó có thể xem đc các trang web đó
//đang lưu các thông tin cookie nào trên trình duyệt của bạn, vì
//session chạy trên server, còn cookie chạy trên trình duyệt
