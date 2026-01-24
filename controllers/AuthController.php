<?php

require_once __DIR__ . '/../config/database.php';

class AuthController {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['email']) || !isset($input['password'])) {
            http_response_code(401);
            echo json_encode([
                "status" => "error",
                "message" => "Email dan password wajib kamu isi!"
            ]);
            exit;
        }

        $email = $input['email'];
        $password = $input['password'];

        $query = "
                SELECT users.user_id, users.name, users.email, users.password, roles.role_name
                FROM users
                JOIN roles ON users.role_id = roles.role_id
                WHERE users.email = :email
                LIMIT 1
                ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user['password'])) {
                http_response_code(401);
                echo json_encode([
                    "status" => "error",
                    "message" => "Email atau kata sandi kamu salah"
                ]);
                exit;
            }

        //simpan ke session 
        $_SESSION['user'] = [
            "user_id" => $user['user_id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "role_name" => $user['role_name']
        ];

        echo json_encode([
            "status" => "success",
            "message" => "Login berhasil",
            "data" => $_SESSION['user']
        ]);
        exit;
    }

    public function logout()
{
    AuthMiddleware::check(); 

    unset($_SESSION['user']);

    session_destroy();

    echo json_encode([
        "status" => "success",
        "message" => "Logout berhasil"
    ]);
    exit;
}
}