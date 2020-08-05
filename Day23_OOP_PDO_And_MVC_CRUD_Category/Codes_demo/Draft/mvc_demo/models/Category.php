<?php
//mvc_demo/models/Category.php
//File model quản lý category
// + Nhúng file Database.php vào để sử dụng đc các hằng
//số của class này
require_once 'configs/Database.php';
class Category {
    //khai báo các thuộc tính chính là tên trường
    //tương ứng trong bảng
    public $id;
    public $name;
    public $amount;
    //phương thức kết nối CSDL theo PDO
    public function getConnection() {
        $connection = '';
        //+ Với PDO nên dùng khối try catch để khởi tạo, để
        //bắt các ngoại lệ (lỗi) liên quan đến việc kết
        //nối có thể xảy ra mà ko lường trc đc
        try {
            $connection =
        new PDO(Database::DB_DSN,
            Database::DB_USERNAME,
            Database::DB_PASSWORD);
        } catch(Exception $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
        return $connection;
    }
    //phương thức insert dữ liệu
    public function insert() {
        $connection = $this->getConnection();
        // + Tạo câu truy vấn, sử dụng cơ chế truyền tham
        //số, thay vì truyền giá trị thật
        $sql_insert = "INSERT INTO 
        categories(`name`, `amount`) VALUES(:name, :amount)";
        // + Tạo đối tượng truy vấn, prepare
        $obj_insert = $connection->prepare($sql_insert);
        // + Do câu truy vấn có tham số, cần có bược tạo
        //mảng để truyền giá trị thật cho tham số đó
        //các giá trị thật đến từ chính thuộc tính của model
        $arr_insert = [
          ':name' => $this->name,
          ':amount' => $this->amount
        ];
        // + Thực thi truy vấn, execute
        $is_insert = $obj_insert->execute($arr_insert);
        return $is_insert;
    }

}