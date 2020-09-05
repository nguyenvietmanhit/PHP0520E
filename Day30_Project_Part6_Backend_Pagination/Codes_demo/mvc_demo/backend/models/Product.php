<?php
require_once 'models/Model.php';

class Product extends Model
{

    public $id;
    public $category_id;
    public $title;
    public $avatar;
    public $price;
    public $amount;
    public $summary;
    public $content;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $status;
    public $created_at;
    public $updated_at;
    /*
     * Chuỗi search, sinh tự động dựa vào tham số GET trên Url
     */
    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND products.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $this->str_search .= " AND products.category_id = {$_GET['category_id']}";
        }
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE $this->str_search
                        ORDER BY products.created_at DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @param array Mảng các tham số phân trang
     * @return array
     */
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE $this->str_search
                        ORDER BY products.updated_at DESC, products.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Tính tổng số bản ghi đang có trong bảng products
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products WHERE TRUE $this->str_search");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    /**
     * Insert dữ liệu vào bảng products
     * @return bool
     */
    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO products(category_id, title, avatar, price, amount, summary, content, seo_title, seo_description, seo_keywords, status) 
                                VALUES (:category_id, :title, :avatar, :price, :amount, :summary, :content, :seo_title, :seo_description, :seo_keywords, :status)");
        $arr_insert = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE products SET category_id=:category_id, title=:title, avatar=:avatar, price=:price,amount=:amount,
            summary=:summary, content=:content, seo_title=:seo_title, seo_description=:seo_description, seo_keywords=:seo_keywords, status=:status, updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }

    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM products WHERE id = $id");
        return $obj_delete->execute();
    }

    // Lấy danh sách tất cả sản phẩm đang có trong bảng products
    //Tham số params là 1 mảng chứa dữ liệu search nếu có
    public function getList($params = []) {
      // + Tạo câu truy vấn, do cần hiển thị cả tên danh mục, mà
      //tên danh mục ko đc lưu trong bảng products, mà đang lưu
      //tại bảng categories. Vì 2 bảng này có liên kết với nhau
      //nên phải sử dụng cơ chế JOIN (INNER, LEFT, RIGHT, OUTER)
      //, sẽ dùng INNER JOIN để đảm bảo sự toàn vẹn về mặt dữ
      //liệu
      // Khi sử dụng cơ chế JOIN, luôn phải có tên bảng trước
      //tên trường để đảm bảo thao tác với đúng trường của bảng
      //mong muốn

      // + Thử viết truy vấn với điều kiện: category_id = 1, title
      // chứa chuỗi samsung, giá chứa chuỗi 50
      // WHERE category_id = 1 AND title LIKE '%samsung%'
      // AND price LIKE '%50%'

      $str_search = '';
      // với truy vấn LIKE, chỉ hoạt động khi dữ liệu khác rỗng
      //kiểm tra nếu có search theo danh mục
      if (isset($params['category_id']) &&
          $params['category_id'] != -1) {
        $category_id = $params['category_id'];
        $str_search .= " AND products.category_id = $category_id";
      }
      //Kiểm tra nếu có search theo title sp, lưu ý do dùng LIKE
      //nên bắt buộc giá trị phải khác rỗng
      if (isset($params['title']) && !empty($params['title'])) {
        $title = $params['title'];
        $str_search .= " AND products.title LIKE '%$title%'";
      }
      // Kiếm tra nếu có search theo price
      if (isset($params['price']) && $params['price'] >= 0) {
        $price = $params['price'];
        $str_search .= " AND products.price LIKE '%$price%'";
      }
      $sql_select_all =
      "SELECT products.*, categories.name AS category_name 
       FROM products
       INNER JOIN categories 
       ON products.category_id = categories.id
       WHERE TRUE $str_search";
      // + Tạo đối tượng truy vấn
      $obj_select_all = $this->connection
          ->prepare($sql_select_all);
      // + Thực thi đối tượng truy vấn, execute
      $obj_select_all->execute();
      // + Lấy mảng các product: fetchAll()
      $products =
          $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    }
}