<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Cek apakah request method adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari request body
    $id_user = $_POST['id'];

    // Query untuk menghapus data dari database
    $query = "DELETE FROM user WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil
        echo json_encode(['success' => true]);
    } else {
        // Jika gagal
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
