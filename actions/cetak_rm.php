<?php
ob_start(); // Mulai penangkapan output

// Include library TCPDF
require_once('../tcpdf/tcpdf.php');

// Periksa apakah id_pasien telah diberikan sebagai parameter GET
if (isset($_GET['id_pasien'])) {
    $id_pasien = $_GET['id_pasien'];

    // Koneksi ke database
    include "../includes/koneksi.php";

    // Query untuk mengambil data rekam medis dari database berdasarkan id_pasien
    $query = "SELECT r.*, p.nama_pasien, p.tanggal_lahir, p.alamat_pasien, p.no_telp 
              FROM rekammedis r
              LEFT JOIN pasien p ON r.No_RM = p.No_RM
              WHERE r.id_pasien = '$id_pasien'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Inisialisasi objek TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Rekam Medis');
        $pdf->SetHeaderData('', 0, '', '');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        // Logo Klinik
        $pdf->Image('../assets/img/logo.jpg', 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Header Klinik
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetFillColor(255, 255, 255); // Warna latar belakang header
        $pdf->Cell(0, 10, 'KLINIK UTAMA ATLANTIC', 0, 1, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, 'Jl. Raya Mangga Besar No. 14 20A RT/RW 014/009, Maphar, Jakarta Barat ', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Email: Klinikatlantic@gmail.com Telepon: (+62) 811-921-718', 0, 1, 'C');
        $pdf->Ln(5);

        // Garis horizontal di bawah header
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Judul
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'REKAM MEDIS PASIEN', 0, 1, 'C');
        $pdf->Ln(5);

        // Informasi Pasien
        while ($row = mysqli_fetch_array($result)) {
            $pdf->SetFont('helvetica', '', 10);
            
            // Tampilkan informasi pasien
            $pdf->Cell(0, 10, 'No RM : ' . $row['No_RM'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Nama Pasien : ' . $row['nama_pasien'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Tanggal Lahir : ' . $row['tanggal_lahir'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Alamat : ' . $row['alamat_pasien'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'No Telepon : ' . $row['no_telp'], 0, 1, 'L');
            
            $pdf->Ln(10); // Jarak antar informasi

            // Tabel Hasil Pemeriksaan
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(30, 8, 'Tanggal', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Pemeriksaan', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Keluhan', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Diagnosa', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Tindakan', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Terapi', 1, 1, 'C', 1);

            // Isi Tabel
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(30, 6, $row['tgl_berobat'], 1, 0, 'C');
            $pemeriksaan = 'TD: ' . $row['tensi_darah'] . ' BB: ' . $row['berat_badan'] . ' TB: ' . $row['tinggi_badan'] . ' Temp: ' . $row['suhu_tubuh'];
            $pdf->MultiCell(30, 6, $pemeriksaan, 1, 'C', 0);
            $pdf->MultiCell(30, 6, $row['keluhan'], 1, 'C', 0);
            $pdf->MultiCell(30, 6, $row['diagnosa'], 1, 'C', 0);
            $pdf->MultiCell(30, 6, $row['tindakan'], 1, 'C', 0);
            $pdf->MultiCell(30, 6, $row['resep'], 1, 'C', 0);

            // Jarak antar hasil pemeriksaan
            $pdf->Ln(5); 
        }

        // Tutup koneksi database
        mysqli_close($koneksi);

        ob_end_clean(); // Bersihkan output buffer sebelumnya
        // Output dokumen PDF ke browser
        $pdf->Output('rekammedis.pdf', 'I');
    } else {
        // Jika tidak ada data ditemukan
        echo "Data rekam medis tidak ditemukan.";
    }

} else {
    // Jika id_pasien tidak diberikan sebagai parameter GET
    echo "ID pasien tidak ditemukan.";
}
?>

