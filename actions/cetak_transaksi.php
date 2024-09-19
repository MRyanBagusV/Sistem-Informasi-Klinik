<?php
// Mulai output buffering
ob_start();

// Include library TCPDF
require_once('../tcpdf/tcpdf.php');

// Koneksi ke database
include "../includes/koneksi.php";

// Mendapatkan ID transaksi dari parameter URL (id_pasien)
if (isset($_GET['id_pasien'])) {
    $id_transaksi = $_GET['id_pasien'];

    // Query untuk mendapatkan detail transaksi berdasarkan ID transaksi
    $query = "SELECT t.id_transaksi, t.No_RM, t.nama_pasien, t.total_bayar, t.waktu_transaksi, 
                     SUM(CASE WHEN d.jenis_item = 'obat' THEN d.total ELSE 0 END) AS total_farmasi,
                     SUM(CASE WHEN d.jenis_item = 'tindakan' THEN d.total ELSE 0 END) AS total_tindakan
              FROM transaksi t
              LEFT JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
              WHERE t.id_transaksi = $id_transaksi
              GROUP BY t.id_transaksi";

    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Data yang akan ditampilkan di PDF
        $id_transaksi = $row['id_transaksi'];
        $no_rm = $row['No_RM'];
        $nama_pasien = $row['nama_pasien'];
        $total_bayar = $row['total_bayar'];
        $waktu_transaksi = $row['waktu_transaksi'];
        $total_farmasi = $row['total_farmasi'];
        $total_tindakan = $row['total_tindakan'];

        // Buat objek TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Klinik Atlantic');
        $pdf->SetTitle('Data Transaksi Pasien - Klinik Atlantic');
        $pdf->SetSubject('Data Transaksi Pasien');
        $pdf->SetKeywords('Data, Transaksi, Klinik, Atlantic');

        // Atur margin
        $pdf->SetMargins(10, 10, 10);

        // Tambah halaman
        $pdf->AddPage();

        // Judul dokumen
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'DATA TRANSAKSI PASIEN', 0, 1, 'C');

        // Tabel data transaksi
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'No Invoice: ' . $id_transaksi, 0, 1);
        $pdf->Cell(0, 10, 'Tanggal Transaksi: ' . $waktu_transaksi, 0, 1);
        $pdf->Cell(0, 10, 'No RM: ' . $no_rm, 0, 1);
        $pdf->Cell(0, 10, 'Nama Pasien: ' . $nama_pasien, 0, 1);
        $pdf->Cell(0, 10, 'Total Bayar: ' . $total_bayar, 0, 1);

        // Header tabel
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(30, 10, 'Farmasi', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tindakan', 1, 0, 'C');
        $pdf->Ln();

        // Isi tabel
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(30, 10, $total_farmasi, 1, 0, 'C');
        $pdf->Cell(30, 10, $total_tindakan, 1, 0, 'C');
        $pdf->Ln();

        // Output PDF ke browser atau simpan ke file
        $pdf->Output('transaksi_' . $id_transaksi . '.pdf', 'I');

        // Membersihkan output buffer
        ob_end_clean();
    } else {
        // Jika tidak ada data ditemukan
        echo "Data tidak ditemukan.";
    }
} else {
    // Jika parameter id_pasien tidak ada
    echo "Parameter tidak valid.";
}

// Akhiri output buffering dan kirimkan ke browser
ob_end_flush();
?>
