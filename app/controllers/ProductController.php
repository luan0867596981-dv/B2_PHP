<?php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function home()
    {
        $products = $this->model->getAll();
        include __DIR__ . '/../views/home.php';
    }

    public function list()
    {
        $products = $this->model->getAll();
        include __DIR__ . '/../views/product/list.php';
    }

    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $products = $this->model->getAll();
        if($keyword != ""){
            $products = array_filter($products,function($p) use ($keyword){
                return stripos($p['name'],$keyword) !== false;
            });
        }
        include __DIR__ . '/../views/home.php';
    }

    public function filterPrice()
    {
        $range = $_GET['price_range'] ?? '';
        $allProducts = $this->model->getAll();
        $products = array_filter($allProducts, function($p) use ($range) {
            $price = (float)$p['price'];
            if ($range == 'under_5') return $price < 5000000;
            if ($range == '5_to_15') return $price >= 5000000 && $price <= 15000000;
            if ($range == '15_to_30') return $price > 15000000 && $price <= 30000000;
            if ($range == 'over_30') return $price > 30000000;
            return true;
        });
        $products = array_values($products);
        include __DIR__ . '/../views/home.php';
    }

    public function category($name)
    {
        $products = $this->model->getAll();
        $products = array_filter($products,function($p) use ($name){
            return stripos($p['name'],$name) !== false;
        });
        include __DIR__ . '/../views/home.php';
    }

    public function cart()
    {
        $cart = $_SESSION['cart'] ?? [];
        include __DIR__ . '/../views/cart.php';
    }

    public function addToCart($id)
    {
        $product = (array) $this->model->getById($id);
        if (empty($product)) die("Không tìm thấy sản phẩm");

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            $item = (array) $item;
            if (isset($item['id']) && $item['id'] == $id) {
                $item['qty'] = (isset($item['qty']) ? (int)$item['qty'] : 1) + 1;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $product['qty'] = 1;
            $_SESSION['cart'][] = $product;
        }
        session_write_close();
        header("Location: index.php?url=Product/cart");
        exit;
    }

    public function increaseCart($id)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as &$item) {
                $item = (array) $item;
                if (isset($item['id']) && $item['id'] == $id) {
                    $item['qty'] += 1;
                    break;
                }
            }
        }
        session_write_close();
        header("Location: index.php?url=Product/cart");
        exit;
    }

    public function decreaseCart($id)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => &$item) {
                $item = (array) $item;
                if (isset($item['id']) && $item['id'] == $id) {
                    if ($item['qty'] > 1) {
                        $item['qty'] -= 1;
                    } else {
                        unset($_SESSION['cart'][$key]);
                    }
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        session_write_close();
        header("Location: index.php?url=Product/cart");
        exit;
    }

    public function removeCart($id)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                $item = (array) $item;
                if (isset($item['id']) && $item['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        header("Location: index.php?url=Product/cart");
        exit;
    }

    public function add()
    {
        $errors = [];
        require_once __DIR__ . '/../models/CategoryModel.php';
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $image = $_POST['image'] ?? '';
            $category_id = $_POST['category_id'] ?? 0;
            $discount = (int)($_POST['discount'] ?? 0);

            if($discount < 0) $discount = 0;
            if($discount > 100) $discount = 100;

            if (strlen($name) < 3) $errors[] = 'Tên quá ngắn';
            if ($price <= 0) $errors[] = 'Giá bán phải lớn hơn 0';
            if (empty($category_id)) $errors[] = 'Vui lòng chọn danh mục sản phẩm';

            if (empty($errors)) {
                $this->model->create($name, $description, $price, $image, $category_id, $discount);
                header('Location: index.php?url=Product/list');
                exit;
            }
        }
        include __DIR__ . '/../views/product/add.php';
    }

    public function edit($id)
    {
        if (!$id) die('Thiếu ID');
        $product = $this->model->getById($id);
        if (!$product) die('Không tìm thấy');

        require_once __DIR__ . '/../models/CategoryModel.php';
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $discount = (int)($_POST['discount'] ?? 0);
            if($discount < 0) $discount = 0;
            if($discount > 100) $discount = 100;

            $this->model->update(
                $id,
                $_POST['name'],
                $_POST['description'],
                $_POST['price'],
                $_POST['image'],
                $_POST['category_id'],
                $discount
            );
            header('Location: index.php?url=Product/list');
            exit;
        }
        include __DIR__ . '/../views/product/edit.php';
    }

    public function delete($id)
    {
        if ($id) $this->model->delete($id);
        header('Location: index.php?url=Product/list');
        exit;
    }

    public function detail($id)
    {
        if (!$id) die('Thiếu ID');
        $product = $this->model->getById($id);
        if (!$product) die('Không tìm thấy');
        include __DIR__ . '/../views/product/detail.php';
    }
}