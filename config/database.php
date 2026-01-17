<?php

class Database
{
    private $host = "localhost";
    private $db_name = "si_pelanggaran_siswa";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo json_encode([
                "status" => "error",
                "pesan" => "Koneksi database gagal"
            ]);
            exit;
        }
    }
}
