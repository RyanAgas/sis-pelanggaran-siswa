<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';

class LaporanController {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    //GET laporan/poin-siswa
    public function poinSiswa()
    {
        AuthMiddleware::check();
        RoleMiddleware::allow(['admin', 'kepala_sekolah']);

        $query = "
                SELECT 
                    siswa.siswa_id,
                    siswa.nama,
                    siswa.kelas,
                    SUM(pelanggaran.poin) AS total_poin
                FROM siswa
                JOIN pelanggaran ON pelanggaran.siswa_id = siswa.siswa_id
                GROUP BY siswa.siswa_id, siswa.nama, siswa.kelas
                ORDER BY total_poin DESC
                ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        echo json_encode([
            "status" => "success",
            "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ]);
        exit;
    }
}