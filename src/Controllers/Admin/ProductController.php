<?php

namespace Tunglam\BasicPhp2\Controllers\Admin;

use Rakit\Validation\Validator;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Product;
use Tunglam\BasicPhp2\Models\Category;
use Tunglam\BasicPhp2\Commons\Controller;

class ProductController extends Controller
{
    // khởi tạo thuộc tính
    private Product $product;
    private Category $category;

    // khởi tạo contruct

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        // $products = $this->product->all();
        [$products, $totalPage] = $this->product->paginate();
        // Helper::debug($products);
        //truyền tên thư mục sau đó truyền tên file, sau đó dùng dấu chấm để chia tầng
        $this->renderViewAdmin('products.index', [
            'products' => $products,
            'totalPage' => $totalPage
        ]);
    }

    public function create()
    {
        // lấy toàn bộ bản ghi trong bản categorys
        $categorys = $this->category->all();
        // Helper::debug($categorys);
        // arrary_colum gán lấy trường id làm key trong mảng

        // chuyển từ mảng 2 chiều sang mảng 1 chiều
        $categoryColum = array_column($categorys, 'name', 'id');

        $this->renderViewAdmin('products.create', [
            'categoryColum' => $categoryColum
        ]);
    }

    public function store()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'category_id'   => 'required',
            'name'          => 'required',
            'price_regular' => 'required',
            'overview'      => 'max:500', // giới hạn 500 từ
            'content'       => 'max:65000',
            'img_thumbnail' => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);

        $validation->validate();

        // nếu  lỗi
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // chuyển về trang tạo mới
            header('Location: ' . url('admin/products/create'));
            exit;
        } else {
            // lấy dữ liệu từ form ở trang create
            $data = [
                'category_id'   => $_POST['category_id'],
                'name'          => $_POST['name'],
                'price_regular' => $_POST['price_regular'],
                'price_sale'    => $_POST['price_sale'] ?: 0,
                'overview'      => $_POST['overview'],
                'content'       => $_POST['content'],
                'img_thumbnail' => $_FILES['img_thumbnail'],
            ];

            // Helper::debug($data);

            if (!empty($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to   = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload KHÔNG thành công!';

                    header('Location: ' . url('admin/products/create'));
                    exit;
                }
            }

            $this->product->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url('admin/products'));
            exit;
        }
    }

    public function show($id)
    {
        $product = $this->product->findByID($id);

        $this->renderViewAdmin('products.show', [
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        $product = $this->product->findByID($id);
        $categories = $this->category->all();

        $categoryPluck = array_column($categories, 'name', 'id');

        $this->renderViewAdmin('products.edit', [
            'product' => $product,
            'categoryPluck' => $categoryPluck,
        ]);
    }

    public function update($id)
    {
        $product = $this->product->findByID($id);

        // VALIDATE
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'category_id'           => 'required',
            'name'                  => 'required|max:100',
            'overview'              => 'max:500',
            'content'               => 'max:65000',
            'img_thumbnail'         => 'uploaded_file:0,2048K,png,jpeg,jpg',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/products/$id/edit"));
            exit;
        } else {
            $data = [
                'category_id'   => $_POST['category_id'],
                'name'          => $_POST['name'],
                'overview'      => $_POST['overview'],
                'price_regular' => $_POST['price_regular'],
                'price_sale'    => $_POST['price_sale'],
                'content'       => $_POST['content'],
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $from = $_FILES['img_thumbnail']['tmp_name'];
                // to là đường dẫn tới nơi lưu trữ file
                $to   = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];


                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload KHÔNG thành công!';

                    header('Location: ' . url("admin/products/$id/edit"));
                    exit;
                }
            }

            $this->product->update($id, $data);

            if ($product['img_thumbnail'] && file_exists(PATH_ROOT . $product['img_thumbnail'])) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url("admin/products/$id/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        try {
            $product = $this->product->findByID($id);

            $this->product->delete($id);

            if ($product['img_thumbnail'] && file_exists(PATH_ROOT . $product['img_thumbnail'])) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';
        } catch (\Throwable $th) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác không thành công!';
        }

        header('Location: ' . url('admin/products'));
        exit();
    }
}
