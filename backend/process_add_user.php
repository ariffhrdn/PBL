<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['NIM'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi input
    if (empty($email) || empty($password) || empty($role)) {
        die("Semua field harus diisi!");
    }

    // Hash password sebelum menyimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menambahkan pengguna baru
    $query = "INSERT INTO users (NIM, password, role) VALUES (?, ?, ?)";
    $params = array($email, $hashedPassword, $role);

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo "<script>alert('Pengguna berhasil ditambahkan!'); window.location.href='admin_add_user.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pengguna: " . print_r(sqlsrv_errors(), true) . "'); window.location.href='admin_add_user.php';</script>";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    header("Location: admin_add_user.php");
    exit();
}
?>
