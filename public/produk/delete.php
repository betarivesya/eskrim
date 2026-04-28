<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Produk.php';

$db = new Database();
$conn = $db->connect();

$produk = new Produk($conn);

$id = $_POST['id'];
$result = $produk->delete($id);

if ($result['status']) {
    echo $result['message'];
    $_SESSION['success'] = $result['message'];
} else {
    echo $result['message'];
    $_SESSION['error'] = $result['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script>
    $(document).on('click', '.btn-delete', function () {
    let id = $(this).data('id');

    if (confirm("Yakin ingin menghapus data ini?")) {
        $.ajax({
            url: 'contents/produk/delete.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                console.log(response);
                // $('#tableProduk').DataTable().ajax.reload();
                window.location.reload();
            }
        });
    }
});
</script>
</body>
</html>