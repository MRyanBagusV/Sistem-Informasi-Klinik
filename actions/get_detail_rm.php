<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Periksa apakah parameter id_pasien telah diterima dari permintaan GET
if(isset($_GET['id_pasien'])) {
    // Ambil id_pasien dari permintaan GET
    $id_pasien = $_GET['id_pasien'];

    // Query untuk mendapatkan detail rekam medis berdasarkan id_pasien
    $query = "SELECT rekammedis.id_pasien, rekammedis.No_RM, rekammedis.tgl_berobat, rekammedis.id_poli, pasien.nama_pasien, rekammedis.keluhan, rekammedis.diagnosa, rekammedis.tindakan, rekammedis.tensi_darah, rekammedis.tinggi_badan, rekammedis.berat_badan, rekammedis.suhu_tubuh, rekammedis.resep
              FROM rekammedis
              INNER JOIN pasien ON rekammedis.No_RM = pasien.No_RM
              WHERE rekammedis.id_pasien = '$id_pasien'";

    $result = mysqli_query($koneksi, $query);

    // Inisialisasi array untuk menyimpan data detail rekam medis
    $detail = array();

    // Periksa apakah ada hasil dari query
    if(mysqli_num_rows($result) > 0) {
        // Ambil data dan masukkan ke dalam array $detail
        $row = mysqli_fetch_assoc($result);
        $detail['id_pasien'] = $row['id_pasien'];
        $detail['No_RM'] = $row['No_RM'];
        $detail['tgl_berobat'] = $row['tgl_berobat'];
        $detail['id_poli'] = $row['id_poli'];
        $detail['nama_pasien'] = $row['nama_pasien'];
        $detail['keluhan'] = $row['keluhan'];
        $detail['diagnosa'] = $row['diagnosa'];
        $detail['tindakan'] = $row['tindakan'];
        $detail['tensi_darah'] = $row['tensi_darah'];
        $detail['tinggi_badan'] = $row['tinggi_badan'];
        $detail['berat_badan'] = $row['berat_badan'];
        $detail['suhu_tubuh'] = $row['suhu_tubuh'];
        $detail['resep'] = $row['resep'];
    }

    // Mengembalikan data detail rekam medis dalam format JSON
    echo json_encode($detail);
} else {
    // Jika id_pasien tidak diterima, kembalikan pesan kesalahan
    echo json_encode(array('error' => 'id_pasien tidak diterima.'));
}

mysqli_close($koneksi);
?>
