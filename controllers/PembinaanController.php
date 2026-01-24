<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/Pembinaan.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';


class PembinaanController {

    private $pembinaan;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->pembinaan = new Pembinaan($db);
    }

// GET /Pembinaan
    public function index()
    {
    AuthMiddleware::check();
    RoleMiddleware::allow(['admin', 'guru_bk']);

        $data = $this->pembinaan->getAll();

        echo json_encode([
            "status" => "succes",
            "data" => $data
        ]);
        exit;
    }

// POST /Pembinaan
    public function store() {

        AuthMiddleware::check();
        RoleMiddleware::allow(['guru_bk']);

        $input = json_decode(file_get_contents("php://input"), true);

        $required = ['pelanggaran_id', 'tindakan', 'tanggal'];
        foreach ($required as $field) {
            if (!isset($input[$field])) {
                http_response_code([
                    "status" => "error",
                    "meesage" => "Field {$field} wajib diisi!"
                ]);
                exit;
            }
        }

       $result = $this->pembinaan->create([
        'pelanggaran_id' => $input['pelanggaran_id'],
        'tindakan'       => $input['tindakan'],
        'keterangan'     => $input['keterangan'] ?? null,
        'tanggal'        => $input['tanggal']
       ]);

       if ($result) {
        echo json_encode([
            "status" => "success",
            "message" => "Data pembinaan berhasil ditambahkan"
        ]);
       } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Penambahan data gagal"
        ]);
       }
       exit;
    }

//PUT /pembinaa/{id}
    public function update($id) {
         AuthMiddleware::check();
        RoleMiddleware::allow(['guru_bk']);


        $input = json_decode(file_get_contents("php://input"), true);

        $required = ['pelanggaran_id', 'tindakan', 'tanggal'];
        foreach ($required as $field) {
            if(!isset($input[$field])) {
                http_response_code(400);
                echo json_encode([
                    "status" => "error",
                    "message" => "Field {$field} wajib diisi!"
                ]);
                exit;
            }
        }

    $result = $this->pembinaan->update($id, [
        'pelanggaran_id' => $input['pelanggaran_id'],
        'tindakan'       => $input['tindakan'],
        'keterangan'     => $input['keterangan'] ?? null,
        'tanggal'        => $input['tanggal']
    ]);

    if ($result) {
        echo json_encode([
            "status" => "succes",
            "message" => "Data pembinaan berhasil diupdate"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Gagal memperbarui data"
        ]);
    }
    exit;
    }

    //DELETE /pembinaan/{id}
    public function destroy($id) {

         AuthMiddleware::check();
        RoleMiddleware::allow(['guru_bk']);


        $result = $this->pembinaan->delete($id);

        if ($result) {
            echo json_encode([
                "status" => "success",
                "message" => "Data pembinaan berhasil dihapus"
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
            "status" => "error",
            "pesan" => "Gagal menghapus data pembinaan"
            ]);
        }
        exit;
    }
}