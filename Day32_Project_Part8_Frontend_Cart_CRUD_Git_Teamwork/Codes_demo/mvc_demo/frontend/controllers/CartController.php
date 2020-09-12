<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller
{
  //Phương thức thêm sản phẩm vào giỏ hàng
  public function add() {
    //Debug biến $_GET để xem thông tin
//    echo "<pre>";
//    print_r($_GET);
//    echo "</pre>";
    $product_id = $_GET['product_id'];
    // Gọi model để lấy ra thông tin sản phẩm theo id trên
    $product_model = new Product();
    $product = $product_model->getById($product_id);
//    echo "<pre>";
//    print_r($product);
//    echo "</pre>";
    // Tạo biến để lưu các thông tin sản phẩm theo cấu trúc
    //của giỏ hàng ban đầu: tên sp, giá, avatar, quantity
    $cart = [
      'name' => $product['title'],
      'price' => $product['price'],
      'avatar' => $product['avatar'],
      //mặc định số lượng ban đầu khi thêm vào giỏ = 1
      'quantity' => 1
    ];
    // Khi click thêm vào giỏ, sẽ có 2 trường hợp xảy ra:
    // Nếu giỏ hàng chưa từng tồn tại trước đó, thì cần khởi tạo
    //giỏ hàng và thêm sản phẩm mới vào giỏ
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'][$product_id] = $cart;
    }
    // Nếu giỏ hàng đã tồn tại trước đó r, có 2 trường hợp xảy ra
    // + NẾu sản phẩm đã tồn tại trong giỏ hàng r thì sẽ chỉ
    // update số lượng của sp đó
    // + Nếu sản phẩm chưa tồn tại thì thêm mới như bình thường
    else {
      if (array_key_exists($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product_id]['quantity']++;
      } else {
        $_SESSION['cart'][$product_id] = $cart;
      }
    }
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "</pre>";
  }
}