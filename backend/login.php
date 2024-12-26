<?php

session_start(); // Memulai session untuk melacak status login
header("Content-Type: application/json");
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Cek metode HTTP
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["message" => "Metode HTTP tidak valid!"]);
    exit;
}

// Validasi input JSON
if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["message" => "Email dan password diperlukan!"]);
    exit;
}

$email = $data['email'];
$password = $data['password'];

// Query untuk memeriksa email di database
$query = "SELECT * FROM users WHERE email = ?";
$params = array($email);
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    echo json_encode(["message" => "Kesalahan query", "error" => sqlsrv_errors()]);
    exit;
}

// Periksa apakah email ditemukan
if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Menyimpan session login dan role pengguna
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $row['role'];
        
        echo json_encode([
            "message" => "Login berhasil!",
            "role" => $row['role']
        ]);
    } else {
        // Jika kata sandi salah
        echo json_encode(["message" => "Kata sandi salah!"]);
    }
} else {
    // Jika email tidak ditemukan
    echo json_encode(["message" => "Email tidak ditemukan!"]);
}

// Menutup statement dan koneksi
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
