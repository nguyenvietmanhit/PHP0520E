<?php
//demo_cookie.php
//1 - Khái niệm:
//Cookie được dùng để lưu các giá trị riêng của các trang web
//để phục vụ cho 1 mục đích gì đó (quảng cáo, tăng tốc độ trang ..)
//Cookie đc lưu trên trình duyệt của user, khác với session(lưu
//trên server)
//Hoàn toàn có thể xem đc trình duyệt đang lưu các cookie gì
//Cookie sẽ ko mất đi khi close trình duyệt như session, chỉ mất
//đi dựa vào thời gian sống (có thể set đc thời gian sống trong
//cookie)
//PHP đã sinh tạo ra sẵn 1 biến $_COOKIE để lưu tất cả các thông
//tin về cookie trên hệ thống, có kiểu mảng
//chức năng hay dùng: ghi nhớ đăng nhập, bookmark (sản phẩm
//yêu thích)
//2 - THao tác với cookie
//thử debug biến $_COOKIE
//khác với session, cookie sẽ ko phải khởi tạo, luôn sử dụng đc
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
//+ khởi tạo cookie, sử dụng hàm setcookie, chứ ko thêm kiểu như
//session
//thời gian sống của cookie được set như sau: lấy thời gian hiện
//tại cộng với thời gian sống muốn set: time() + <số-giây>
setcookie('name', 'Mạnh', time() + 60);
setcookie('age', 30, time() + 5);

// + LẤy giá trị của cookie, giống hệt thao tác lấy giá trị
// với mảng
echo $_COOKIE['name']; //Manh
//do ko chắc key có tồn tại hay ko, vì cookie có thời gian sống
//nên có thể dùng isset trước khi hiển thị
echo isset($_COOKIE['age']) ? $_COOKIE['age'] : ''; //30

//+ cách xem cookie đang được lưu trên trình duyệt
//truy cập Inspect HTML -> tab Application -> Storage -> Cookies
// + Xóa cookie, ko như session là sử dụng unset, mà sẽ sử
//dụng setcookie tuy nhiên thời sống là giá trị âm
setcookie('name', 'dáds', time() - 1);

//+ Sự giống nhau của session và cookie
//đều dùng để lưu thông tin
//+ Khác nhau:
// session hoạt động trên server, cookie hoạt động trên trình
//duyệt, nên session sẽ bảo mật hơn cookie
//session mất đi khi close trình duyệt, còn cookie thì ko