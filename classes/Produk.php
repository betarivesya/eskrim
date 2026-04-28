<?php
class Produk {
    private $conn;
    private $table = "produk";
<<<<<<< HEAD
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
=======

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
>>>>>>> 6ed1d3b8554e2b296152e874803db7d56394a325
    }
}
?>