<?php

class Pelanggaran {
    private $table = "pelanggaran";
    private $conn;

    public $id;
    public $siswa_id;
    public $jenis_pelanggaran;
    public $poin;
    public $tanggal;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll()
{
    $query = "SELECT * FROM {$this->table}";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function create($data)
{
    $query = "INSERT INTO {$this->table}
              (siswa_id, guru_id, jenis_pelanggaran, poin, tanggal)
              VALUES (:siswa_id, :guru_id, :jenis_pelanggaran, :poin, :tanggal)";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ':siswa_id' => $data['siswa_id'],
        ':guru_id' => $data['guru_id'],
        ':jenis_pelanggaran' => $data['jenis_pelanggaran'],
        ':poin' => $data['poin'],
        ':tanggal' => $data['tanggal']
    ]);
}

public function update($id, $data)
{
    $query = "UPDATE {$this->table}
              SET siswa_id = :siswa_id,
                  guru_id = :guru_id,
                  jenis_pelanggaran = :jenis_pelanggaran,
                  poin = :poin,
                  tanggal = :tanggal
              WHERE pelanggaran_id = :id";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ':siswa_id' => $data['siswa_id'],
        ':guru_id' => $data['guru_id'],
        ':jenis_pelanggaran' => $data['jenis_pelanggaran'],
        ':poin' => $data['poin'],
        ':tanggal' => $data['tanggal'],
        ':id' => $id
    ]);
}

public function delete($id)
{
    $query = "DELETE FROM {$this->table} WHERE pelanggaran_id = :id";
    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ':id' => $id
    ]);
}

}