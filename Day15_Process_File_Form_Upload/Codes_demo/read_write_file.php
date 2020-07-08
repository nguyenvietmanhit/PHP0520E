<?php
//read_write_file.php
//Demo 1 số thao tác cơ bản về đọc ghi file
//Thao tác đọc ghi file trong thực tế có thể gặp ở các chưcs
//năng như: Import file (.csv, .txt, .docx, .xlsx)
// PHP cung cấp 1 số hàm có sẵn cho việc đọc/ghi file: fopen,
//fwrite, fread, file, file_get_contents, file_put_contents
//Hiện tại sẽ sử dụng các hàm:
//+  file, file_get_content -> đọc nội dung file
//+  file_put_contents -> ghi nội dung vào file
//1 - Đọc nội dung file:
//Có 2 kiểu đọc: đọc theo từng dòng hoặc đọc toàn bộ nội dung
// + Đọc nội dung file read.txt theo từng dòng, đây là kiểu
//đọc thông dụng nhất
//hàm file() sẽ trả về 1 mảng, mỗi phần tử của mảng chính là
//từng dòng dữ liệu trong file
$files = file('read.txt');
foreach($files AS $file) {
  echo "$file <br />";
}
// + Đọc toàn bộ nội dung file ra, sử dụng hàm file_get_contents()
//hàm này sẽ trả về kiểu dữ liệu string, chính là nội dung file
$content = file_get_contents('read.txt');
var_dump($content);
//hàm này còn có thể lấy đc nội dung từ 1 url thực tế
//phụ thuộc vào url đó có cho phép lấy dữ liệu về hay ko
//$vne = file_get_contents('https://vnexpress.net/');
//echo $vne;

//Copy file Bai_tap_ve_nha/bt6.csv ngang hàng
//với file code hiện tại. Đọc nội dung file và
//hiển thị ra dưới cấu trúc dạng bảng HTML
$files = file('bt6.csv');
echo "<pre>";
print_r($files);
echo "</pre>";
?>
<table border="1" cellspacing="0" cellpadding="8">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Status</th>
    <th>Created_at</th>
  </tr>
  <?php
  foreach($files AS $file):
    //cần chuyển chuỗi $file thành 1 mảng các phần tử, dựa vào
    //ký tự phân tách là , (do file .csv luôn dùng ký tự , để
    // ngăn cách các giá trị)
    $arr_info = explode(',', $file);
  ?>
    <tr>
      <td><?php echo $arr_info[0]?></td>
      <td><?php echo $arr_info[1]?></td>
      <td><?php echo $arr_info[2]?></td>
      <td><?php echo $arr_info[3]?></td>
      <td><?php echo $arr_info[4]?></td>
      <td><?php echo $arr_info[5]?></td>
    </tr>
  <?php
  endforeach;
  ?>
</table>

<?php
//DEMO ghi file trong PHP
//Việc ghi nội dung cho file có 2 kiểu: ghi đè, ghi thêm vào file
//(giữ nguyên nội dung cũ)
//sử dụng hàm file_put_contents để thực hiện ghi file
// + ghi vào file write.txt theo kiểu ghi đè
//file_put_contents('write.txt', 'ghi đè file');
// + ghi thêm vào file. giữ nguyên nội dung cũ
file_put_contents('write.txt',
    'Nội dung ghi thêm', FILE_APPEND);

//GIỚI THIỆU 1 SỐ HÀM KHÁC VỀ THAO TÁC VỚI FILE/THƯ MỤC
// + Xóa file/thư mục, sử dụng hàm unlink
//xóa file write.txt khỏi hệ thống, thông thường hay dùng
//ký tự @ trước tên hàm unlink để tránh báo lỗi trong 1 số
//trường hợp như xóa file ko tồn tại
@unlink('write.txt');
//+ Kiểm tra đường dẫn file/thư mục đã tồn tại hay chưa,
//file_exists
$is_exists = file_exists('read.txt');
var_dump($is_exists); //true
// + Tạo thư mục: mkdir()
mkdir('abc');
?>

