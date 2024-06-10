<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Rakit\Validation\Validator;
use Tunglam\BasicPhp2\Models\Cart;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Models\CartDetail;
use Tunglam\BasicPhp2\Commons\Controller;

class CartController extends Controller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->cartDetail = new CartDetail();
        $this->product = new Product();
    }
    public function detail()
    {
        // Helper::debug($_SESSION['user']['id']);
        return  $this->renderViewClient('cart.cart');
    }

    public function add()
    { // thêm vào giỏ hàng
        // Lấy thông tin sản phẩm theo ID
        $product = $this->product->findByID($_GET['productID']);

        // Khởi tạo SESSION cart
        // Check n đang đang đăng nhập hay không
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if (!isset($_SESSION[$key][$product['id']])) {

            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {

            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }

        // Nếu mà nó đăng nhập thì mình phải lưu n vào trong csdl
        if (isset($_SESSION['user'])) {
            $conn = $this->cart->getConnection();

            // $conn->beginTransaction();
            try {

                $cart = $this->cart->findUserById($_SESSION['user']['id']);

                if (empty($cart)) {
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id']
                    ]);
                }

                $cartID = $cart['id'] ?? $conn->lastInsertId();

                $_SESSION['cart_id'] = $cartID;

                $this->cartDetail->deleteByCartID($cartID);

                foreach ($_SESSION[$key] as $productID => $item) {
                    $this->cartDetail->insert([
                        'cart_id' => $cartID,
                        'product_id' => $productID,
                        'quantity' => $item['quantity']
                    ]);
                }

                // $conn->commit();
            } catch (\Throwable $th) {
                // echo $th->getMessage();die;
                //throw $th;
                // $conn->rollBack();
            }
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function quantityInc()
    { // Tăng số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }


        $_SESSION[$key][$_GET['productID']]['quantity'] += 1;

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function quantityDec()
    { // giảm số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if ($_SESSION[$key][$_GET['productID']]['quantity'] > 1) {
            $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
        }

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function remove()
    {
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        unset($_SESSION[$key][$_GET['productID']]);

        if (isset($_SESSION['user'])) {
            $this->cartDetail->deleteByCartIDAndProductID($_GET['cartID'], $_GET['productID']);
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }
}
