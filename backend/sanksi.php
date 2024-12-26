<?php
// Sertakan file konfigurasi
include('db.php');

// Query untuk mendapatkan data sanksi
$sql = "SELECT * FROM Sanksi"; // Ganti 'Sanksi' dengan nama tabel Anda
$stmt = sqlsrv_query($conn, $sql);

// Cek jika query berhasil
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Menyimpan data dalam array
$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

// Tutup koneksi
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
