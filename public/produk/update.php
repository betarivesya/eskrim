<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Produk.php';

$db = new Database();
$conn = $db->getConnection();

$produk = new Produk($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $result = $produk->update($id, $_POST);

    if ($result['status']) {
        // sukses
        $_SESSION['success'] = $result['message'];
    } else {
        // gagal
        $_SESSION['error'] = $result['message'];
    }

    header("Location: ../../dashboard.php?page=produk");
    exit;
}
?>