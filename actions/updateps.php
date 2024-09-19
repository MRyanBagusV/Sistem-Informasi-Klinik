<?php

include '../includes/koneksi.php';

    $id= $_POST['No_RM'];
    $nama=$_POST['nama_pasien'];
    $jk=$_POST['jenis_kelamin'];
    $ttl=$_POST['Tanggal_lahir'];
    $jp=$_POST['jenis_pasien'];
    $tlp=$_POST['no_telp'];
    $adrs=$_POST['alamat_pasien'];

    $query="UPDATE pasien SET nama_pasien='$nama', jenis_kelamin='$jk', Tanggal_lahir='$ttl', jenis_pasien='$jp', no_telp='$tlp', alamat_pasien='$adrs' where No_RM='$id'";
    mysqli_query($koneksi, $query);

    if ($query){
        echo "<script> alert('data pasien berhasil di update');
        window.location.href='../pages/pasien.php'</script>";
    }
    else {
        echo "<script> alert('data pasien gagal di update');
        window.location.href='../includes/pasien.php'</script>";
    }
?>
