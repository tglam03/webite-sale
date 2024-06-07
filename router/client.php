<?php

// Để định nghĩa được, đầu tiên phải tạo các controller trướ
// Tiếp theo, khai báo function tương ứng để xử lí
// Bước cuối, định nghĩa đường dẫn


// http method: get post  put  (path) delete


// tuyền vào get 2 tham số, 1 là tên đường dẫn 

use Tunglam\BasicPhp2\Controllers\Client\HomeController;
use Tunglam\BasicPhp2\Controllers\Client\AboutController;
use Tunglam\BasicPhp2\Controllers\Client\ContactController;
use Tunglam\BasicPhp2\Controllers\Client\ProductController;
use Tunglam\BasicPhp2\Controllers\Client\ProductDetailController;

// $router->get('/',                HomeController::class     . '@index');
$router->get('/about',           AboutController::class    . '@about');

$router->get('/contact',         ContactController::class  . '@index');
$router->POST('/contact/store',  ContactController::class  . '@store');

// $router->get('/product',         ProductController::class  . '@index');
// $router->get('/product/{id}',    ProductController::class  . '@detail');

$router->get('', HomeController::class . '@index');
$router->get('products', ProductController::class . '@products');
$router->get('products-detail/{$id}', ProductDetailController::class . '@productDetail');
