<?php
class Produk {
    private $conn;
    private $table = "produk";
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   public function store($data) {
    $stmt = $this->conn->prepare(
        "INSERT INTO produk (nama, harga, deskripsi) VALUES (?, ?, ?)"
    );
    return $stmt->execute([
        $data['nama'],
        $data['harga'],
        $data['deskripsi']
    ]);
}
    public function update($id, $data) {
    $stmt = $this->conn->prepare(
        "UPDATE produk SET nama=?, harga=?, deskripsi=? WHERE id=?"
    );
    return $stmt->execute([
        $data['nama'],
        $data['harga'],
        $data['deskripsi'],
        $id
    ]);
}
    public function getById($id) {
    $stmt = $this->conn->prepare(
        "SELECT * FROM produk WHERE id = ?"
    );
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM {$this->table} WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }
    public function getProdukById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>