<?php

class Siswa
{
    private $conn;
    private $table = "siswa";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT siswa_id, nis, nama, kelas FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT siswa_id, nis, nama, kelas FROM {$this->table} WHERE siswa_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
