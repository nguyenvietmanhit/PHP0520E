<?php
//xóa hết nội dung của class models/Pagination
//định nghĩa 1 class PAgination chuyên dùng cho phân trang
class Pagination {
  //Khai báo 1 thuộc tính cho class, thuộc tính này đóng vai
  //trò là nơi nhận các giá trị của các chức năng tương ứng
  //muốn  hiển thị phân trang
  public $params = [
     //Tổng số bản ghi đc dùng để phân trang
    'total' => 0,
    // Hiển thị bao nhiêu bản ghi trên 1 trang
    'limit' => 0,
    // Controller và action nào đang hiển thị
    // chức năng phân trang
    'controller' => '',
    'action' => '',
    // Kiểu hiển thị phân trang , kiểu fullmode -> show tất cả
    // trang, ngược lại là kiểu show 1 số trang mặc định
    'full_mode' => TRUE
  ];

  // Lợi dụng phương thức khởi tạo của 1 class để khởi tạo
  //giá trị mặc định cho thuộc tính params
  // Phương thức khởi tạo là phương thức chạy ngầm đầu tiên
  //khi khởi tạo 1 đối tượng từ class đó
  public function __construct($params = []) {
    // Gán giá trị cho thuộc tính params, giá trị này sẽ đến
    // từ tham số params của phương thức khởi tạo
    $this->params = $params;
  }

  // Lấy ra tổng số trang hiện tại
  public function getTotalPage() {
    // Giả sử có 42 bản ghi, mỗi trang hiển thị 5 bản ghi
    // -> cần tổng là bao nhiêu trang?
    // -> phương thúc này sẽ trả về là 42/5 làm tròn = 9
    $total = $this->params['total'];
    $limit = $this->params['limit'];
    $total_page = $total / $limit;
    //cần làm tròn số lên trong mọi trường hợp nếu như phép chia
    //có kết quả là số thập phân
    //vd: 8.4 -> 9, 8.9 -> 9, 8.001 -> 9
    $total_page = ceil($total_page);
    return $total_page;
  }

  // Phương thức trả về trang hiện tại
  // trong cấu trúc phân trang
  public function getCurrentPage() {
    //Mục đích lấy ra trang hiện tại để nhận biết đang đứng
    //ở trang nào
    //Cần dựa vào URL của chức năng phân trang để biết đc
    //trang hiện tại là trang nào
    //vd: index.php?controller=product&action=index&page=4
    //Giả sử trang đầu tiên = 1
    $page = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $page = $_GET['page'];
      //Nếu như user sửa giá trị của tham số page >= tổng số
      //trang đang có, cần gán lại bằng tổng số trang
      $total_page = $this->getTotalPage();
      if ($page >= $total_page) {
        $page = $total_page;
      }
    }
    return $page;
  }

  //Phương thức sinh ra nút Prev - Về trang trước
  public function getPrevPage() {
    //Do template đã tích hợp Bootstrap, nên sử dụng component
    //Pagination của Bootstrap để xây dựng cấu trúc phân trang
    //Kết quả trả về của phương thức này sẽ là 1 thẻ <li> do
    //mỗi trang đều là 1 thẻ <li> trong cấu trúc phân trang của
    //Bootstrap
    $prev_page = '';
    //Link Prev ko hiển thị trong trường hợp trang đầu tiên
    $current_page = $this->getCurrentPage();
    if ($current_page >= 2) {
      //định nghĩa url cho link Prev này theo cấu trúc MVC
      $controller = $this->params['controller'];
      $action = $this->params['action'];
      $prev_url =
      "index.php?controller=$controller&action=$action&page=" . ($current_page - 1);
      $prev_page = "<li><a href='$prev_url'>Prev</a></li>";
    }
    return $prev_page;
  }

  //Phương thức sinh ra nút Next, mục đích tương tự nút Prev
  public function getNextPage() {
    $next_page = '';
    //Nếu trang hiện tại >= tổng số trang đang có thì sẽ ko hiển
    //thị nút Next
    $total_page = $this->getTotalPage();
    $current_page = $this->getCurrentPage();
    if ($current_page < $total_page) {
      $controller = $this->params['controller'];
      $action = $this->params['action'];
      $next_url =
      "index.php?controller=$controller&action=$action&page=" . ($current_page + 1);
      $next_page = "<li><a href='$next_url'>Next</a></li>";
    }
    return $next_page;
  }

  //Phương thức trả về cấu trúc phân trang của Bootstrap
  //theo <ul><li>
  public function getPagination() {
    $pagination = '';
    // Không hiển thị phân trang nếu chỉ có 1 trang duy nhất
    $total_page = $this->getTotalPage();
    if ($total_page == 1) {
      return '';
    }
    //Tạo cấu trúc phân trang theo Bootstrap
    $pagination .= "<ul class='pagination'>";
    //Ở giữa cấu trúc <ul> là logic để show ra các <li>
    //Show ra link Prev
    $prev_page = $this->getPrevPage();
    $pagination .= $prev_page;

    //Dựa vào kiểu hiển thị phân trang, key = full_mode của
    //thuộc tính params để hiển thị ra các trang
    $full_mode = $this->params['full_mode'];
    //Nếu là chế độ full mode -> show ra tất cả các trang
    $controller = $this->params['controller'];
    $action = $this->params['action'];
    if ($full_mode) {
      // Lặp toàn bộ các trang để set url cho từng trang
      // và set cấu trúc <li> cho từng trang theo đúng cấu
      //trúc của Bootstrap
      for ($page = 1; $page <= $total_page; $page++) {
        //So sánh nếu là trang hiện tại thì thêm class active
        //và ko set url cho trang đó
        $current_page = $this->getCurrentPage();
        if ($current_page == $page) {
          $pagination .=
          "<li class='active'><a href='#'>$page</a></li>";
        } else {
          $page_url =
          "index.php?controller=$controller&action=$action&page=$page";
          $pagination .= "<li><a href='$page_url'>$page</a></li>";
        }
      }
    }
    //Nếu không phải fullmode
    else {
      //Lặp từng trang
      for ($page = 1; $page <= $total_page; $page++) {
        //Nếu là trang hiện tại thì sẽ ko để link, và set class
        //active
        $current_page = $this->getCurrentPage();
        if ($current_page == $page) {
          $pagination .=
          "<li class='active'><a href='#'>$page</a></li>";
        }
        // Nếu là trang đầu tiên hoặc trang cuối cùng hoặc trang
        // ngay trước trang hiện tại hoặc trang ngay sau trang
        // hiện tại thì vẫn hiển thị tên trang thay vì dấu ...
        elseif ($page == 1 || $page == $total_page
        || ($page == $current_page - 1 )
        || ($page == $current_page + 1)) {
          $page_url =
          "index.php?controller=$controller&action=$action&page=$page";
          $pagination .= "<li><a href='$page_url'>$page</a></li>";
        }
        // Nếu page = 2, 3 , trang cuối - 1, trang cuối - 2
        elseif ($page == 2 || $page == 3
            || $page == ($total_page - 1)
            || $page == ($total_page - 2)
        ){
          $pagination .= "<li><a href='#'>...</a></li>";
        }
      }
    }

    //Show ra link Next
    $next_page = $this->getNextPage();
    $pagination .= $next_page;
    $pagination .= "</ul>";
    return $pagination;
  }
}
//Khi khởi tạo class Pagination, cần truyền vào 1 tham số tương
//ứng, do phương thức khởi tạo của class Pagination đang có
//1 tham số truyền vào nên khi khởi tạo đối tượng cũng cần
//truyền vào 1 giá trị tương ứng với tham số đó
//$params = [
//    'a' => 1
//];
//$pagination = new Pagination($params);
?>