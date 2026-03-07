<?php

require_once __DIR__ . '/../config/database.php';

class CategoryModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Lấy tất cả category
    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}