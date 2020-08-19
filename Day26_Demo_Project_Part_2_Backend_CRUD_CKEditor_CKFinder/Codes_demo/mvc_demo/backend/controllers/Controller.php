<?php
//controllers/Controller.php
//đóng vai trò class cha
class Controller {
  //chứa thông tin lỗi
  public $error;
  //chứa nội dung view động
  public $content;
  //chứa tiêu đề trang sử dụng trong thẻ <title>
  public $title_page;

  //phương thức lấy nội dung view dựa vào đường dẫn
  //$path_view: đường dẫn tới file view
  //$variables: mảng chứa các phần tử mà truyền từ controller
  //sang view
  public function render($path_view, $variables = []) {
    //giải nén các biến từ mảng $variables nếu có
    extract($variables);
    //Tạo vùng nhớ để ghi nhớ nội dung file
    ob_start();
    //Nhúng đường dẫn file vào để bắt đầu đọc nội dung
//    echo "sâsa";
    require_once "$path_view";
    //Kết thúc việc đọc file
    return ob_get_clean();
  }
}