<?php
//demo_oop.php
//Lập trình hướng đối tượng - OOP - Object Oriented Programming
// + Khá khó học
// + Project lại dùng OOP để code
//1 - Các phương pháp lập trình truyền thống
// + Lập trình tuyến tính: nghĩ gì code nấy, luôn gặp ở các bạn mới
//code. VD: viết code tính tổng 2 số
$number1 = 5;
$number2 = 6;
$sum = $number1 + $number2;
echo $sum;
// Nhược điểm: code rất khó phát triển và bảo trì, code ko có tính
//dùng lại, ko teamwork đc
// + Lập trình có cấu trúc: biết cấu trúc code: viết hàm, chia chức
//năng, viết tách các file ...
function sum($number1, $number2) {
  return $number1 + $number2;
}
echo sum(1, 3); //3
// Ưu điểm: teamwork, code đc tổ chức theo cấu trúc ...
//Nhược điểm: code tập trung vào chức năng, nên mô tả thực tế
//ko trực quan
// + Lập trình hướng đối tượng: lấy đối tượng làm trung tâm, đây
//chính là phương pháp code hiện nay


//2 - Tổng quan về OOP
// + LẤy đối tượng làm trung tâm để phân tích, và đưa ra các
//đặc điểm và hành vi của đối tượng đó, về thuật ngữ của OOP là
//thuộc tính và phương thức, về mặt PHP cơ bản thì thuộc tính = biến
//, phương thức = hàm

// 3 - Các thuật ngữ chính trong OOP
// + Class - Lớp: như 1 khuôn mẫu/bản thiết kế. VD: khai báo 1 class
//giống như tạo ra 1 bản thiết kế ngôi nhà trên giấy
//Cú pháp khai báo:
// class <tên-class-viết-hoa-chữ-cái-đầu-của-từng-từ>
//Class khai báo các thuộc tính/đặc điểm và phương thức/hành vi
//để các đối tượng sinh ra từ class này đều có chung các thuộc tính/
//phương thức đó
class Person {
  //khai báo 1 thuộc tính và 1 phương thức
  public $name;

  public function run() {
    echo "Running";
  }
}

// + Object - Đối tượng: là thể hiện cụ thể của 1 class.
//VD: nếu 1 class là 1 bản thiết kế xe, thì 1 object là xe Honda,
//1 object khác là xe Yamaha
//Các đối tượng dc tạo ra từ cùng 1 class thì sẽ có tính chất
//giống hệt nhau
//Khởi tạo đối tượng từ 1 class, sử dụng từ khóa new như sau:
$obj1 = new Person();
//set giá trị cụ thể cho các thuộc tính của đối tượng $obj1
//1 đối tượng của 1 class có thể truy cập đc các thuộc tính/phương
//thức của class đó, sử dụng ký tự ->,
$obj1->name = 'Mạnh';
echo "Tên của bạn: " . $obj1->name;

$obj2 = new Person();
$obj3 = new Person();
// + Thuộc tính của class: Là các thuộc tính khai báo bên trong class
//hoạt động như 1 biến PHP thông thường, đối tượng sử dụng ký tự
//-> để truy cập thuộc tính của class
class NhanVien {
  //khai báo 4 thuộc tính của class
  public $name;
  public $age;
  public $id;
  public $birthday;
}
$nhanvien1 = new NhanVien();
//truy cập thuộc tính của class Nhanvien và gán giá trị cho đối tương
//$nhanvien1
$nhanvien1->name = 'Mạnh';
$nhanvien1->age = 30;
$nhanvien1->id = 123;
$nhanvien1->birthday = '12-12-2000';
//debug thông tin nhanvien1
echo "<pre>";
print_r($nhanvien1);
echo "</pre>";
echo $nhanvien1->id; //123

// + Phương thức của class: chính là các hàm đc khai báo bên trong
//class -> phương thức, 1 đối tượng truy cập phương thức của class
//cũng dùng ký tự ->, phương thức có thể có tham số hoặc ko, có thể
//return về 1 giá trị nào đó hoặc ko
class Student {
  public $name;
  public $age;

  public function study() {
    echo "Study";
  }
  public function play() {
    echo "Play";
  }
}
$student1 = new Student();
$student1->study(); //Study
// + Từ khóa this: dùng bên trong class, chính là class hiện tại,
//được dùng khi chính class hiện tại truy cập thuộc tính/phương thức
//của chính nó
class TestThis {
  public $name;
  public $age;
  public function setName() {
    //truy cập thuộc tính name và set giá trị cho thuộc tính này
    $this->name = 'Mạnh';
  }
  public function getName() {
    echo $this->name;
  }
}
$obj = new TestThis();
$obj->setName();
$obj->getName(); //Mạnh
// + Phạm vi truy cập: thể hiện cho việc gán quyền truy cập cho
//thuộc tính/phương thức của 1 lớp, có 3 từ khóa: private, protected,
//public
// Private: có phạm vi truy cập hẹp nhất, chỉ nội bộ class mới
//truy cập đc private, ngoài ra các đối tượng khởi tạo class đó hoặc
//kế thừa từ class đó cũng ko thể truy cập đc
class TestPrivate {
  public $name;
  private $age;
  public function show() {
    //truy cập private bên trong class sẽ ko vấn đề gì
    $this->age = 23;
    $this->hide();
    echo "show";
  }
  private function hide() {
    echo "Hide";
  }
}
$obj = new TestPrivate();
//cố tính truy cập thuộc tính/phương thức private từ bên ngoài class
//sẽ báo lỗi
//$obj->age = 5;
//echo $obj->age; //5
$obj->name = 'abc';
// Protected: liên quan đến tính kế thừa trong OOP, thuộc tính/
//phương thức có phạm vi truy cập là protected thì chỉ có thể truy
//cập đc từ nội bộ class và các class kế thừa từ class đó,
class TestParent {
  public $name;
  protected $age;
  public function show() {
    $this->age = 5;
  }
}
//khai báo 1 class kế thừa từ class TestParent: extends
class TestChildren extends TestParent {
  public $id;
  public function check() {
    //truy cập thuộc tính protected của class cha như bình thường
    //class con kế thừa tất cả các thuộc tính và phương thức của
    //class cha có phạm vi truy cập = protected/public
    $this->age = 123;
  }
}
//dùng 1 object từ bên ngoài xem có truy cập đc protected hay ko
$chilren = new TestChildren();
//cố tình truy cập protected sẽ báo lỗi
//$chilren->age = 5;
//public: thoáng nhất, có thể truy cập dc từ bất cứ đâu, để cho
//đơn giản thì khóa học sẽ luôn dùng public làm phạm vi truy cập
// + Phương thức khởi tạo: là phương thức của 1 class, sẽ dc chạy
//ngầm đầu tiên khi khởi tạo đối tượng từ class đó, mục đích: khởi
//tạo giá trị mặc định cho thuộc tính của class
//Với PHP phương thức khởi tạo luôn có tên = __construct
class TestConstruct {
  public $name;
  public function __construct() {
    echo "Phương thức khởi tạo chạy đầu tiên khi khởi tạo đối tượng";
    $this->name = 'Name mặc định';
  }
}
$obj = new TestConstruct();
echo $obj->name; //Name mặc định

// + Từ khóa static: bình thường muốn truy cập thuộc tính/phương
//thức từ 1 đối tượng, bắt buộc phải khởi tạo đối tượng đó.
//Tuy nhiên vẫn có thể truy cập mà ko cần khởi tạo đối tượng, bằng
//cách set thuộc tính/phương thức đó ở dạng static
//Để truy cập thuộc tính/phương thức tĩnh, sử dụng ký tự ::
class TestStatic {
  public $name;
  public static $age;
  public function showName() {
    echo $this->name;
  }
  public static function showAge() {
    //bên trong class, có thể dùng tên class hoặc từ khóa self để
    //truy cập thuộc tính/phương thức static
    //chỉ có thể truy cập đc thuộc tính tĩnh bên trong phương thức
    //cũng là tĩnh
    echo TestStatic::$age;
//    echo self::$age;
  }
}
//ko cần khởi tạo đối tượng khi truy cập thuộc tính/phương thức tĩnh
//từ bên ngoài
TestStatic::$age = 5;
echo TestStatic::$age; //5
// + Từ khóa extends: thể hiện cho tính kế thừa trong OOP
//PHP chỉ hỗ trợ đơn kế thừa, 1 class chỉ kế thừa đc duy nhất 1 class
//khác tại 1 thời điểm
//Class con kế thừa tất cả các thuộc tính/phương thức của class cha
//mà có phạm vi truy cập = protected/public
class TestParent1 {
  public $name;
  protected $age;
  private $id;
  public function getName() {
    echo "Name";
  }
  protected function getAge() {
    echo "Age";
  }
  private function getId() {
    echo "Id";
  }
}
class TestChildren1 extends TestParent1 {
  //class con kế thừa đc các thuộc tính name, age
  //phương thức: getName, getAge
}
$obj = new TestChildren1();
$obj->name = 'abc';
// - Từ khóa abstract, interface: liên quan đến cấu trúc thiết kế
//hệ thống, phải là ng hiểu hết về hệ thống thì mới có thể đưa ra
//chính xác các class abstract và các interface
//abstract: class trừu tượng
abstract class TestAbstract1 {
  public $name;
  protected $age;
  public function show() {
    echo "Show";
  }
  //class abstract đặc trưng bởi các phương thức ko hề có nội dung
  abstract public function hide();
}
//class abstract chỉ đc dùng khi kế thừa
class Abs extends TestAbstract1 {
  //bắt buộc phải khai báo tường minh cho phương thức abstract
  //của class cha
  public function hide() {
    // TODO: Implement hide() method.
  }
}
// + Từ khóa implements: sử dụng cho khai báo interface
//1 class có thể implements nhiều interface
interface Config {
  //ko thể khai báo thuộc tính bên trong interface
  //bắt buộc phải khai báo phương thức ko có nội dung
  public function sendMail();
  public function getMail();
}
class TestConfig implements Config {
  public function sendMail() {
    echo "a";
  }
  public function getMail() {
    echo "b";
  }
}