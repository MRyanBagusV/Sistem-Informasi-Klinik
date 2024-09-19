<?php
include "../includes/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tindakan = $_POST['id_tindakan'];
    $nama_tindakan = $_POST['nama_tindakan'];
    $harga_tindakan = $_POST['harga_tindakan'];

    $query = "UPDATE tindakan SET nama_tindakan = ?, harga_tindakan = ? WHERE id_tindakan = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('ssi', $nama_tindakan, $harga_tindakan, $id_tindakan);

    if ($stmt->execute()) {
        echo "<script>alert('Data tindakan berhasil diperbarui.'); window.location.href='../pages/obat_tindakan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data tindakan.'); window.history.back();</script>";
    }
    $stmt->close();
}
$koneksi->close();
?>
