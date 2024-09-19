<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_user = $_POST['username'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Proses upload foto (jika ada)
    $foto = ''; // Default kosong
    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "../assets/img/"; // Direktori tempat menyimpan foto, tambahkan slash di akhir
        $foto = $uploadDir . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO user (username, alamat, role, password, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $nama_user, $alamat, $role, $hashed_password, $foto);
    
    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil
        echo json_encode(['success' => true]);
    } else {
        // Jika gagal
        echo json_encode(['success' => false]);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
