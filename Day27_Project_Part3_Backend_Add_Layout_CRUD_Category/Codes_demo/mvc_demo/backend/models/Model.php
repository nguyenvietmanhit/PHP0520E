<?php
//models/Model.php: class model cha
//khai báo 1 thuộc tính để kết nối tới CSDL
require_once 'configs/Database.php';
class Model {
  public $connection;

  //áp dụng phương thức của 1 class để khởi tạo giá trị
  //mặc định cho thuộc tính connection
  public function __construct() {
  $this->connection = $this->getConnection();
}

  //Phương thức dùng để kết nối CSDL
  public function getConnection() {
    try {
      $connection = new PDO(Database::DB_DSN,
          Database::DB_USERNAME,
          Database::DB_PASSWORD);
      return $connection;
    } catch (Exception $e) {
      die("Lỗi kết nối: " . $e->getMessage());
    }
  }
}