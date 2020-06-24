<?php
//demo_basic_2.php
//1 - Toán tử: giống hệt javascript
// - Toán tử số học:
$number1 = 5;
$number2 = 2;
echo $number1 + $number2; //7
echo $number1 - $number2; //3
echo $number1 * $number2; //10
echo $number1 / $number2; //2.5
echo $number1 % $number2; //1
$number1++;
echo $number1; //6
$number2--;
echo $number2;//1
// Toán tử so sánh: trả về kiểu dữ liệu boolean
$number1 = 5;
$number2 = 2;
echo $number1 == $number2; //false
echo $number1 > $number2; //true
echo $number1 >= $number2; //true
echo $number1 < $number2; //false
echo $number1 <= $number2; //false
echo $number1 != $number2; //true

//- Toán tử logic: kết hợp các biểu thức so sánh:
// and &&, or ||, not !
$number1 = 5;
$number2 = 2;
echo ($number1 > 0) && ($number2 < 0); //false
echo ($number1 > 0) || ($number2 < 0); //true
echo !($number1 == 0 && $number2 > 0); //true

//- Toán tử gán:
$number = 5; //phép gán
$number += 5; //10
$number -= 2; //8
$number *= 2; //16
$number /= 4; //4
$number %= 2; //0

//- Toán tử điều kiện, sử dụng cú pháp ? :
//được sử dụng thay cho if else khi logic code bên trong if...else
//đơn giản
//ví dụ với if else
$number = 5;
if ($number > 0) {
  echo 'Number > 0';
} else {
  echo 'Number <= 0';
}
//sử dụng toán tử điều kiện thay thế
echo $number > 0 ? 'Number > 0' : 'Number <= 0';

//Thực hành 2:
$number1 = 10;
$number2 = 7;
echo '<span style="color: red">';
echo "$number1 + $number2 = " . ($number1 + $number2);
echo "<br />";
echo '</span>';

//2 - Câu lệnh điều  kiện, biểu thức switch case
//CÂu lệnh điều kiện: if, else, elseif
//If: chỉ dùng cho 1 trường hợp duy nhất
$number1 = 5;
if ($number1 % 4 == 0) {
  echo 'Chạy'; //ko chạy vào đây do biểu thức điều kiện trả về FASLE
}
//If...else: dùng cho 2 trường hợp
if ($number1 % 2 == 0) {
  echo 'Number 1 chia hết cho 2';
} else {
  echo 'Number 1 ko chia hết cho 2'; //chạy vào đây
}
//If...elseif...else: >= 3 trường hợp
$number1 = 14;
if ($number1 % 3 == 0) {
  echo 'Number1 chia hết cho 3';
} else if ($number1 % 4 == 0) {
  echo 'Number1 chia hết cho 4';
} else if ($number1 % 5 == 0) {
  echo 'Number1 chia hết cho 5';
} else {
  echo 'Number 1 ko chia hết cho 3,4,5'; //chạy vào đây
}
//Các cú pháp viết tắt của if, elseif, else
$number1 = 5;
//vd: hiển thị 1 cấu trúc bảng gồm 3 hàng, mỗi hàng 2 cột, dựa vào
//điều kiện $number1 > 0
//nếu hiển thị HTML bằng PHP thì chỉ nên hiển thị khi cấu trúc HTML
//đơn giản
if ($number1 > 0) {
  echo "<table>";
  echo "<tr>";
  echo "<td>Hàng 1 cột 1</td>";
  echo "<td>Hàng 1 cột 2</td>";
  echo "</tr>";
  echo "</table>";
}
?>
<!-- Sử dụng cú pháp viết tắt của câu lệnh điều kiện khi hiển thị
các mã HTML phức tạp
-->
<!--cú pháp viết tắt của thẻ if-->
<?php if ($number1 > 0): ?>
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <td>Hàng 1 cột 1</td>
            <td>Hàng 1 cột 2</td>
        </tr>
        <tr>
            <td>Hàng 2 cột 1</td>
            <td>Hàng 2 cột 2</td>
        </tr>
        <tr>
            <td>Hàng 3 cột 1</td>
            <td>Hàng 3 cột 2</td>
        </tr>
    </table>
<?php endif; ?>
<!--cú pháp viết tắt của if,elseif,else-->
<?php if ($number1 == 2): ?>
    <h1>Number1 = 2</h1>
<?php elseif ($number1 == 3): ?>
    <h1>Number1 = 3</h1>
<?php elseif ($number1 == 4): ?>
    <h1>Number1 = 4</h1>
<?php else: ?>
    <h1>Number khác 2, 3, 4</h1>
<?php endif; ?>
<!--Biểu thức switch...case-->
<!--biểu thức này dùng thay thế cho if...else, tuy nhiên chỉ dùng
được khi là so sánh bằng
-->
<?php
$number = 5;
switch ($number) {
  case 1:
    echo 'Number = 1';
    break;
  case 2:
    echo 'Number = 2';
    break;
  case 4:
    echo 'Number = 4';
    break;
  default:
    echo 'Number khác 1, 2, 4';//chạy vào đây
}

//4 - Vòng lặp: for, while, do...while, giống hệt javascript
//For: dùng cho vòng lặp xác định trc đc số lần lặp
for ($i = 1; $i <= 10; $i++) {
  echo $i;
}
//12345678910
//cú pháp viết tắt: for - endfor
//While
$j = 1;
while($j <= 10) {
    echo $j;
    $j++;
}
//do...while: luôn chạy code ít nhất 1 lần cho dù điều kiện sai
//ngay từ đầu
$m = 1;
do {
    echo $m;
} while($m < 0);
//Từ khóa break - continue: can thiệp vào vòng lặp
//Break: thoát hẳn vòng lặp
for ($i = 1; $i <= 10; $i++) {
    if ($i >= 3) {
        break;
    }
    echo $i;
}
//12
//continue: bỏ qua lần lặp hiện tại(ko chạy code phía sau continue),
//nhảy tới vòng lặp kế tiếp
for ($j = 1; $j <= 10; $j++) {
    if ($j != 5) {
        continue;
    }
    echo $j;
}
//1234678910
//5

//Demo 1 số hàm thao tác với String, Number và Time
//Các hàm thao tác với string
//- Kiểu nối chuỗi, sử dụng ký tự .
$string = "String 1 " . " string 2";
//- Lấy độ dài của chuỗi: strlen
echo "<br />";
echo strlen('Helo, Manh'); //10
// - Đếm số từ trong 1 chuỗi: str_word_count
echo "<br />";
echo str_word_count('Helo Manh'); //2
// - Chuyển chuỗi từ thường sang hoa: strtoupper
echo strtoupper('chu thuong'); //CHU HOA
// - Chuyển chuỗi từ hoa về thường: strtolower
echo strtolower('CHu THuong'); //chu thuong
// - Đối ký từ đầu tiên chuỗi thành ký tự hoa: ucfirst
echo ucfirst('abc def ghi'); //Abc def ghi
// - Đối các ký tự đầu tiên của từng từ thành chữ hoa: ucwords
echo ucwords('abc def ghi'); //Abc Def Ghi
// - Cắt bỏ khoảng trắng đầu và cuối chuỗi: trim
echo trim('   abc def    '); //abc def
// - Tìm và thay thế chuỗi: str_replace
$search = 'nvmanh';
$string = 'Hello nvmanh is nvmanh';
echo str_replace($search, 'abc', $string);
//Hello abc is abc
// - Cắt chuỗi: substr
//vị trí bắt đầu của chuỗi = 0, chứ ko phải bằng 1
$string = 'Hello World';
echo substr($string, 1); //ello World
echo substr($string, 1, 3); //ell
// - TÁch chuỗi dựa vào ký tự phân tách: strstr
$string = 'nvmanh@cmc.com.vn';
echo strstr($string, '@'); //@cmc.com.vn
// - Tìm ví trí xuất hiện của chuỗi nào đó trong chuỗi
// ban đầu: strpos
$string = 'nvmanh@cmc.com.vn';
echo strpos('cmc', $string); //7
echo strpos('đasadsadsa', $string); //false
// - hàm đảo ngược chuỗi: strrev
echo strrev('abcdef'); //fedcba
//is_string: kiểm tra kiễu dữ liệu phải string hay ko
// CÁc hàm xử lý Number
//- Kiểm tra 1 số có phải kiểu số nguyên hay ko: is_int
echo is_int(1.23); //false
// - Kiếm tra 1 số có phải kiểu thực hay ko: is_float
 // - LẤy phần thập phân mong muốn: round
$number1 = 1.23232324545454;
echo round($number1, 3); //1.232
// Làm tròn số lên số nguyên gần nhất: ceil
echo ceil(1.37); //2
echo ceil(-1.67); //-1
//làm tròn số xuống số nguyên gần nhất: floor
echo floor(1.37); //1
echo floor(-1.67); //-2
//lấy giá trị nhỏ nhất: min
echo min(1, 5, -1, 6, 8);//-1
//lấy giá trị lớn nhất: max
echo max(5, 2, 3); //5
//hàm lấy căn bậc 2: sqrt
echo sqrt(9); //3
//hàm định dạng lại số theo hàng nghìn, hay dùng để định lại
//lại giá tiền: number_format
$price = 1200000;
echo number_format($price); //1,200,000
echo number_format($price, 0, '.', '.');
//1.200.000



?>

<?php for ($i = 1; $i <= 10; $i++): ?>
    <h1><?php echo $i; ?></h1>
<?php endfor; ?>


