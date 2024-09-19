<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_user = $_POST['id'];
    $nama_user = $_POST['username'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    // Proses upload foto (jika ada)
    $foto = ''; // Default kosong
    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "../assets/img"; // Direktori tempat menyimpan foto
        $foto = $uploadDir . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    // Query untuk update data di database
    $query = "UPDATE user SET username=?, alamat=?, role=?, foto=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama_user, $alamat, $role, $foto, $id_user);
    
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
