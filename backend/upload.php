<?php
// Konfigurasi database
$serverName = "LAPTOP-VHERRFEN"; // Ganti dengan nama server Anda
$database = "PBLDB"; // Ganti dengan nama database Anda
$connectionInfo = array("Database" => $database);
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Validasi bahwa deskripsi ada di tabel tata_tertib
$checkQuery = "SELECT deskripsi_pelanggaran FROM TataTertib WHERE deskripsi_pelanggaran = ?";
$checkStmt = sqlsrv_query($conn, $checkQuery, array($description));

if ($checkStmt === false || sqlsrv_fetch_array($checkStmt) === null) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Deskripsi pelanggaran tidak valid.'
    ]);
    exit;
}

// Periksa koneksi
if ($conn === false) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal terhubung ke database.',
        'error' => sqlsrv_errors()
    ]);
    exit;
}

// Periksa apakah formulir dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari formulir
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Proses file yang diunggah
    if (isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['proof']['tmp_name'];
        $fileName = uniqid() . "_" . $_FILES['proof']['name']; // Tambahkan prefix unik untuk nama file
        $uploadDir = '../uploads/';
        $destinationFilePath = $uploadDir . $fileName;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
            // Simpan data ke database
            $query = "INSERT INTO laporan_pelanggaran (name, date, description, proof) 
                      VALUES (?, ?, ?, ?)";
            $params = array($name, $date, $description, $fileName);

            $stmt = sqlsrv_query($conn, $query, $params);

            if ($stmt) {
                // Kembalikan respons sukses dalam format JSON
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Laporan berhasil disimpan!',
                    'data' => [
                        'name' => $name,
                        'date' => $date,
                        'description' => $description,
                        'proof' => $fileName
                    ]
                ]);
            } else {
                // Kembalikan respons error saat gagal menyimpan data
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data ke database.',
                    'error' => sqlsrv_errors()
                ]);
            }
        } else {
            // Kembalikan respons error saat gagal mengunggah file
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal mengunggah file.'
            ]);
        }
    } else {
        // Kembalikan respons error jika file tidak valid
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'File tidak valid atau terjadi kesalahan saat mengunggah.'
        ]);
    }
} else {
    // Kembalikan respons error untuk metode selain POST
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode pengiriman tidak valid.'
    ]);
}

// Tutup koneksi database
sqlsrv_close($conn);
?>
