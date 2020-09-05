<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';

class ProductController extends Controller
{
  public function index() {
    // Thử test chức năng phân trang vừa xây dựng với
    // các dữ liệu tĩnh
    // Khởi tạo đối tượng từ class Pagination, truyền vào 1 mảng
    // theo đúng cấu trúc của thuộc tính params của class đó
//    $params_pagination = [
//        'total' => 42,
//        'limit' => 5,
//        'controller' => 'product',
//        'action' => 'index',
//        'full_mode' => FALSE
//    ];
//    $pagination_model = new Pagination($params_pagination);
//    echo $pagination_model->getPagination();

    // Xử lý khi submit form search
//    echo "<pre>";
//    print_r($_GET);
//    echo "</pre>";
    // Với chức năng search, vẫn chỉ sử dụng 1 phương thức lấy
    //dữ liệu getList(), nhưng cần xác định 1 tham số cho phương
    //thức này, để truyền vào các giá trị search nếu có
    // Tạo 1 mảng, khởi tạo giá trị ban đầu bằng rỗng, tương
    //đương với trường hợp ko search
    $params = [];
    if (isset($_GET['search'])) {
      // + Tạo biến và gán giá trị
      $category_id = $_GET['category_id'];
      $title = $_GET['title'];
      $price = $_GET['price'];
      $params['category_id'] = $category_id;
      $params['title'] = $title;
      $params['price'] = $price;
    }
    //Lấy ra toàn bộ sản phẩm đang có trong CSDL
    $product_model = new Product();
    //truyền mảng params vào làm tham số cho phương thức
    //getList

    //Áp dụng phân trang bằng cách gắn thêm các phần tử
    //cho mảng params đã khai báo
    //Xác định giá trị của key=total
    $total = $product_model->countTotal();
    $params['total'] = $total;
    // Xác định số bản ghi trên 1 trang,
    // demo 1 trang có 2 bản ghi
    $params['limit'] = 2;
    $params['controller'] = 'product';
    $params['action'] = 'index';
    $params['full_mode'] = TRUE;
    // Xác định tham số start trong LIMIT start,limit để truyền
    //vào câu truy vấn
    //VD: nếu ở trang 1 -> lấy từ bản ghi 2 bản ghi đầu tiên
    // Start = 0
    //    nếu ở trang 2 -> lấy 2 bản ghi nhưng từ vị trí thứ 2
    // start 2
    $page = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $page = $_GET['page'];
    }
    // LIMIT start,limit
    $start = ($page - 1) * $params['limit'];
    $params['start'] = $start;

    $pagination_model = new Pagination($params);
    //hiển thị phân trang ở view, nên cần truyền biến này
    //ra view
    $pagination = $pagination_model->getPagination();
    $products = $product_model->getList($params);
    //Lấy toàn bộ danh mục trong CSDL để hiển thị vào
    // phần tìm kiếm theo danh mục
    $category_model = new Category();
    $categories = $category_model->getAll();

    // + Lấy nội dung view tương ứng:
    $this->content =
        $this->render('views/products/index.php', [
            'products' => $products,
            'categories' => $categories,
            'pagination' => $pagination
        ]);
    // + Gọi layout để hiển thị ra nội dung view vừa lấy đc
    require_once 'views/layouts/main.php';
  }

  public function create()
  {
    //xử lý submit form
    if (isset($_POST['submit'])) {
      $category_id = $_POST['category_id'];
      $title = $_POST['title'];
      $price = $_POST['price'];
      $amount = $_POST['amount'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $seo_title = $_POST['seo_title'];
      $seo_description = $_POST['seo_description'];
      $seo_keywords = $_POST['seo_keywords'];
      $status = $_POST['status'];
      //xử lý validate
      if (empty($title)) {
        $this->error = 'Không được để trống title';
      } else if ($_FILES['avatar']['error'] == 0) {
        //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

        $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
        //làm tròn theo đơn vị thập phân
        $file_size_mb = round($file_size_mb, 2);

        if (!in_array($extension, $arr_extension)) {
          $this->error = 'Cần upload file định dạng ảnh';
        } else if ($file_size_mb > 2) {
          $this->error = 'File upload không được quá 2MB';
        }
      }

      //nếu ko có lỗi thì tiến hành save dữ liệu
      if (empty($this->error)) {
        $filename = '';
        //xử lý upload file nếu có
        if ($_FILES['avatar']['error'] == 0) {
          $dir_uploads = __DIR__ . '/../assets/uploads';
          if (!file_exists($dir_uploads)) {
            mkdir($dir_uploads);
          }
          //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
          $filename = time() . '-product-' . $_FILES['avatar']['name'];
          move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
        }
        //save dữ liệu vào bảng products
        $product_model = new Product();
        $product_model->category_id = $category_id;
        $product_model->title = $title;
        $product_model->avatar = $filename;
        $product_model->price = $price;
        $product_model->amount = $amount;
        $product_model->summary = $summary;
        $product_model->content = $content;
        $product_model->seo_title = $seo_title;
        $product_model->seo_description = $seo_description;
        $product_model->seo_keywords = $seo_keywords;
        $product_model->status = $status;
        $is_insert = $product_model->insert();
        if ($is_insert) {
          $_SESSION['success'] = 'Insert dữ liệu thành công';
        } else {
          $_SESSION['error'] = 'Insert dữ liệu thất bại';
        }
        header('Location: index.php?controller=product');
        exit();
      }
    }

    //lấy danh sách category đang có trên hệ thống để phục vụ cho search
    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/products/create.php', [
        'categories' => $categories
    ]);
    require_once 'views/layouts/main.php';
  }

  public function detail()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: index.php?controller=product');
      exit();
    }

    $id = $_GET['id'];
    $product_model = new Product();
    $product = $product_model->getById($id);

    $this->content = $this->render('views/products/detail.php', [
        'product' => $product
    ]);
    require_once 'views/layouts/main.php';
  }

  public function update()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: index.php?controller=product');
      exit();
    }

    $id = $_GET['id'];
    $product_model = new Product();
    $product = $product_model->getById($id);
    //xử lý submit form
    if (isset($_POST['submit'])) {
      $category_id = $_POST['category_id'];
      $title = $_POST['title'];
      $price = $_POST['price'];
      $amount = $_POST['amount'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $seo_title = $_POST['seo_title'];
      $seo_description= $_POST['seo_description'];
      $seo_keywords = $_POST['seo_keywords'];
      $status = $_POST['status'];
      //xử lý validate
      if (empty($title)) {
        $this->error = 'Không được để trống title';
      } else if ($_FILES['avatar']['error'] == 0) {
        //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

        $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
        //làm tròn theo đơn vị thập phân
        $file_size_mb = round($file_size_mb, 2);

        if (!in_array($extension, $arr_extension)) {
          $this->error = 'Cần upload file định dạng ảnh';
        } else if ($file_size_mb > 2) {
          $this->error = 'File upload không được quá 2MB';
        }
      }

      //nếu ko có lỗi thì tiến hành save dữ liệu
      if (empty($this->error)) {
        $filename = $product['avatar'];
        //xử lý upload file nếu có
        if ($_FILES['avatar']['error'] == 0) {
          $dir_uploads = __DIR__ . '/../assets/uploads';
          //xóa file cũ, thêm @ vào trước hàm unlink để tránh báo lỗi khi xóa file ko tồn tại
          @unlink($dir_uploads . '/' . $filename);
          if (!file_exists($dir_uploads)) {
            mkdir($dir_uploads);
          }
          //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
          $filename = time() . '-product-' . $_FILES['avatar']['name'];
          move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
        }
        //save dữ liệu vào bảng products
        $product_model->category_id = $category_id;
        $product_model->title = $title;
        $product_model->avatar = $filename;
        $product_model->price = $price;
        $product_model->amount = $amount;
        $product_model->summary = $summary;
        $product_model->content = $content;
        $product_model->seo_title = $seo_title;
        $product_model->seo_description = $seo_description;
        $product_model->seo_keywords = $seo_keywords;
        $product_model->status = $status;
        $product_model->updated_at = date('Y-m-d H:i:s');

        $is_update = $product_model->update($id);
        if ($is_update) {
          $_SESSION['success'] = 'Update dữ liệu thành công';
        } else {
          $_SESSION['error'] = 'Update dữ liệu thất bại';
        }
        header('Location: index.php?controller=product');
        exit();
      }
    }

    //lấy danh sách category đang có trên hệ thống để phục vụ cho search
    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/products/update.php', [
        'categories' => $categories,
        'product' => $product,
    ]);
    require_once 'views/layouts/main.php';
  }

  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: index.php?controller=product');
      exit();
    }

    $id = $_GET['id'];
    $product_model = new Product();
    $is_delete = $product_model->delete($id);
    if ($is_delete) {
      $_SESSION['success'] = 'Xóa dữ liệu thành công';
    } else {
      $_SESSION['error'] = 'Xóa dữ liệu thất bại';
    }
    header('Location: index.php?controller=product');
    exit();
  }
}