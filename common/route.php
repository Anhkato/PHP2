<?php

use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

// filter check đăng nhập
$router->filter('auth', function(){
    if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
        header('location: ' . BASE_URL . 'login');die;
    }
});

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn
$router->get('/', function(){
    return "trang chủ";
});
//định nghĩa đường dẫn trỏ đến Product Controller

$router->get('list-product',[\App\Controllers\ProductController::class,'index']);
$router->get('add-product',[\App\Controllers\ProductController::class,'addProduct']);
$router->post('store-product',[\App\Controllers\ProductController::class,'store']);
$router->get('detail-product/{id}',[\App\Controllers\ProductController::class,'detail']);
$router->post('edit-product/{id}',[\App\Controllers\ProductController::class,'editProduct']);
$router->get('destroy/{id}',[App\Controllers\ProductController::class, 'destroy']);
// category Controller
$router->get('list-category',[\App\Controllers\CategoryController::class,'indexCate']);
$router->get('add-category',[\App\Controllers\CategoryController::class,'addCategory']);
$router->post('store-category',[\App\Controllers\CategoryController::class,'storeCate']);
$router->get('detail-category/{id}',[\App\Controllers\CategoryController::class,'detailCate']);
$router->post('edit-category/{id}',[\App\Controllers\CategoryController::class,'editCategory']);
$router->get('destroy-category/{id}',[\App\Controllers\CategoryController::class, 'destroyCate']);

// khu vực cần quan tâm -----------
//$router->get('test', [App\Controllers\ProductController::class, 'index']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;


?>