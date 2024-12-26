<?php
// Sertakan koneksi database
include 'db.php';

// Query untuk mengambil data tata tertib
$sql = "SELECT * FROM TataTertib"; // Sesuaikan dengan nama tabel Anda
$query = sqlsrv_query($conn, $sql);

$data = array();
while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

// Menutup koneksi
sqlsrv_close($conn);
?>
