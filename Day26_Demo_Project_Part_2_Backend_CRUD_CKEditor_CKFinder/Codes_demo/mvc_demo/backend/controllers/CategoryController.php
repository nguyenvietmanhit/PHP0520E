<?php
require_once 'controllers/Controller.php';
//controllers/CategoryController.php
class CategoryController extends Controller {
  //với hệ thống thực tế, thì sẽ có rất nhiều mvc cho từng
//  chức năng, áp dụng tính chất kế thừa để các class con
//có thể sử dụng lại các thuộc tính và phương thức của class cha
  public function create() {
    //set title page cho chức năng thêm mới
    $this->title_page = 'Trang thêm mới danh mục';
//    echo "CREATE";
    // + Lấy nội dung view create
    $this->content =
    $this->render('views/categories/create.php');
    // + Nhúng file layout để hiển thị nội dung view trên
    require_once 'views/layouts/main.php';
  }
}