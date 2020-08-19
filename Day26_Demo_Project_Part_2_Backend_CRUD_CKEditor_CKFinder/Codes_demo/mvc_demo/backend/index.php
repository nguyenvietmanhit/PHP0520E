<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * Codes_demo/mvc_demo/backend/index.php
 * File index gốc của ứng dụng, đây là file đầu tiên sẽ code
 * khi xây dựng MVC
 * index.php?controller=category&action=create
 */
// + Lấy giá trị của tham số controller và action
$controller = isset($_GET['controller']) ? $_GET['controller']
    : 'home'; //category
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
//create
// + Biến đổi giá trị của controller để làm sao nhúng đc file
//controller tương ứng từ giá trị này
//mục tiêu: CategoryController.php
$controller = ucfirst($controller); //Category
$controller .= "Controller"; //CategoryController
$path_controller = "controllers/$controller.php";
if (!file_exists($path_controller)) {
  die("Trang bạn tìm ko tồn tại");//404
}
require_once "$path_controller";
$obj = new $controller();
if (!method_exists($obj, $action)) {
  die("Phương thức $action ko tồn tại trong class $controller");
}
$obj->$action();
//index.php?controller=category&action=create
?>