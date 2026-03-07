<?php

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class DefaultController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAll();

        require_once __DIR__ . '/../views/home.php';
    }
}