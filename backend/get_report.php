<?php
// Sertakan file koneksi database
include 'db.php';

// Query untuk mengambil data laporan pelanggaran termasuk status
$sql = "SELECT TOP 5 id, NIM, name, date, description, proof, status FROM laporan_pelanggaran WHERE status = 'pending'";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    http_response_code(500); // Set status HTTP ke 500 jika gagal
    die(json_encode(["error" => sqlsrv_errors()])); // Kembalikan error dalam format JSON
}

// Array untuk menyimpan data laporan
$reports = [];

// Loop melalui hasil query dan masukkan ke dalam array
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $reports[] = [
        'NIM' => $row['NIM'],
        'id' => $row['id'],
        'nama' => $row['name'],
        'tanggal_pelanggaran' => $row['date']->format('Y-m-d'),
        'deskripsi' => $row['description'],
        'bukti' => $row['proof'] ?? null,
        'status' => $row['status'] ?? 'undefined', // Menambahkan status pada data laporan
    ];
}

// Tutup koneksi database
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Set response header untuk JSON
header('Content-Type: application/json');
echo json_encode($reports); // Kembalikan data laporan dalam format JSON
?>
