<?php

require_once 'app/controllers/ProductController.php';
session_start();
$url = $_GET['url'] ?? 'Product/home';
$url = explode('/', trim($url, '/'));

$controllerName = $url[0] ?? 'Product';
$method = $url[1] ?? 'list';
$id = $url[2] ?? null;

if ($controllerName !== 'Product') {
    die('Controller không tồn tại');
}

$controller = new ProductController();

if (!method_exists($controller, $method)) {
    die("Method '$method' không tồn tại");
}

$controller->$method($id);
