<?php
class Pembinaan {
    private $db;
    private $table = "pembinaan";

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
                  (pelanggaran_id, tindakan, keterangan, tanggal)
                  VALUES (:pelanggaran_id, :tindakan, :keterangan, :tanggal)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':pelanggaran_id' => $data['pelanggaran_id'],
            ':tindakan'       => $data['tindakan'],
            ':keterangan'     => $data['keterangan'] ?? null,
            ':tanggal'        => $data['tanggal']
        ]);
    }

//update
    public function update($id, $data) {
        $query = "UPDATE {$this->table}
                SET pelanggaran_id = :pelanggaran_id,
                tindakan = :tindakan,
                keterangan = :keterangan,
                tanggal = :tanggal
                WHERE pembinaan_id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':pelanggaran_id' => $data['pelanggaran_id'],
            ':tindakan'      => $data['tindakan'],
            ':keterangan'    => $data['keterangan'],
            ':tanggal'       => $data['tanggal'],
            ':id'            => $id
        ]);
    }

//delete
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE pembinaan_id = :id";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}