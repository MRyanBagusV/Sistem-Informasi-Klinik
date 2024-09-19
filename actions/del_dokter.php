<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Cek apakah ada parameter id yang dikirim melalui GET
if (isset($_GET['id'])) {
    // Ambil id dokter dari parameter GET
    $id = $_GET['id'];

    // Query untuk mengambil informasi dokter termasuk nama file foto
    $querySelect = "SELECT foto FROM dokter WHERE id_dokter='$id'";
    $resultSelect = mysqli_query($koneksi, $querySelect);

    if ($resultSelect && mysqli_num_rows($resultSelect) > 0) {
        $dokter = mysqli_fetch_assoc($resultSelect);
        $foto = $dokter['foto'];

        // Query untuk menghapus dokter dari database
        $queryDelete = "DELETE FROM dokter WHERE id_dokter='$id'";
        if (mysqli_query($koneksi, $queryDelete)) {
            // Jika ada file foto, hapus file dari folder assets/img
            if ($foto && file_exists("../assets/img/$foto")) {
                unlink("../assets/img/$foto");
            }
            echo "<script>alert('Data berhasil dihapus'); window.location.href='../pages/data_dokter.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data dokter dari database'); window.location.href='../pages/data_dokter.php';</script>";
        }
    } else {
        echo "<script>alert('Dokter tidak ditemukan'); window.location.href='../pages/data_dokter.php';</script>";
    }
} else {
    echo "<script>alert('Parameter id tidak ditemukan'); window.location.href='../pages/data_dokter.php';</script>";
}
?>
