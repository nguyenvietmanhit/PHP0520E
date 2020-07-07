<?php
//demo_read_write_file.php
//DEMO việc đọc và ghi file trong PHP
//vd: tạo ra các chức năng import file trên hệ thống, ví dụ
//file excel, file csv
//PHP hỗ trợ các hàm sau cho việc đọc/ghi file: fopen,
//fwrite, fread, file_get_contents, file_put_contents, file

//1 - Đọc nội dung file trong file test.txt, có 2 kiểu đọc:
//+ Đọc nội dung theo từng dòng, sử dụng hàm file($file_path)
//trả về 1 mảng, mỗi phần tử của mảng chính là 1 dòng mà nó đọc
//được
$rows = file('test.txt');
foreach($rows AS $row) {
    echo "$row <br />";
}
echo "<pre>";
print_r($rows);
echo "</pre>";
//+ Đọc toàn bộ nội dùng file,
// dùng hàm file_get_contents($file_path)
//hàm này sẽ dùng thay thế cho các hàm fopen, fread
$file_content = file_get_contents('test.txt');
echo $file_content;

//lấy nội dung file của 1 domain thật, tùy thuộc vào cơ chế
//của domain đó có cho phép lấy nội dung hay
//echo file_get_contents('https://vnexpress.net/de-xuat-mo-duong-bay-quoc-te-vao-cuoi-thang-7-4122678.html');

//2 - Ghi file
//Sử dụng hàm file_put_contents($file_path, $content, $mode)
//- Ghi đè vào nội dung file cũ là file test.txt
//file_put_contents('test.txt', 'Nội dung mới');

//đọc lại nội dung file test.txt sau khi ghi đè file
//echo file_get_contents('test.txt');

//- Ghi nối tiếp vào nội dung file test.txt, cần truyền vào
//hằng số FILE_APPEND cho tham số thứ 3
file_put_contents
('test.txt', 'Nội dung mới', FILE_APPEND);
//hiển thị nội dung file
echo file_get_contents('test.txt');

//3 - Một số hàm có sẵn khác về thao tác với file
//- Xóa file: unlink($path_file)
//với hàm unlink thường sẽ thêm ký tự @ ở đầu hàm
//để bỏ qua lỗi khi xóa ko file tồn tại
//@unlink('test.txt');
//- Kiểm tra đường dẫn file/thư mục có tồn tại hay ko
//file_exists($path)
//đường dẫn file có thể là đường dẫn tương đối hoặc
//đường dẫn vật lý
$is_exist = file_exists('testdsadas.txt');
var_dump($is_exist);
//- fopen, fread, fwrite, fclose: tham khảo thêm, dùng
//để mở file, đọc file, ghi file, đóng file