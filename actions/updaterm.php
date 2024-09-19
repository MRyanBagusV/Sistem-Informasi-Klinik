<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Inisialisasi variabel untuk menyimpan pesan respons
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form edit RM
    $id_pasien = $_POST['id_pasien_edit'];
    $No_RM = $_POST['No_RM_edit'];
    $tgl_berobat = $_POST['tgl_berobat_edit'];
    $id_poli = $_POST['id_poli_edit'];
    $tensi_darah = $_POST['tensi_darah_edit'];
    $tinggi_badan = $_POST['tinggi_badan_edit'];
    $berat_badan = $_POST['berat_badan_edit'];
    $suhu_tubuh = $_POST['suhu_tubuh_edit'];
    $keluhan = $_POST['keluhan_edit'];
    $diagnosa = $_POST['diagnosa_edit'];
    $tindakan = $_POST['tindakan_edit'];
    $resep = $_POST['resep_edit']; // Sesuaikan dengan name di form HTML

    // Query untuk melakukan update data rekam medis berdasarkan id_pasien
    $query = "UPDATE rekammedis 
              SET No_RM = '$No_RM', 
                  tgl_berobat = '$tgl_berobat', 
                  id_poli = '$id_poli', 
                  keluhan = '$keluhan', 
                  diagnosa = '$diagnosa', 
                  tindakan = '$tindakan', 
                  tensi_darah = '$tensi_darah', 
                  tinggi_badan = '$tinggi_badan', 
                  berat_badan = '$berat_badan', 
                  suhu_tubuh = '$suhu_tubuh', 
                  resep = '$resep'
              WHERE id_pasien = '$id_pasien'";

    if (mysqli_query($koneksi, $query)) {
        // Jika update berhasil, siapkan respons
        $response['success'] = true;
        $response['message'] = "Data rekam medis berhasil diperbarui.";
    } else {
        // Jika query gagal dijalankan
        $response['success'] = false;
        $response['message'] = "Gagal memperbarui data rekam medis: " . mysqli_error($koneksi);
    }
} else {
    // Jika bukan request POST
    $response['success'] = false;
    $response['message'] = "Metode request tidak diizinkan.";
}

// Menutup koneksi database
mysqli_close($koneksi);

// Mengembalikan respons dalam format JSON
echo json_encode($response);

// Setelah mengirimkan respons, redirect ke halaman rekammedis.php
header("Location: ../pages/rekammedis.php");
exit();
?>
