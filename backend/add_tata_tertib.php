<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deskripsi = $_POST['deskripsi_pelanggaran'];
    $tingkat = $_POST['tingkat_pelanggaran'];

    $query = "INSERT INTO TataTertib (deskripsi_pelanggaran, tingkat_pelanggaran) VALUES (?, ?)";
    $params = array($deskripsi, $tingkat);
    
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Terjadi kesalahan saat menambah data";
    }
}
?>
