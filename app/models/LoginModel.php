<?php

$dirWithoutController = str_replace('app\models', '', __DIR__); 
require_once $dirWithoutController.'config\database.php'; 

class LoginModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getUsers() {
        $result = $this->conn->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un usuario por ID
    public function login($user,$password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user = ? AND password = ?");
        $stmt->bind_param("ss", $user,$password);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
