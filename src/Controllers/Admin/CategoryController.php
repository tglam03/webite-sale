<?php

namespace Tunglam\BasicPhp2\Controllers\Admin;

use Rakit\Validation\Validator;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Models\Category;
use Tunglam\BasicPhp2\Commons\Controller;

class CategoryController extends Controller
{
    // khởi tạo thuộc tính
    private Category $category;

    // khởi tạo contruct

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
        // $category = $this->category->all();
        [$category, $totalPage] = $this->category->paginate();
        // Helper::debug($category);
        //truyền tên thư mục sau đó truyền tên file, sau đó dùng dấu chấm để chia tầng
        $this->renderViewAdmin('categorys.index', [
            'categorys' => $category,
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


        $this->renderViewAdmin('categorys.create', [
            'categorys' => $categorys
        ]);
    }

    public function store()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'          => 'required',
        ]);

        $validation->validate();

        // nếu  lỗi
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // chuyển về trang tạo mới
            header('Location: ' . url('admin/categorys/create'));
            exit;
        } else {
            // lấy dữ liệu từ form ở trang create
            $data = [
                'name'          => $_POST['name']
            ];


            $this->category->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url('admin/categorys'));
            exit;
        }
    }

    public function show($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categorys.show', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        $category = $this->category->findByID($id);


        $this->renderViewAdmin('categorys.edit', [
            'category' => $category
        ]);
    }

    public function update($id)
    {
        $category = $this->category->findByID($id);

        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'          => 'required',
        ]);

        $validation->validate();

        // nếu  lỗi
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // chuyển về trang tạo mới
            header('Location: ' . url('admin/categorys/edit'));
            exit;
        } else {
            // lấy dữ liệu từ form ở trang edit
            $data = [
                'name'          => $_POST['name']
            ];


            $this->category->update($id, $data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url('admin/categorys'));
            exit;
        }
    }

    public function delete($id)
    {
        try {
            $this->category->delete($id);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';
        } catch (\Throwable $th) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác không thành công!';
        }

        header('Location: ' . url('admin/categorys'));
        exit();
    }
}
