<?php

class Database
{
    private $host = "127.0.0.1";
    private $db   = "techzone"; 
    private $user = "root";
    private $pass = "";
    private $charset = "utf8mb4";

    public function connect()
    {
        try {

            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

            $pdo = new PDO($dsn, $this->user, $this->pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }
}
