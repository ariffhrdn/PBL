<?php
// Sertakan file koneksi database
include 'db.php';

// Ambil ID pengguna (mahasiswa) dari session
session_start();
$mahasiswa_id = $_SESSION['user_id']; // Asumsi ID mahasiswa disimpan di session

// Query untuk mengambil laporan yang sudah diverifikasi oleh mahasiswa tertentu
$sql = "SELECT id, name, date, description, proof, status FROM laporan_pelanggaran WHERE status = 'verified' AND mahasiswa_id = ?";

$params = array($mahasiswa_id);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    http_response_code(500); // Set status HTTP ke 500 jika gagal
    die(json_encode(["error" => sqlsrv_errors()])); // Kembalikan error dalam format JSON
}

// Array untuk menyimpan data laporan
$reports = [];

// Loop melalui hasil query dan masukkan ke dalam array
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $reports[] = [
        'id' => $row['id'],
        'nama' => $row['name'],
        'tanggal_pelanggaran' => $row['date']->format('Y-m-d'),
        'deskripsi' => $row['description'],
        'bukti' => $row['proof'] ?? null,
    ];
}

// Tutup koneksi database
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Set response header untuk JSON
header('Content-Type: application/json');
echo json_encode($reports); // Kembalikan data laporan dalam format JSON
?>
