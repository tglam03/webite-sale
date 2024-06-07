<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Exception;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Commons\Controller;

class ProductDetailController extends Controller
{
    public function productDetail($id)
    {
        $product = new Product();
        $productDetail = $product->findByID($id);
        try {
            if (empty($productDetail)) {
                throw new Exception('Sản phẩm không tồn tại');
            } else {
                $this->renderViewClient('products.product-deital', [
                    'productDetail' => $productDetail
                ]);
            }
        } catch (\Throwable $th) {
            Helper::debug($th);
        }
    }
}
