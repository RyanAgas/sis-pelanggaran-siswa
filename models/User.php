<?php

class User {
    private $db;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $role_id;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method untuk mengambil semua user
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method penting: Verifikasi Login
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = ?";
        // Gunakan prepared statements untuk keamanan (SQL Injection)
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}