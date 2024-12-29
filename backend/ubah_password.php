<?php
header("Content-Type: application/json");
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $NIM = $data['NIM'];
    $newPassword = $data['newPassword'];

    // Periksa apakah email terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE NIM = ?");
    $stmt->bind_param("s", $NIM);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email ditemukan, ubah kata sandi
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE NIM = ?");
        $updateStmt->bind_param("ss", $hashedPassword, $NIM);

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
