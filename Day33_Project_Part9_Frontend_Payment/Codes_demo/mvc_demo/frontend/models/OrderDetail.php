<?php
//models/OrderDetail.php
require_once 'models/Model.php';
class OrderDetail extends Model {
  public $order_id;
  public $product_id;
  public $quantity;

  public function insert() {
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO 
order_details(order_id, product_id, quantity) 
VALUES (:order_id, :product_id, :quantity)";
    // + Tạo đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng
    $arr_insert = [
        ':order_id' => $this->order_id,
        ':product_id' => $this->product_id,
        ':quantity' => $this->quantity,
    ];
    // + Thực thi đối tượng truy vấn
    return $obj_insert->execute($arr_insert);
  }
}