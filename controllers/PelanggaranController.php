<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Pelanggaran.php';

class PelanggaranController
{
    private $pelanggaran;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->pelanggaran = new Pelanggaran($db);
    }

    /**
     * GET /pelanggaran
     */
    public function index()
    {

    requireLogin();

        $data = $this->pelanggaran->getAll();

        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
        exit;
    }

    //POST pelanggaran
    public function store()
    {

    requireLogin();

        $input = json_decode(file_get_contents("php://input"), true);

        // Validasi sederhana
        $required = ['siswa_id', 'guru_id', 'jenis_pelanggaran', 'poin', 'tanggal'];
        foreach ($required as $field) {
            if (!isset($input[$field])) {
                http_response_code(400);
                echo json_encode([
                    "status" => "error",
                    "pesan" => "Field {$field} wajib diisi"
                ]);
                exit;
            }
        }

        $result = $this->pelanggaran->create($input);

        if ($result) {
            echo json_encode([
                "status" => "success",
                "pesan" => "Data pelanggaran berhasil ditambahkan"
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "pesan" => "Gagal menambahkan data pelanggaran"
            ]);
        }
        exit;
    }
    
    //PUT /pelanggaran/{id}
    public function update($id)
{
    requireLogin(); 

    $input = json_decode(file_get_contents("php://input"), true);

    $required = ['siswa_id', 'guru_id', 'jenis_pelanggaran', 'poin', 'tanggal'];
    foreach ($required as $field) {
        if (!isset($input[$field])) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "pesan" => "Field {$field} wajib diisi"
            ]);
            exit;
        }
    }

    $result = $this->pelanggaran->update($id, $input);

    if ($result) {
        echo json_encode([
            "status" => "success",
            "pesan" => "Data pelanggaran berhasil diperbarui"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "pesan" => "Gagal memperbarui data pelanggaran"
        ]);
    }
    exit;
}

//DELETE /pelanggaran/{id}
public function destroy($id)
{
    requireLogin(); 

    $result = $this->pelanggaran->delete($id);

    if ($result) {
        echo json_encode([
            "status" => "success",
            "pesan" => "Data pelanggaran berhasil dihapus"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "pesan" => "Gagal menghapus data pelanggaran"
        ]);
    }
    exit;
}
}
