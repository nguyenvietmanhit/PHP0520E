<!--demo_php.php-->
<?php
//khai báo vùng làm việc với PHP
//1 - BIẾN
//khai báo biến có tên = var, giá trị = 1
$var = 1;
$name = 'Mạnh';
$age = 30;
//quy tắc đặt tên biến, giống hệt JAvsacript
//tên biến phải gợi nhớ, tên biến phải bắt đầu bởi text hoặc _
//ko đc chứa các ký tự đặc biệt
//tên biến trong PHP phân biệt hoa thường
//$name, $namE là 2 biến hoàn toàn khác nhau
//2 - Các kiểu dữ liệu của biến trong PHP
//js: number, string, object, boolean, undefined, null, array
// - Integer: số nguyên, phạm vi của số nguyên -2 tỉ -> 2 tỉ
$number1 = 1;
$number2 = -5;
//hàm is_int kiểm tra 1 biến có phải kiểu dữ liệu int hay ko
$check = is_int($number1);
//sử dụng hàm var_dump để xem thông tin của biến
var_dump($check); //true
//- Float/double: kiểu số thực, chứa phần thập phân, chỉ cần
//quan tâm đến float, có thể bỏ qua double
$number1 = 1.23;
$number2 = -1.23;
$check = is_float($number1);
var_dump($check); //true
// - String, kiểu chuỗi, giá trị đc bao bởi ký tự nháy đơn hoặc
//nháy kép
$string1 = 'nvmanh';
$string2 = "nvmanh";
//lưu ý trong PHP có thể hiển thị ra giá trị của biến
//ngay bên trong chuỗi nếu chuỗi đó đc bao bởi dấu nháy kép
$age = 30;
echo "Tuổi của tôi là: " . $age; //Tuổi của tôi là: 30
echo "Tuổi của tôi là: $age"; //Tuổi của tôi là: 30
echo 'Tuổi của tôi là: $age'; //Tuôi của tôi là: $age
$check = is_string($string1);
//hàm var_dump là hàm xem thông tin biến, thường dùng để debug
var_dump($check); //true
//- Kiểu boolean, kiểu true/false, khác với kiểu boolean của JS,
//PHP cho phép viết hoa thường thoải
// mái mới 2 giá trị true/false
$boolean1 = true;
$boolean2 = false;
$boolean3  = False;//vẫn nhận bình thường
$check = is_bool($boolean1);
var_dump($check); //true
//- Kiểu NULL, chỉ có 1 giá trị duy nhất = null, viết hoa thường
//thoải mái, kiểu này sinh ra khi thao tác với 1 biến chưa hề
//tồn tại
$null1 = null;
$null2 = Null;//vẫn nhận binh thường
$check = is_null($null1);
var_dump($check); //true
// - Kiểu Array, kiểu mảng, là biến chứa nhiều giá trị tại 1 thời
//điểm. SẼ có nguyên 1 buổi học để học về kiểu này, PHP sẽ thao
//tác với kiểu mảng rất nhiều
//có 2 cách khai bảo mảng, [], array()
//cách này dùng từ phiên bản PHP 5.4 trở xuống -> cách cũ
$arr1 = array(1, 'str', true, null, array(1, 2, 3));
//nên khai báo theo cách sau
$arr2 = [1, 'str', true, null, [1, 2, 3]];
$check = is_array($arr1);
var_dump($check); //true
//hiển thị cấu trúc mảng
//ko thể sử dụng hàm echo để hiển thị 1 mảng như 1 kiểu dũ liệu
//nguyên thủy (int, float, boolean) được
//mà cần sử dụng các hàm khác để xem cấu trúc của mảng
//var_dump, print_r: 2 hàm thường dùng để xem cấu trúc mảng
//echo $arr1;
var_dump($arr1);//dùng hàm var_dump xem mảng sẽ hơi khó nhìn
//thường sử dụng cấu trúc sau để xem thông tin mảng
echo '<pre>';
print_r($arr1);
echo '</pre>';
//- Kiểu object, kiểu hướng đối tượng, sẽ học ở phần lập trình
//hướng đối tượng

//3 - Ép kiểu dữ liệu: cho phép thay đổi kiểu dữ liệu của biến,
//để ép kiểu sử dụng các từ khóa ép kiểu, chính là tên kiểu
//dữ liệu tương ứng
// (int, integer, bool, boolean, string, array, object)
$number = 11.2; //float
$int_number = (int) $number; //11 - ép sang kiểu integer
$string_number = (string) $number; //'11.2' - ép sang string

//4 - Hằng
const PI = 3.14;
const MAX_AGE = 100;
//ngoài ra PHP có thể khai báo hằng sử dùng 1 hàm là define
define('MIN', 10);//khai báo hằng MIN có giá trị = 10
define('MAX', 100);
//nên dùng từ khóa const để khai báo hằng trong PHP, vì khi
//học về class của lập trình hướng đối tượng, thì chỉ có thể
//dùng từ khóa const để khai báo hằng trong 1 class
//ko thể gán lại giá trị khác cho hằng
//PI = 1; //cố tính gán lại sẽ báo lỗi
//5 - 1 số hằng định nghĩa sẵn trong PHP
//show số dòng hiện tại đang gọi đến hằng này: __LINE__
echo "<br>";
echo __LINE__; // 103
//show ra đường dẫn vật lý/tuyệt đối tới file mà đang gọi hằng
//này: __FILE__
echo "<br />";
echo __FILE__;//c:/xampp/htdocs/..../demo_php.php
//show ra đường dẫn vật lý/tuyệt đối tới thư mục cha gần nhất
//đang chứa file hiện tại mà gọi hằng này: __DIR__
//hằng này hay được sử dụng khi upload file
echo "<br />";
echo __DIR__; //C:/xampp/.../Code_demo_tren_lop

//6 - Hàm trong PHP
//bản chất giống hệt hàm trong JS
//- Hàm có sẵn trong PHP: is_int, var_dump, print_r, echo ...
//- Hàm tự định nghĩa, cú pháp như sau: giống hệt JS
//khai báo 1 hàm ko có tham số, ko có giá trị trả về
function display() {
    echo 'Code bên trong hàm display';
}
//gọi hàm
display(); //Code bên trong hàm display
//Các biến thể của hàm:
//- Hàm có tham số
function sum($number1, $number2) {
    echo $number1 + $number2;
}
sum(1, 2); //3
sum(2, 3); //5
// - Hàm có tham số được khởi tạo giá trị mặc định
function showName($name = 'Mạnh') {
    echo $name;
}
showName();//Mạnh
showName('ABC'); //ABC
// - Hàm có giá trị trả về, sử dụng từ khóa return
//luôn cố gắng xác định kiểu dữ liệu trả về của hàm để
//sử dụng từ khóa return bên trong hàm
function add($number1, $number2) {
    $sum = $number1 + $number2;
//    echo $sum;
  //từ khóa return sẽ kết thúc hàm - ko chạy code phía sau return
//  nữa, đồng thời làm cho hàm có 1 giá trị nào đó
    return $sum;
}
$sum = add(1, 2);
echo $sum; //3
//7 - Truyền biến kiểu tham trị và tham chiếu
//demo thay đổi giá trị của biến bằng truyền tham trị và
//tham chiếu khi sử dụng hàm
$number = 5;
echo "Biến number ban đầu có giá trị = $number"; //5
//hàm thay đổi giá trị cho biến truyền vào
function changeNumber($num) {
    $num = 0;
    echo "Biến num bên trong hàm đang có giá trị: $num"; //0
}
changeNumber($number);
echo "Biến number sau khi gọi hàm đang có giá trị: $number";//5
//bản chất của việc truyền tham trị là đang thao tác với bản sao
//của biến ban đầu
$number1 = 5;
echo "Biến number1 ban đầu = $number1"; //5
//truyền tham chiếu sẽ dùng ký tự & trước tên biến
function changeNumber1(&$num) {
    $num = 0;
    echo "Biến num bên trong hàm đang có giá trị: $num"; //0
}
changeNumber1($number1);
echo "Biến number1 sau khi gọi hàm có giá trị: $number1"; //0
//kiểu tham chiếu: thao tác với chính bản gốc của biến, kiểu này
//sẽ hay gặp khi code với CMS (Wordpress, Zoomla, Drupal ...)
//8 - Giới thiệu 1 số hàm có sẵn nhúng file trong PHP
//mục đích: khi làm project sẽ phải tách thành rất nhiều file,
//nên cần phải sử dụng hàm để nhúng các file này
//PHP cung cấp 4 hàm nhúng file: include, require, include_once
//require_once
//Tạo 1 file ngang hàng với file hiện tại: test.php
//bản chất của nhúng file là lấy nội dung file nhúng paste
//vào hiện tại
//include 'testdsadasdsadsa.php';
require 'testdsadadsadsa.php';
//include và require chỉ khác nhau về cách xử lý lỗi khi nhúng
//1 file ko tồn tại
//với include thì chỉ báo lỗi warning và vẫn chạy đc code phía
//sau
//với require thì sẽ ko chạy code phía sau
//require 'test.php';
//require 'test.php';
//require 'test.php';
//require 'test.php';
//require 'test.php';
require_once 'test.php';
require_once 'test.php';
require_once 'test.php';
require_once 'test.php';
require_once 'test.php';
require_once 'test.php';
//nên dùng hàm require_once để nhúng file để đảm bảo file chỉ đc
//nhúng duy nhất 1 lần, và sẽ ko chạy code phía sau nếu như
//đường dẫn file ko tồn tại
echo "<br />Test đoạn code sau có được chạy hay ko?";
?>