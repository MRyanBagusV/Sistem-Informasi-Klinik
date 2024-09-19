<?php
include "../includes/koneksi.php";

$type = $_GET['type'];
$id = $_GET['id'];

if ($type == 'tindakan') {
    $query = "DELETE FROM tindakan WHERE id_tindakan = '$id'";
} elseif ($type == 'obat') {
    $query = "DELETE FROM obat WHERE id_obat = '$id'";
}

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data berhasil dihapus');window.location.href=document.referrer;</script>";
} else {
    echo "<script>alert('Data gagal dihapus');window.location.href=document.referrer;</script>";
}

mysqli_close($koneksi);
?>
