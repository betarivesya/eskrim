<?php

class Produk {
    private $conn;
    private $table = "produk";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ
    public function getAll() {
        return $this->conn->query("SELECT * FROM {$this->table}");
    }

    // CREATE
    public function store($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (nama, harga, deskripsi) VALUES (?, ?, ?)"
        );
        $stmt->bind_param(
            "sis",
            $data['nama'],
            $data['harga'],
            $data['deskripsi']
        );
        return $stmt->execute();
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table} SET nama=?, harga=?, deskripsi=? WHERE id=?"
        );
        $stmt->bind_param(
            "sisi",
            $data['nama'],
            $data['harga'],
            $data['deskripsi'],
            $id
        );
        return $stmt->execute();
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM {$this->table} WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // GET BY ID
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function getProdukById($id) {
    $stmt = $this->conn->prepare(
        "SELECT * FROM produk WHERE id = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}
}