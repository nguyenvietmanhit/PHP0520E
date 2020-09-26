<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'helpers/Helper.php';

class PaymentController extends Controller {
  public function index() {
    //Xử lý submit form
    // + Debug thông tin biến $_POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // + Kiểm tra nếu user submit form thì mới xử lý
    if (isset($_POST['submit'])) {
      // + Tạo biến trung gian cho dễ thao tác
      $fullname = $_POST['fullname'];
      $address = $_POST['address'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $note = $_POST['note'];
      $method = $_POST['method'];
      // + Valiate form:
      // - Các trường fullname, address, mobile, email ko đc
      // để trống
      // - Trường email phải có định dạng email
      if (empty($fullname) || empty($address)
          || empty($mobile) || empty($email)) {
        $this->error = 'Fullname, address, mobile, email ko đc
        để trống';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error = 'Email chưa đúng định dạng';
      }
      // + Xử lý lưu thông tin đơn hàng chỉ khi ko có lỗi xảy ra
      if (empty($this->error)) {
        // + Lưu lại thông tin đơn hàng vào bảng orders và
        //order_details theo thứ tự: orders -> order_details
        // + Lưu vào bảng orders
        $order_model = new Order();
        // + Gán các giá trị từ form cho các thuộc tính của
        //đối tượng order vừa khởi tạo
        $order_model->fullname = $fullname;
        $order_model->address = $address;
        $order_model->mobile = $mobile;
        $order_model->note = $note;
        // + Tính tổng giá trị đơn hàng để lưu vào thuộc tính
        //price_total, lặp giỏ hàng, cộng dồn Thành tiền
        $price_total = 0;
        foreach ($_SESSION['cart'] AS $cart) {
          $total_item = $cart['price'] * $cart['quantity'];
          $price_total += $total_item;
        }
        $order_model->price_total = $price_total;
        // + Mặc định trạng thái ban đầu của đơn hàng là Chưa
        //thanh toán
        $order_model->payment_status = 0;
        // + Gọi phương thức insert của model
        $order_id = $order_model->insert();
//        var_dump($order_id);
        // + Tiếp tục lưu vào bảng order_details, xử lý lưu
        //ngay trong vòng lặp của mảng giỏ hàng
        foreach ($_SESSION['cart'] AS $product_id => $cart) {
          // + Khởi tạo đối tượng từ model OrderDetail
          $order_detail_model = new OrderDetail();
          $order_detail_model->order_id = $order_id;
          $order_detail_model->product_id = $product_id;
          $order_detail_model->quantity = $cart['quantity'];
          // + Gọi phương thức insert của model
          $is_insert = $order_detail_model->insert();
          var_dump($is_insert);
        }
        // + Gửi mail cho khách hàng về thông tin đơn hàng
        // + Sử dụng phương thức tĩnh sendMail của class Helper
        // + Khai báo các giá trị để chuẩn bị truyền vào phương
        //thức sendMail
        $subject = "Từ Abc.com - Thông tin của bạn";
        $username = 'nguyenvietmanhit@gmail.com';
        // Truy cập https://myaccount.google.com/ để lấy mật
        //khẩu ứng dụng
        $password = 'yichffdzhetottuw';
        // Nội dung mail, lấy nội dung mail mẫu về bán hàng tại
        //đường dẫn views/payments/mail_template_order.php
        $info_customer = [
          'fullname' => $fullname,
          'mobile' => $mobile,
          'email' => $email,
          'address' => $address
        ];
        $body =
        $this->render('views/payments/mail_template_order.php', [
            'info_customer' => $info_customer
        ]);
        Helper::sendMail($email, $subject,
            $body, $username, $password);

        //Sau khi gửi mail xóa session giỏ hàng đi
        unset($_SESSION['cart']);

        // + Dựa vào phương thức thanh toán mà user chọn: nếu
        //là trực tuyến -> thanh toán qua ngân lượng, nếu là
        //cod thì chuyển hướng về trang cảm ơn
        // + Nếu là thanh toán trực tuyến
        if ($method == 0) {
          //Tạo session chứa thông tin tương ứng mà nganluong
          //yêu cầu
          $_SESSION['nganluong_info'] = [
            'price_total' => $price_total,
            'fullname' => $fullname,
            'email' => $email,
            'mobile' => $mobile
          ];
          header("Location: thanh-toan-online.html");
          exit();
        } else {
          header('Location: cam-on.html');
          exit();
        }
      }
    }

    //Lấy nội dung view tương ứng
    $this->content =
        $this->render('views/payments/index.php');
    //Gọi layout để hiển thị nội dung view
    require_once 'views/layouts/main.php';
  }

  public function online() {
    //Gọi view của ngân lương ra để hiển thị, lưu ý view của
    //trang thanh toán trực tuyến sẽ ko liên quan gì đến trang
    //của bạn
    $view_online =
    $this->render('libraries/nganluong/index.php');
    echo $view_online;
    // + Xóa session sau khi sử dụng
    unset($_SESSION['nganluong_info']);
  }
}