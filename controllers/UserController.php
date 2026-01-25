<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';

class UserController {

    private $user;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->user = new User($db);
    }

    //GET /users (admin only)
    public function index()
    {
        AuthMiddleware::check();
        RoleMiddleware::allow(['admin']);

        $data = $this->user->getAll();

        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
        exit;
    }
}