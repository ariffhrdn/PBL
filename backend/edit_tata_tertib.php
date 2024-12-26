<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi_pelanggaran'];
    $tingkat = $_POST['tingkat_pelanggaran'];

    $query = "UPDATE TataTertib SET deskripsi_pelanggaran = ?, tingkat_pelanggaran = ? WHERE id = ?";
    $params = array($deskripsi, $tingkat, $id);

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Terjadi kesalahan saat memperbarui data";
    }
}
?>


