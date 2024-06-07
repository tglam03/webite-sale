<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Commons\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $product = new Product();
        [$products, $totalPage] = $product->paginate(1, 8);
        $this->renderViewClient('index', [
            'products' => $products
        ]);
    }
}
