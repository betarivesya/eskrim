<?php
class Produk {
    private $conn;
    private $table = "produk";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ
    public function getAll() {
        return $this->conn->query("SELECT * FROM $this->table");
    }

    // CREATE
    public function store($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO $this->table(kode_produk,nama_produk) VALUES (?,?)");
        $stmt->bind_param("ss", $data['kode'], $data['nama']);
        return $stmt->execute();
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE $this->table SET kode_produk=?, nama_produk=? WHERE id=?");
        $stmt->bind_param("ssi", $data['kode'], $data['nama'], $id);
        return $stmt->execute();
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>