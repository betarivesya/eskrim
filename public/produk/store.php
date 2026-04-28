<?php
session_start();

require_once '../../config/Database.php';
require_once '../../classes/Produk.php';

$db = new Database();
$conn = $db->getConnection();

$produk = new Produk($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $produk->store([
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'deskripsi' => $_POST['deskripsi']
    ]);

    if ($result) {
        $_SESSION['success'] = "Produk berhasil ditambahkan";
    } else {
        $_SESSION['error'] = "Gagal menambahkan produk";
    }

    // 🔥 INI YANG KAMU MAU
    header("Location: index.php"); 
    exit;
}
?>