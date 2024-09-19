<?php

include '../includes/koneksi.php';

if (isset($_POST['submit'])) {
    $id= $_POST['No_RM'];
    $nama=$_POST['nama_pasien'];
    $jk=$_POST['jenis_kelamin'];
    $ttl=$_POST['Tanggal_lahir'];
    $jp=$_POST['jenis_pasien'];
    $adrs=$_POST['alamat_pasien'];
    $tlp=$_POST['no_telp'];

    $q = mysqli_query($koneksi, "INSERT INTO pasien (No_RM, nama_pasien, jenis_kelamin, Tanggal_lahir, jenis_pasien, alamat_pasien, no_telp) VALUES ('$id', '$nama', '$jk', '$ttl', '$jp', '$adrs', '$tlp')");

    if ($q) {
        echo "<script> alert('data pasien berhasil ditambahkan'); window.location.href='../pages/pasien.php'</script>";
    } else {
        echo "<script> alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='../pages/pasien.php'</script>";
    }
}    
?>
