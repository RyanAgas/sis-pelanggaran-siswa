<?php

class User {

    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Ambil semua user tanpa pw
    public function getAll()
    {
        $query = "
                SELECT 
                    users.user_id,
                    users.name,
                    users.email,
                    users.role_name
                FROM users
                JOIN roles ON users.role_id = roles.role_id
                ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Ambil user berdasarkan emailnya (untuk AuthController)
    public function getByEmail($email)
    {
        $query = "
                SELECT
                    users.user_id,
                    users.name,
                    users.email,
                    users.password,
                    roles.role_name
                FROM users
                JOIN roles ON users.role_id = roles.role_id
                WHERE users.email = :email
                LIMIT 1
            ";  

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}