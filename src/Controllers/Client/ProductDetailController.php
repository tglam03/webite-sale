<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Exception;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Commons\Controller;

class ProductDetailController extends Controller
{

    protected Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }
    public function productDetail($id)
    {

        // Helper::debug($productDetails);
        // $productCungLoai = $product->allsanphamcungloai($id, $productDetails['catr']);
        // Helper::debug($productCungLoai);

        $productDetail = $this->product->findByID($id);
        $productCungLoai = $this->product->allsanphamcungloai($id, $productDetail['category_id']);
        // Helper::debug($productCungLoai);
        try {
            if (empty($productDetail)) {
                throw new Exception('Sản phẩm không tồn tại');
            } else {
                $this->renderViewClient('products.product-deital', [
                    'productDetail' => $productDetail,
                    'productCungLoai' => $productCungLoai
                ]);
            }
        } catch (\Throwable $th) {
            Helper::debug($th);
        }
    }
}
