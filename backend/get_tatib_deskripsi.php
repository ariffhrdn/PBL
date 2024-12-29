<?php
header("Content-Type: application/json");
require 'db.php'; // File konfigurasi database Anda

$query = "SELECT deskripsi_pelanggaran FROM TataTertib";
$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal mengambil data tata tertib.',
        'error' => sqlsrv_errors()
    ]);
    exit;
}

$TataTertib = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $TataTertib[] = $row['deskripsi_pelanggaran'];
}

echo json_encode([
    'status' => 'success',
    'data' => $TataTertib
]);

sqlsrv_close($conn);
?>
