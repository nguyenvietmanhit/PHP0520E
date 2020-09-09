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



  public function index()
  {
    //nếu user update form giỏ hàng
    if (isset($_POST['submit'])) {
      //lặp mảng giỏ hàng để tiến hành update lại số lượng cho giỏ hàng
      foreach ($_SESSION['cart'] AS $product_id => $cart) {
        $_SESSION['cart'][$product_id]['quantity'] = $_POST[$product_id];
      }
      $_SESSION['success'] = 'Cập nhật giỏ hàng thành công';
    }

    $this->content = $this->render('views/carts/index.php');
    require_once 'views/layouts/main.php';
  }


  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'Không tồn tại id';
      //sau khi xử lý xong giỏ hàng thì chuyển hướng về trang danh sách giỏ hàng
      //do đang sử dụng rewwrite url nên các url khi chuyển hướng cần có cả đường dẫn ứng dụng
      $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban.html';
      header("Location: $url_redirect");
      exit();
    }

    $product_id = $_GET['id'];
    unset($_SESSION['cart'][$product_id]);
    //nếu sau khi xóa sản phẩm hiện tại, nếu giỏ hàng trống thì xóa session cart này đi
    if (empty($_SESSION['cart'])) {
      unset($_SESSION['cart']);
    }

    $_SESSION['success'] = 'Xóa sản phẩm khỏi giỏ hàng thành công';

    //chuyển hướng về trang giỏ hàng
    //sau khi xử lý xong giỏ hàng thì chuyển hướng về trang danh sách giỏ hàng
    //do đang sử dụng rewwrite url nên các url khi chuyển hướng cần có cả đường dẫn ứng dụng
    $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban.html';
    header("Location: $url_redirect");
    exit();
  }
}