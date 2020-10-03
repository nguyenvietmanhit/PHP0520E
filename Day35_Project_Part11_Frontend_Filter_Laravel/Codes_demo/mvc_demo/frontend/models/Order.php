<?php
//models/Order.php
require_once 'models/Model.php';
class Order extends Model {
  //Khai báo các thuộc tính cho model chính là các trường tương
  //ứng trong bảng orders
  public $id;
  public $fullname;
  public $address;
  public $mobile;
  public $email;
  public $note;
  public $price_total;
  public $payment_status;

  public function insert() {
    // Lưu ý: phương thức này sẽ trả về id của chính order vừa
    //insert, thay vì trả về true/false như thông thường
    // Vì liên quan đến việc lưu vào bảng order_details nữa
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO 
orders(fullname, address, mobile, email,
 note, price_total, payment_status) 
 VALUES(:fullname, :address, :mobile, :email, 
 :note, :price_total, :payment_status)";
    // + Tạo đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng để truyền giá trị thật cho tham số câu truy vấn
    $arr_insert = [
        ':fullname' => $this->fullname,
        ':address' => $this->address,
        ':mobile' => $this->mobile,
        ':email' => $this->email,
        ':note' => $this->note,
        ':price_total' => $this->price_total,
        ':payment_status' => $this->payment_status,
    ];
    // + Thưc thi đối tượng truy vấn trên, ko cần tạo biến để
    //gán kết quả trả về như thông thường
    $obj_insert->execute($arr_insert);
    // + Lấy id vừa insert, luôn gọi sau execute:
    $order_id = $this->connection->lastInsertId();
    return $order_id;
  }
}