<?php
// Sertakan file koneksi database
include 'db.php';

// Ambil data dari request (id dan status)
$id = $_POST['id'];
$status = $_POST['status'];

// Pastikan status yang diterima valid
if ($status !== 'verified' && $status !== 'rejected') {
    http_response_code(400); // Bad request
    die(json_encode(['error' => 'Status tidak valid']));
}

// Query untuk memperbarui status laporan
$sql = "UPDATE laporan_pelanggaran SET status = ? WHERE id = ?";
$params = [$status, $id];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    http_response_code(500); // Internal server error jika gagal
    die(json_encode(['error' => sqlsrv_errors()]));
}

// Kembalikan status sukses
echo json_encode(['message' => 'Status berhasil diperbarui']);
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
