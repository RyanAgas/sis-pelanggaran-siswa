<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';

class SiswaController {
    
    private $siswa;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->siswa = new Siswa($db);
    }

    //GET /siswa | admin, guru_bk
    public function index()
    {
        AuthMiddleware::check();
        RoleMiddleware::allow(['admin', 'guru_bk']);

        $data = $this->siswa->getAll();

        echo json_encode([
            "status" => "success",
            "message" => $data
        ]);
        exit;
    }

    //GET /siswa/{id} | admin, guru_bk
    public function show($id)
    {
        AuthMiddleware::check();
        RoleMiddleware::allow(['admin', 'guru_bk']);

        $data = $this->siswa->getById($id);

        if (!$data) {
            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "Data siswa tidak ditemukan"
            ]);
            exit;
        }

        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
        exit;
    }

}