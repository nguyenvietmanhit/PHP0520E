<!--demo_array.php-->
<?php
//KIỂU DỮ LIỆU MẢNG
//1  -Khái niệm
//Kiểu mảng là 1 kiểu dữ liệu trong PHP, cho phép lưu nhiều giá
//trị tại 1 thời điểm, so với các kiểu dư liệu nguyên thủy (integer
//, float, string, boolean) chỉ lưu đc 1 giá trị duy nhất
//bài toán: yêu cầu lưu thông tin của 500 ae
//nếu dùng kiểu dữ liệu nguyên thủy thì phải tạo 500 biến lưu 500
//ae này
$ae1 = 'A';
$ae2 = 'B';
$ae3 = 'C';
//...
//dùng mảng để lưu
//khai báo mảng sử dụng từ khóa array, dùng cho các phiên bản
//PHP từ 5.4 trở về trước
$arr = array('A', 'B', 'C');// ....
//khai báo sử dụng cú pháp [], hay sử dụng cách này
$arr1 = ['A', 'B', 'C']; //...
//2 - Key của phần tử / Key của mảng
//Là giá trị dùng để xác định ra phần tử của mảng
//có thể có các thuật ngữ khác: chỉ mục, indexes
//Để lấy giá trị của 1 phần tử bất kỳ, thì cần phải biết key
//của phần tử đó, đây là khái niệm rất quan trọng khi học về mảng
//

//3 - Vòng lặp foreach
//chuyên dùng để lặp mảng
//có thể dùng các vòng lặp for, while, do...while để lặp mảng, tuy
//nhiên sẽ rất khi dùng
//demo ví dụ dùng vòng lặp for để lặp mảng, và in ra các giá trị
//của từng phần tử trong mảng
$arr = ['A', 'B', 'C', 'D', 'E'];//
$count = count($arr); //5
for($i = 0; $i < $count; $i++) {
  //lấy giá trị của phần tử thì cần phải biết key tương ứng của nó
  echo $arr[$i];
}
//ABCDE
//các vòng lặp for, while, do...while khi lặp với các mảng phức
//tạp sẽ rất khó
//dùng foreach để lặp mảng trên
$arr = ['A', 'B', 'C', 'D', 'E'];//
//cú pháp foreach đầy đủ, xuất hiện cả key và value
//khi cần thao tác với cả key và value
foreach($arr AS $key => $value) {
  echo "Key: $key, Value tương ứng: $value <br />";
}
//cú pháp khuyết, chỉ thao tác với value mà ko cần thao tác với key
//của phần tử
foreach($arr AS $value) {
  echo "Giá trị của phần tử hiện tại = $value <br />";
}

//ngoài sử dụng foreach, có thể lấy giá trị của từng phần tử 1 cách
//thủ công là dựa vào key của phần tử đó
$arr = ['A', 'B', 'C', 'D', 'E'];//
echo $arr[0] ;//A
echo $arr[3]; //D
//cách debug để xem thông tin mảng (key và value)
// 1 cách dễ nhìn nhất
echo "<pre>";
print_r($arr);
echo "</pre>";
//ngoài ra có thể dùng hàm var_dump, nhìn sẽ khó hơn
var_dump($arr);
//vì kiểu mảng là kiểu dữ liệu có cấu trúc, nên ko thể dùng
//hàm echo để hiển thị như các kiểu dữ liệu nguyên thủy đc
//echo $arr;

//chốt lại: để lấy giá trị của 1 phần tử trong mảng có 2 cách:
// - C1: dùng foreach: lặp qua tất cả phần tử mảng
// - C2: dựa theo key của phần tử để lấy, cách thủ công

//4 - Phân loại mảng: có 3 loại chính
//- Mảng tuần tự - mảng số nguyên: key của các phần tử luôn
//là số nguyên, mặc định nếu ko chỉ định cụ thể các key, thì key
//sẽ bắt đầu từ 0;
$numbers = [3, 1, 4, 5, 2];
foreach($numbers AS $number) {
  echo "Giá trị hiện tại: $number <br />";
}
//lấy giá trị theo kiểu thủ công
echo $numbers[4]; //2
//khai báo 1 mảng tuần tự có chỉ rõ key của từng phần tử
$number1 = [
    1 => 'A',
    4 => 'B',
    9 => 'C',
    -1 => 5
];
//với các mảng mà có khai báo tường minh key, thì các vòng lặp
//for, while, do...while sẽ rất khó xử lý
//debug mảng trên
echo "<pre>";
print_r($number1);
echo "</pre>";
foreach($number1 AS $key => $value) {
  echo "Key: $key, Value: $value <br />";
}
$number1 = [
    1 => 'A',
    4 => 'B',
    9 => 'C',
    -1 => 5
];
echo $number1[-1]; //5
echo $number1[9]; //C
// - Mảng kết hợp: key của từng phần tử sẽ có ở cả dạng string
//đây là mảng rất hay gặp, vì mảng kết hợp sẽ mô tả thông tin
//1 cách tốt hơn so với mảng tuần tự
$student = [
    'name' => 'Mạnh',
    'age' => 30,
    'address' => 'Hoài Đức - Hà Nội',
    9 => 'abc'
];
foreach($student AS $key => $value) {
  echo "Key: $key, Value: $value <br />";
}
//lấy kiểu thủ công
echo $student['age']; //30
echo $student['address']; //Hoài Đức - Hà Nội
//debug mảng
echo "<pre>";
print_r($student);
echo "</pre>";
// - Mảng đa chiều: mảng chứa 1 hoặc nhiều mảng bên trong, 1 phần tử
//trong mảng có thể là 1 mảng con, r trong mảng con đó có thể có
//phần tử lại là 1 mảng con khác, cứ thế ....
$class = [
    'name' => 'PHP0520',
    'amount' => 21,
    'info' => [
        'tho' => [
            'tinh_trang_hon_nhan' => 'Độc thân',
            'age' => 12,
            'sđt' => '0987',
            'address' => 'ko biết'
        ],
        'du' => [
            'tinh_trang_hon_nhan' => 'Đã có',
            'age' => 13,
            'sđt' => '0111',
            'address' => 'ko biết'
        ]
    ]
];
//mảng trên là 3 chiều
//với mảng đa chiều thì cần xác định yêu cầu bài toán để xử
//lý foreach cho phù hợp
foreach ($class AS $key => $value) {
  echo "Key: $key";
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}
echo $class['info']['du']['address']; //ko biết
//nếu mảng là do các bạn tự tạo ra, thì cố gắng chỉ dừng ở tối đa
//3 chiều để tránh xử lý phức tạp

//6 - DEMO các bài thực hành
//Thực hành 1
$arrs = [12, 50, 60, 90, 12, 25, 60];
//mảng tuần tử = mảng số nguyên
//tính tổng và tích của các phần tử trong mảng
$sum = 0;
$multiple = 1;
foreach($arrs AS $value) {
  $sum += $value;
  $multiple *= $value;
}
echo "Tổng các phần tử: $sum, Tích các phần tử: $multiple";
//- Thực hành 2
$arrs = ['đỏ', 'xanh', 'cam', 'trắng'];
$red = $arrs[0];
$blue = $arrs[1];
$orange = $arrs[2];
$white = $arrs[3];
$str = "Màu <span class='red'>$red</span> là màu yêu thích của Anh,
 <span class='red'>$white</span> là màu yêu thích của Sơn, 
 <span class='red'>$orange</span> là màu yêu thích của Thắng, 
 còn màu yêu thích của tôi là màu <span class='red'>$blue</span>";
echo $str;
//Thực hành 3:
$arrs = ['PHP', 'HTML', 'CSS', 'JS'];
//hiển thị HTML bằng code PHP
echo "<table border='1' cellpadding='8' cellspacing='0'>";
  echo "<tr>";
    echo "<th>Tên khóa học</th>";
  echo "</tr>";
  foreach($arrs AS $value) {
    echo "<tr>";
      echo "<td>$value</td>";
    echo "</tr>";
  }
echo "</table>";
  //ko nên hiển thị HTML bằng code PHP nếu như HTML dài và phức
//tạp, vì code nhìn sẽ rối và khó debug
//thay vào đó, sử dụng cú pháp viết tắt của foreach
?>
<table border="1" cellspacing="0" cellpadding="8">
  <tr>
    <th>Tên khóa học</th>
  </tr>
<!--  dùng cú pháp viết tắt của foreach-->
  <?php foreach($arrs AS $value): ?>
    <tr>
      <td><?php echo $value; ?></td>
    </tr>
  <?php endforeach; ?>
</table>


<style>
  .red {
    color: red;
  }
</style>
