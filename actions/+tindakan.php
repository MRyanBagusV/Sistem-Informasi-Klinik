<?php
include "../includes/koneksi.php";

$nama_tindakan = $_POST['nama_tindakan'];
$harga_tindakan= $_POST['harga_tindakan'];

$sql = "INSERT INTO tindakan (nama_tindakan, harga_tindakan) VALUES ('$nama_tindakan', '$harga_tindakan')";

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
