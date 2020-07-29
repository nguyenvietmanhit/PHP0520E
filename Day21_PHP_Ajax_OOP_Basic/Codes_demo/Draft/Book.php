<?php
//Book.php
//Demo sử dụng OOP để code chức năng CRUD
//Phân tích đối tượng book để lấy ra các phương thức và
//thuộc tính có thể có
//+ Thuộc tính: id, name, amount, created_at ...
// + Phương thức: connectDb, disconectDb, insert, update,
//delete, index
// - Tạo CSDL tên oop, tạo 1 bảng books: id, name, amount
//created_at
#Tạo CSDL
//CREATE DATABASE oop;
//CREATE TABLE books(
//    id INT(11) AUTO_INCREMENT,
//name VARCHAR(255),
//amount INT(11),
//created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//PRIMARY KEY (id)
//);
class Book {
    //khai báo các hằng số liên quan đến kết nối CSDL
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'oop';
    const DB_PORT = 3306;
    //khai báo các thuộc tính của class book
    //các thuộc tính chính là các trường của bảng books
    //về mặt cơ bản, có bao nhiêu trường trong bảng thì sẽ
    //có ít nhất từng đó thuộc tính
    public $id;
    public $name;
    public $amount;
    public $created_at;

    //liệt kê các phương thức có thể có của class Book
    //phương thức kết nối CSDL
    public function connectDb() {
        $connection = NULL;
        //truy cập hằng trong class giống như truy cập
        //thuộc tính static
        $connection = mysqli_connect(Book::DB_HOST,
            Book::DB_USERNAME, Book::DB_PASSWORD,
            Book::DB_NAME, Book::DB_PORT);

        return $connection;
    }

    //phương thức đóng kết nối
    public function disconectDb($connection) {
        mysqli_close($connection);
    }

    //thêm sách
    public function insert() {
        //lấy ra biến kết nối để có thể insert đc vào db
        $connection = $this->connectDb();
        // + Tạo câu truy vấn thêm dữ liệu
        $sql_insert = "
INSERT INTO books(`name`, `amount`) 
VALUES ('$this->name', $this->amount)";
        // + Thực thi truy vấn
        $is_insert = mysqli_query($connection, $sql_insert);
        // + Đóng kết nối
        $this->disconectDb($connection);
        return $is_insert;
    }

    //sửa sách
    public function update() {}

    //xóa sách
    public function delete() {}

    //liệt kê sách
    public function index() {}
}

//khởi tạo đối tượng từ class trên
$book = new Book();
//cần gán các giá trị tương ứng cho đối tượng
$book->name = 'Sách 1';
$book->amount = 5;
//gọi phương thức insert để insert vào CSDL
$is_insert = $book->insert();
var_dump($is_insert);