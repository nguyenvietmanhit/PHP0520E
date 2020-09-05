<?php
require_once 'models/Model.php';
class User extends Model {
  //khai báo các thuộc tính cho model chính là các trường
  //trong bảng users tương ứng
  public $id;
  public $username;
  public $password;

  //Kiểm tra xem username đã tồn tại trong bảng users hay chưa
  public function isExistUsername($username) {
    // + Tạo câu truy vấn dạng tham số:
    $sql_select_one = "SELECT * FROM 
    users WHERE username = :username";
    // + Tạo đối tượng truy vấn, prepare
    $obj_select_one = $this->connection
        ->prepare($sql_select_one);
    // + Tạo mảng để truyền giá trị thật cho tham số trong câu
    //truy vấn
    $arr_select = [
        ':username' => $username
    ];
    // + Thực thi đối tượng truy vấn: execute
    $obj_select_one->execute($arr_select);
    // + Lấy mảng trả về: fetch
    $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)) {
      return TRUE;
    }

    return FALSE;
  }

  //Đăng ký user dựa vào username và password
  public function register($username, $password) {
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO users(username, password)
    VALUES(:username, :password)";
    // + Tạo đối tượng truy vấn:
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng để truyền giá trị thật cho tham số của
    //câu truy vấn
    $arr_insert = [
        ':username' => $username,
        ':password' => $password
    ];
    // + Thực thi đối tượng truy vấn
    $is_insert = $obj_insert->execute($arr_insert);
    return $is_insert;
  }

  //Lấy user theo username và password
  public function getUser($username, $password) {
    // + Tạo câu truy vấn dạng tham số
    $sql_select_one = "SELECT * FROM users
    WHERE username = :username AND password = :password";
    // + Tạo đối tượng truy vấn, prepare
    $obj_select_one =
    $this->connection->prepare($sql_select_one);
    // + Tạo mảng gán giá trị thật cho tham số truy vấn
    $arr_select = [
        ':username' => $username,
        ':password' => $password,
    ];
    // + Thực thi dối tượng truy vấn, execute
    $obj_select_one->execute($arr_select);
    // + Lấy mảng dữ liệu
    $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
    return $user;
  }
}