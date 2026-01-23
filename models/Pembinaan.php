<?php
class Pembinaan {
    private $db;
    private $table = "pembinaan";

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($id_pelanggaran, $keterangan) {
        $stmt = $this->db->prepare("INSERT INTO " . $this->table . " (id_pelanggaran, keterangan) VALUES (?, ?)");
        $stmt->bind_param("is", $id_pelanggaran, $keterangan);
        return $stmt->execute();
    }
}