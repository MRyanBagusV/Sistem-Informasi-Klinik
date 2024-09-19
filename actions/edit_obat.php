<?php
include "../includes/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_obat = $_POST['id_obat'];
    $nama_obat = $_POST['nama_obat'];
    $jenis_obat = $_POST['jenis_obat'];
    $stok_obat = $_POST['stok_obat'];
    $harga_obat = $_POST['harga_obat'];

    $query = "UPDATE obat SET nama_obat = ?, jenis_obat = ?, stok_obat = ?, harga_obat = ? WHERE id_obat = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('ssiii', $nama_obat, $jenis_obat, $stok_obat, $harga_obat, $id_obat);

    if ($stmt->execute()) {
        echo "<script>alert('Data obat berhasil diperbarui.'); window.location.href='../pages/obat_tindakan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data obat.'); window.history.back();</script>";
    }
    $stmt->close();
}
$koneksi->close();
?>
