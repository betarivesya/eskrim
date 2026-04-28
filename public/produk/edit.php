<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Produk.php';

$db = new Database();
$conn = $db->connect();

$produk = new Produk($conn);
$produk_data = $produk->getProdukById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="contents/produk/store.php">
    <input type="hidden" name="id" value="<?= $produk_data['id'] ?>">
    <input type="text" name="kode" placeholder="Kode Produk" required
    value="<?= $produk_data['kode_produk'] ?>">
    <input type="text" name="nama" placeholder="Nama Produk" required
    value="<?= $produk_data['nama_produk'] ?>">
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
</body>
</html>