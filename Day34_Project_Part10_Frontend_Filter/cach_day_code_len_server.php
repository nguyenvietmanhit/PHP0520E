<?php
/**
 * cach_day_code_len_server.php
 * - Bình thường code trên localhost chỉ có thể truy cập khi
 * mở máy tính lên, cần 1 server chạy 24/24 để user có thể
 * truy cập bất cứ lúc nào
 * - Cần thuê 1 hosting từ bên ngoài để upload code của bạn
 * lên, hosting bản chất chính là 1 thư mục nằm trong webserver
 * của bên cung cấp hosting, tương tưởng đang upload code vào
 *trong thư mục htdocs của xampp
 *- Domain - tên miền để user nhập trên trình duyệt, truy cập
 *vào trang của bạn, vd: abc-php.com
 *
 *  Hướng dẫn đẩy code từ local lên server thật của itplus
 *  - Trên từng máy cá nhân, tạo cấu trúc file/thư mục như sau
 * htdocs/php0520e_<tên của bạn>/
 *                              /test.php: echo "<tên-của-bạn>";
 * - Dùng PHPStorm mở thư mục: php0520e_<tên của bạn>
 */