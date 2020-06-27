<?php
//demo_function_array_time.php
//Demo 1 số hàm có sẵn của PHP hay dùng để thao tác với mảng và
//thời gian
//1 - Thao tác với mảng
//- Trả về tổng của các phần tử trong mảng: array_sum($arr)
$arr = [1, 2, 3];
echo array_sum($arr); //6
// - Kiểm tra key có tồn tại trong mảng hay ko:
// array_key_exists($key, $arr)
$arr = [
    'name' => 'Manh',
    'age' => 30
];
$check = array_key_exists('name', $arr);
var_dump($check); //true
//- Hàm gộp mảng, trả về 1 mảng mới: array_merge($arr1, $arr2, ...);
//gộp các mảng $arr2, $arr3 , .... vào sau mảng $arr1
$arr1 = [1, 2, 3];
$arr2 = ['a', 'b', 'c'];
$arr3 = [
    'name' => 'Manh',
    'age' => 30
];
$arr = array_merge($arr1, $arr2, $arr3);
echo "<pre>";
print_r($arr);
echo "</pre>";
//- Tìm kiếm theo giá trị của phần tử trong mảng, nếu tìm thấy
//trả về key của phần tử đó, ngược lại trả về FALSE:
//array_search($keyword, $arr)
$arr = ['a', 'b', 'c'];
var_dump(array_search('c', $arr)); //2

// - Loại bỏ các giá trị trùng lặp trong 1 mảng, trả về 1 mảng mới:
//array_unique($arr)
$arr = [1, 2, 3, 3 , 2, 2, 2];
$arr_unique = array_unique($arr);
print_r($arr_unique); // [1, 2, 3]
//- Trả về 1 mảng mới dựa vào các giá trị của từng phần tử của
// mảng ban đầu: array_values($arr)
$arr = [
    'name' => 'Manh',
    'age' => 30
];
$arr_new = array_values($arr);
//reset hết tất cả các key của mảng ban đầu thành 0,1,2....
print_r($arr_new);
//[
//    0 => 'Manh',
//    1 => 30
//]
// - Trả về mảng mới dựa vào key của mảng ban đầu
//array_keys($arr)
$arr = [
    'name' => 'Manh',
    'age' => 30
];
$arr_new = array_keys($arr);
print_r($arr_new); //['name', 'age']
//- đếm phần tử của 1 mảng: count($arr)
$arr = [1, 2, 3];
echo count($arr); //3
// - Chuyển chuỗi thành mảng dựa vào ký tự phân tách
//explode($character, $string)
$string = "Helo nvmanh is abc";
$arr = explode(' ', $string);
print_r($arr);
//Chuyển mảng thành chuỗi: implode($charater, $arr);
$arr = [1, 2, 3, 4];
echo implode('-', $arr);//1-2-3-4
// - LẤy ra giá trị của phần tử cuối cùng trong mảng
//end($arr)
$arr = ['a', 'b', 'c']; //$arr[2]
echo end($arr); //c
//lấy ra giá trị của phần tử đầu tiên trong mảng: reset($arr)
echo reset($arr); //a
//hàm kiểm tra kiểu dữ liệu có phải là mảng hay ko
//in_array($arr)
var_dump(is_array($arr)); //true
// - Lấy giá trị lớn nhất trong mảng: max($arr)
$arr = [4, 2, 5];
echo max($arr); //5
// - Lấy giá trị lớn nhất trong mảng: min($arr)
$arr = [4, 2, 5];
echo min($arr); //2
// - Xóa phần tử bất kỳ của 1 mảng: unset($arr[key])
$arr = [
  'name' => 'Manh',
  'age' => 30,
  'gender' => 'male'
];
unset($arr['age']);
print_r($arr);
//- Hàm sắp xếp: sort, ksort, -> tìm hiểu thêm

//2 - Các hàm xử lý với thời gian
//- Lấy ra múi giờ hiện tại trên server
//date_default_timezone_get
//mặc định múi giờ hệ thống khi cài đặt XAMPP sẽ là Europe/Berlin
echo date_default_timezone_get();
//set lại múi giờ Việt Nam: date_default_timezone_set($timezone)
date_default_timezone_set('Asia/Ho_Chi_Minh');

//Lấy ra thời gian hiện tại tính bằng giây, so với thời điểm
//01/01/1970: time(), đơn vị: Unix Timestamp
echo "<br />";
echo time();
//hàm định dạng lại thời gian hiển thị theo cách dễ nhìn hơn
//date($format, $timestamp)
echo "<br />";
echo date('d-m-Y H:i:s', time());

//- Chuyển đổi thời gian đã format về số giây (Unix Timestamp)
//:strtotime($format)
$format = '27-06-2020 20:34:34';
echo " <br />";
echo strtotime($format); //