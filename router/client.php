<?php

// Để định nghĩa được, đầu tiên phải tạo các controller trướ
// Tiếp theo, khai báo function tương ứng để xử lí
// Bước cuối, định nghĩa đường dẫn


// http method: get post  put  (path) delete


// tuyền vào get 2 tham số, 1 là tên đường dẫn 

use Tunglam\BasicPhp2\Controllers\Client\AuthController;
use Tunglam\BasicPhp2\Controllers\Client\CartController;
use Tunglam\BasicPhp2\Controllers\Client\HomeController;
use Tunglam\BasicPhp2\Controllers\Client\AboutController;
use Tunglam\BasicPhp2\Controllers\Client\ContactController;
use Tunglam\BasicPhp2\Controllers\Client\ProductController;
use Tunglam\BasicPhp2\Controllers\Client\CheckOutController;
use Tunglam\BasicPhp2\Controllers\Client\ProductDetailController;

// $router->get('/',                HomeController::class     . '@index');
$router->get('/about',                  AboutController::class    . '@about');

$router->get('contact',                 ContactController::class  . '@index');
$router->post('contact/store',          ContactController::class  . '@store');


$router->get('',                        HomeController::class          . '@index');

$router->get('products',                ProductController::class       . '@products');

$router->get('products-detail/{$id}',   ProductDetailController::class . '@productDetail');


$router->get('login',                   AuthController::class  . '@login');
$router->post('handle-login',           AuthController::class  . '@handleLogin');
$router->get('register',                AuthController::class  . '@register');
$router->post('handle-register',        AuthController::class  . '@handleRegister');
$router->get('logout',                  AuthController::class  . '@sigOut');


$router->get('cart/detail',              CartController::class   . '@detail');
$router->get('cart/add',                 CartController::class   . '@add');
$router->get('cart/quantityInc',         CartController::class   . '@quantityInc');
$router->get('cart/quantityDec',         CartController::class   . '@quantityDec');
$router->get('cart/remove',              CartController::class   . '@remove');


$router->get('checkout',              CheckOutController::class   . '@viewCheckOut');
$router->get('order/checkout',              CheckOutController::class   . '@checkout');

$router->get('confirm',               CheckOutController::class   . '@confirm');
