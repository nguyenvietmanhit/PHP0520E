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

  //Phương thức lấy tất cả danh mục
  public function getAll() {
    // + Tạo câu truy vấn
    $sql_select_all = "SELECT * FROM categories ORDER BY id DESC";
    // + Chuẩn bị đối tượng truy vấn, prepare
    $connection = $this->getConnection();
    $obj_select_all = $connection->prepare($sql_select_all);
    // + Bỏ qua bước tạo mảng để gán giá trị thật, vì câu truy vấn
    //ko ở dạng tham số
    // + Thực thi đối tượng truy vấn, execute, với truy vấn SELECT
    //thì ko cần thao tác với giá trị trả về của phương thức execute
    $obj_select_all->execute();
    // + Lấy mảng dữ liệu mong muốn, fetchAll
    $categories =
        $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
  }

  //Phương thức lấy 1 bản ghi theo id truyền vào
  public function getOne($id) {
    // + Tạo câu truy vấn, nếu giá trị chắc chắn là số thì ko cần
    //sử dụng dạng tham số câu truy vấn, mà thường giá trị là text
    //thì mới bắt buộc phải đặt dạng tham số
    $sql_select_one = "SELECT * FROM categories WHERE id = $id";
    // + Chuẩn bị đối tượng truy vấn, prepare
    $connection = $this->getConnection();
    $obj_select_one = $connection->prepare($sql_select_one);
    // + Bỏ qua bước tạo mảng do câu truy vấn ko có tham số nào
    // + Thực thi đối tượng truy vấn, execute
    $obj_select_one->execute();
    // + Lấy mảng dữ liệu mong muốn, fetch
    $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
    return $category;
  }

  //Phương thức update dữ liệu dựa theo id
  public function update($id) {
    // + Tạo câu truy vấn
    $sql_update = "UPDATE categories 
  SET `name` = :name, `amount` = :amount WHERE id = $id";
    // + Chuẩn bị obj truy vấn
    $connection = $this->getConnection();
    $obj_update = $connection->prepare($sql_update);
    // + Tạo mảng để truyền dữ liệu thật do câu truy vấn đang có
    //tham số
    $arr_update = [
        ':name' => $this->name,
        ':amount' => $this->amount,
    ];
    // + thực thi đối tượng truy vấn,
    $is_update = $obj_update->execute($arr_update);
    return $is_update;
  }
}