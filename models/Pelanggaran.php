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
}