<?php
//nhúng file Database.php để sử dụng đc các hằng số của class đó
require_once 'configs/Database.php';
//mvc_demo/models/Category.php
//File model quản lý category
class Category {
  //khai báo các thuộc tính cho model, đến từ các trường
  //trong bảng categories
  public $id;
  public $name;
  public $amount;

  //Phương thức lấy đối tượng kết nối tới CSDL
  public function getConnection() {
    //với cơ chế PDO thì cần viết code kết nối trong khối lệnh
//    try...catch
    try {
      $connection = new PDO(Database::DB_DSN,
          Database::DB_USERNAME, Database::DB_PASSWORD);
    } catch (Exception $e) {
      die("Lỗi kết nối: " . $e->getMessage());
    }
    return $connection;
  }
  //Phương thức insert dữ liệu
  public function insert() {
    // + Lấy đối tượng kết nối CSDL
    $connection = $this->getConnection();
    // + Tạo câu truy vấn thêm dữ liệu, áp dụng cơ chế truyền giá
    //trị theo kiểu tham số để chống lỗi bảo mật SQL Injection và
    //giúp truyền giá trị trở nên dễ dàng hơn
    $sql_insert = "INSERT INTO categories(`name`, `amount`)
    VALUES(:name, :amount)";
    // + Tạo đối tượng truy vấn, prepare
    $obj_insert = $connection->prepare($sql_insert);
    // + Tạo mảng để truyền giá trị thật cho các tham số
    //trong câu truy vấn
    //Các giá trị thật sẽ đến từ chính thuộc tính model
    $arr_insert = [
        ':name' => $this->name,
        ':amount' => $this->amount
    ];
    // + Thực thi truy vấn, execute
    $is_insert = $obj_insert->execute($arr_insert);
    return $is_insert;
  }
}