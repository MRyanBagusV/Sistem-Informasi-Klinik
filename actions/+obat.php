<?php
include "../includes/koneksi.php";

$nama_obat = $_POST['nama_obat'];
$jenis_obat = $_POST['jenis_obat'];
$harga_obat = $_POST['harga_obat'];
$stok_obat = $_POST['stok_obat'];

$sql = "INSERT INTO obat (nama_obat, jenis_obat, harga_obat, stok_obat) VALUES ('$nama_obat', '$jenis_obat', '$harga_obat', '$stok_obat')";

if ($koneksi->query($sql) === TRUE) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '../pages/obat_tindakan.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
