<?php

require_once __DIR__ . '/../config/database.php';

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Lấy tất cả
    public function getAll()
    {
        $sql = "SELECT * FROM products ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Đã sửa: dùng $this->conn thay vì $this->db
    public function create($name, $description, $price, $image, $category_id, $discount = 0)
    {
        $sql = "INSERT INTO products (name, description, price, image, category_id, discount) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $description, $price, $image, $category_id, $discount]);
    }

    // Đã sửa: dùng $this->conn thay vì $this->db
    public function update($id, $name, $description, $price, $image, $category_id, $discount = 0)
    {
        $sql = "UPDATE products 
                SET name = ?, description = ?, price = ?, image = ?, category_id = ?, discount = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $description, $price, $image, $category_id, $discount, $id]);
    }

    // Xóa
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }

    // Tìm
    public function find($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}