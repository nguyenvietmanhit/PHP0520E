<?php
//áp dụng tính kế thừa trong OOP: có 1 thuộc tính connection
//được khai báo ở model cha, và các model con khi kế thừa
//từ model cha này thì chỉ việc sử dụng mà ko khai báo lại
require_once 'models/Model.php';
class Category extends Model {
  //khai báo thuộc tính cho model, thường sẽ là các trường
  //trong bảng tương ứng
  public $id;
  public $name;
  public $avatar;
  public $description;
//...
//Phương thức thêm dữ liệu vào bảng categories
  public function insert() {
    // + Tạo câu truy vấn ở dạng tham số để tránh lỗi bảo mật
    //SQLInjection khi giá trị là text
    $sql_insert = "INSERT INTO 
    categories(`name`, avatar, description)
    VALUES(:name, :avatar, :description)";
    // + Tạo đối tượng truy vấn:
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng để gán giá trị thật
    $arr_insert = [
        ':name' => $this->name,
        ':avatar' => $this->avatar,
        ':description' => $this->description
    ];
    // + Thực thi đối tượng truy vấn
    $is_insert = $obj_insert->execute($arr_insert);
    return $is_insert;
  }

}