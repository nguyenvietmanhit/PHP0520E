<?php
//oop_demo.php
//1 - Tổng quan về lập trình hướng đối tượng
// + Viết tắt OOP - Object Oriented Programing
// + Bắt buộc phải biết về OOP nếu muốn theo lập trình
//backend
// + Tập trung vào sự tương tác dựa trên đối tượng, để phân
//tích và đưa ra các thuộc tính và phương thức của đối tượng
//đó
//2 - Các thuật ngữ trong lập trình hướng đối tượng
// + Lớp - Class
// Class hiểu như 1 kiểu dữ liệu đặc biệt, giống như 1
//khuôn mẫu, các đối tượng mà sinh ra từ class sẽ đều chung
//1 đặc điểm gì đó
//từ khóa để khai báo class = class, chũ cái đầu của tên
//class nên viết hoa
class Student {
    public $id; //mã sinh viên
}
// + Đối tượng - object: chính là thể hiện cụ thể của class
//khai báo: sử dụng từ khóa new như sau:
//vd: khởi tạo 1 đối tượng từ class Student, như vậy
//đối tượng vừa tạo có tất cả các tính chất của class
//Student
//Khai báo class phải có bước khởi tạo đối tượng, còn nếu
//ko thì tương đương khai báo hàm nhưng lại ko gọi hàm
$student_A = new Student();
$student_B = new Student();
//+ Thuộc tính của class: khái niệm thuộc tính tương đương
//với biến trong PHP thuần
// vd: khai báo 3 thuộc tính của class Person: name, age,
//birthday
class Person {
    public $name;
    public $age;
    public $birthday;
}
//khởi tạo đối tượng từ class trên
//class có các thuộc tính gì thì đối tượng của nó sẽ có hết
$person_A = new Person();
//đối tượng của class truy cập đc tất cả các thuộc tính
//của class, sử dụng cú pháp: ->
$person_A->name = 'Mạnh';
$person_A->age = 30;
$person_A->birthday = '12-12-2020';
echo "Tên đối tượng Person A: " . $person_A->name;
echo "Tuổi đối tượng Person A: " . $person_A->age;
echo "Ngày sinh đối tượng Person A: " . $person_A->birthday;
//tạo thêm 1 đối tượng từ class trên
$person_B = new Person();
$person_B->name = 'B';
$person_B->age = 12;
$person_B->birthday = '11-11-1111';
// + Phương thức của Class: thuật ngữ phương thức tương
//đương với hàm trong PHP thuần
//Phương thức thể hiện cho việc 1 class có thể có các
//hành động gì
//Đối tượng của class sẽ truy cập phương thức của class,
//sử dụng ký tự ->
class Person1 {
    public $name;
    public $age;
    public function run() {
        echo "Running!";
    }
}
//khởi tạo 1 đối tượng từ class trên
$person1 = new Person1();
//đối tượng truy cập phương thức run của class
$person1->run();
// + Phạm vi truy cập
// Liên quan đến 1 trong 4 tính chất của OOP: tính đóng gói
// Là từ khóa đặt trước tên thuộc tính hoặc phương thức
//của class, gán quyền truy cập tương ứng với các thuộc
//tính và phương thức đó
// Có 3 từ khóa: private, protected, public
//- private: thuộc tính/phương thức mà đc set private thì
//chỉ duy nhất class đó mới truy cập đc, ngoài ra đối tượng
//khởi tạo từ class đó và các class kế thừa từ class đó
//đều ko thể truy cập đc
class TestPrivate {
    private $name;
    public $age;
    private function checkPrivate() {
        echo "Check private";
    }
    public function checkPublic() {
        echo "Check public";
    }
}
$test_private = new TestPrivate();
//cố tình truy cập thuộc tính private sẽ báo lỗi
//$test_private->name = 'ABC';
$test_private->age = 123;
//cố tình truy cập phương thức private sẽ báo lỗi
//$test_private->checkPrivate();
//thực tế khi triển khai ứng dụng web, có thể bỏ qua việc
//khai báo private cho các thuộc tính hoặc phương thức
//cho đỡ rườm rà
class TestPrivate2 {
    private $name;
    private function getName() {
        //truy cập thuộc tính/phương thức private bên trong
        //class 1 cách bình thường
        //sẽ sử dung từ khóa $this để đại diện cho class
        //hiện tại
        $this->name = 'Mạnh';
    }
}
// - protected: nội bộ class và các class kế thừa từ class
//đó đều có thể truy cập đc, đối tượng của class đó vẫn ko
//truy cập đc
class TestProtected {
    protected $name;

    protected function getName() {
        $this->name = 'abc';
    }
}
class Test2 extends TestProtected {
    public function getNameExtends(){
        //class kế thừa sẽ truy cập đc thuộc tính/phương
        //thức ở phạm vi truy cập là protected, public
        echo $this->name;
    }
}
// - public: pham vi thoáng nhất, bất cứ đâu cũng truy cập,
//để đơn giản cho các bạn mới, luôn dùng public trong mọi
//trường hợp khi khai báo phạm vi truy cập cho thuộc tính/
//phương thức

// + PHương thức khởi tạo: dùng để khởi tạo giá trị mặc
//định nào đó cho các thuộc tính của class, phương thức này
//nó chạy đầu tiên khi khởi tạo đối tượng, chạy ngầm
//Luôn có tên là: __construct(), phạm vi truy cập luôn
//là public
class TestConstructor {
    public $name;
    public function __construct() {
        $this->name = 'Tên mặc định';
        echo "Text trong phương thức khởi tạo";
    }
    public function hello() {
        echo "Hello";
    }
}
//tạo đối tượng từ class trên
$test_construct = new TestConstructor();
//ngay khi khởi tạo đối tượng, sẽ chạy phương thức khởi
//tạo r
echo $test_construct->name;//Tên mặc định

// + Từ khóa static
// Bình thường phải khởi tạo đối tượng từ class thì mới
//có thể truy cập đc thuộc tính/phương thức của class đó
// Có thể ko cần khởi tạo đối tượng mà vẫn truy cập đc
//thuộc tính/phương thức của class đó bằng cách set static
//cho nó
class TestStatic {
    public static $name;
    public static function show() {
        echo "Phương thức Show";
    }
}
//truy cập thuộc tính/phương thức tĩnh theo cú pháp sau:
//<tên-class>::<tên-thuộc-tính/phương-thức>
TestStatic::$name = 'Name static';
echo TestStatic::$name;//Name static
TestStatic::show(); //Phương thức Show
// + Từ khóa extends - Thể hiện tính chất kế thừa trong OOP
//đây là tính chất rất quan trọng, đc áp dụng rất nhiều
//khi làm project
// 1 class con kế thừa từ class cha thì sẽ kế thừa tất cả
//các thuộc tính/phương thức của class cha ở phạm vi
// truy cập là protected và public
//PHP hỗ trợ đơn kế thừa, 1 class chỉ kế thừa đc duy nhất
//1 class khác tại 1 thời điểm
//Xác định tính chất kế thừa, trả lời câu hỏi is-a
//khai báo 1 class đóng vai trò class cha
class ConNguoi {
    public $name;
    public $age;
}
class SinhVien extends ConNguoi {
    //class Sinh Viên đã có luôn 2 thuộc tính name và age
    //của class cha
    public $id;
    public function study() {}
}
// + Abstract - Tính trừu tượng trong OOP, là tính chất
//rất khó hiểu với các bạn mới
abstract class TestAbstract {
    public $name;
    public function show() {
        echo "Show";
    }
    //class trừu tượng sẽ có các phương thức khai báo
    //ở dạng trừu tượng, ko có nội dung gì cả
    abstract public function run();
}
//mục đích của class trừu tượng -> kế thừa
class A extends TestAbstract {
    //class kế thừa từ class trừu tượng bắt buộc phải
    //định nghĩa lại phương thức trừu tượng
    public function run() {
        // TODO: Implement run() method.
    }
}
// + Từ khóa implements: triển khai 1 interface
interface Config {
    //trong inteface ko thể khai báo thuộc tính, chỉ khai
    //báo đc phương thức ko có nội dung gì cả
    //phương thức bắt buộc phải là public
    public function sendMail();
    public function getMail();
}
//1 class thực thi 1 interface bắt buộc phải định nghĩa
//lại hết các phương thức của interface
class C implements Config {
    public function sendMail() {
        // TODO: Implement sendMail() method.
    }
    public function getMail() {
        // TODO: Implement getMail() method.
    }
}
//Abstract và Interface dùng thiên về mặt thiết kế hệ thống
//hơn, nên với các bạn mới chưa cần hiểu quá sâu về 2 từ
//khóa này

// CẦN CHUẨN BỊ Ý TƯỞNG CHO PROJECT CUỐI KHÓA
// - Cần xác định chủ đề sẽ làm: tin tức, bán hàng, thi
//online, đọc truyện
// - XÁc định nhóm sẽ làm: độc lập, làm theo team
// - Chuẩn bị giao diện frontend, backend. Nên tìm
// template free với từ khóa:
// ecommerce template theme free..
// - Code backend
// - Cần làm tài liệu báo cáo, giảng viên sẽ gửi tài
//liệu mẫu

//3 - Bốn tính chất của OOP:
// + Tính trừu tượng: thể hiện của từ khóa abstract
// + Tính đóng gói: thể hiển của phạm vi truy cập: private
//protected, public
// + Tính kế thừa: thể hiện của từ khóa extends
// + Tính đa hình: liên quan đến interface, cùng 1 phương
//thức của interface, các class implement phương thức đó
//sẽ có các hình thức triển khai khác nhau
