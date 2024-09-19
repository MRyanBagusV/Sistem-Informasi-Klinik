<?php
include "../includes/koneksi.php";

if(isset($_POST['submit'])) {
    // Ambil nilai inputan dari form
    $id_pasien = $_POST['id_pasien'];
    $No_RM = $_POST['No_RM'];
    $tgl_berobat = $_POST['tgl_berobat'];
    $id_poli = $_POST['id_poli'];
    $tensi_darah = $_POST['tensi_darah'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $berat_badan = $_POST['berat_badan'];
    $suhu_tubuh = $_POST['suhu_tubuh'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $obt = $_POST['resep'];
    // Query SQL untuk menambahkan data rekam medis baru
    $query = "INSERT INTO rekammedis (id_pasien, No_RM, tgl_berobat, id_poli, tensi_darah, tinggi_badan, berat_badan, suhu_tubuh, keluhan, diagnosa, tindakan, resep) VALUES ('$id_pasien','$No_RM', '$tgl_berobat', '$id_poli', '$tensi_darah', '$tinggi_badan', '$berat_badan', '$suhu_tubuh', '$keluhan', '$diagnosa', '$tindakan', '$obt')";

    // Eksekusi query
    if(mysqli_query($koneksi, $query)) {
        // Jika data berhasil ditambahkan, redirect ke halaman rekammedis.php
        header("Location: rekammedis.php");
        exit;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>
