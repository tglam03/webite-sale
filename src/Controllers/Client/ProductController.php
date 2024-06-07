<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Exception;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Commons\Controller;

class ProductController extends Controller
{
    public function products()
    {
        $product = new Product();
        $page = $_GET['page'] ?? 1;
        if ($page <= 0) {
            header('Location:' . url('products'));
            exit;
        }
        [$products, $totalPage] = $product->paginate($page, 8);
        // Helper::debug($products);
        $this->renderViewClient('products.listProducts', [
            'products' => $products,
            'totalPage' => $totalPage,
            'page' => $page
        ]);
    }
}
