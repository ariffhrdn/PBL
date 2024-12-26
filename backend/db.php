<?php
// Konfigurasi koneksi ke SQL Server
$host = "LAPTOP-VHERRFEN"; // Nama server dan instance SQL Server
$connInfo = array(
    "Database" => "PBLDB",  // Nama database
    "UID" => "", // Username SQL Server
    "PWD" => ""  // Password SQL Server
);

// Membuat koneksi ke SQL Server
$conn = sqlsrv_connect($host, $connInfo);

// Cek koneksi
if ($conn === false) {
    echo json_encode(["message" => "Koneksi ke database gagal!"]);
    die(print_r(sqlsrv_errors(), true));
}
?>