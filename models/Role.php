<?php
class Role {
    private $db;
    private $table = "roles";

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}