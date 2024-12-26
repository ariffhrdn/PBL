<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $query = "DELETE FROM TataTertib WHERE id = ?";
    $params = array($id);

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo "Data berhasil dihapus";
    } else {
        echo "Terjadi kesalahan saat menghapus data";
    }
}
?>
