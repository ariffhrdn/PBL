<?php
header("Content-Type: application/json");
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $data['email'];
    $newPassword = $data['newPassword'];

    // Periksa apakah email terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email ditemukan, ubah kata sandi
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $updateStmt->bind_param("ss", $hashedPassword, $email);

        if ($updateStmt->execute()) {
            echo json_encode(["message" => "Kata sandi berhasil diperbarui."]);
        } else {
            echo json_encode(["message" => "Gagal memperbarui kata sandi."]);
        }

        $updateStmt->close();
    } else {
        echo json_encode(["message" => "Email tidak ditemukan."]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Metode HTTP tidak valid!"]);
}

$conn->close();
?>
