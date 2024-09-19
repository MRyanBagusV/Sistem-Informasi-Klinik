<?php
// Include library TCPDF
require_once('../tcpdf/tcpdf.php');

// Periksa apakah nomor invoice telah diberikan sebagai parameter
if (isset($_GET['no_invoice'])) {
    $no_invoice = $_GET['no_invoice'];

    // Koneksi ke database
    include "../includes/koneksi.php";

    // Query untuk mengambil data transaksi dari database berdasarkan nomor invoice
    $query = "SELECT t.*, p.tanggal_lahir, p.alamat_pasien, tgl_transaksi, d.nama_dokter, d.Poli FROM transaksi t
              LEFT JOIN pasien p ON t.No_RM = p.No_RM
              LEFT JOIN dokter d ON t.id_dokter = d.id_dokter
              WHERE t.no_invoice = '$no_invoice'"; // Filter berdasarkan nomor invoice
    $result = mysqli_query($koneksi, $query);

// Inisialisasi objek TCPDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Bukti Pembayaran');
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
$pdf->Image('../img/logo.jpg', 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

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
$pdf->Cell(0, 10, 'BUKTI PEMBAYARAN', 0, 1, 'C');
$pdf->Ln(5);

// Informasi Transaksi
while ($row = mysqli_fetch_array($result)) {
    $pdf->SetFont('helvetica', '', 10);
    
    // Buat tabel untuk menyusun informasi transaksi
    $pdf->SetFillColor(255, 255, 255); // Warna latar belakang sel
    $pdf->SetLineWidth(0); // Set ketebalan garis tabel menjadi 0

    // Tabel bagian kiri (No RM, Nama Pasien, Tanggal Lahir, Alamat Pasien)
    $pdf->Cell(90, 10, 'No RM: ' . $row['No_RM'], 0, 0, 'L', 1); // Merge kolom 1 dan 2
    $pdf->Cell(45, 10, '', 0, 0, 'L', 1); // Kolom kosong di tengah
    $pdf->Cell(45, 10, 'No Invoice: ' . $row['no_invoice'], 0, 1, 'L', 1);
    
    $pdf->Cell(90, 10, 'Nama Pasien: ' . $row['nama_pasien'], 0, 0, 'L', 1); // Merge kolom 1 dan 2
    $pdf->Cell(45, 10, '', 0, 0, 'L', 1); // Kolom kosong di tengah
    $pdf->Cell(45, 10, 'Tanggal: ' . $row['tgl_transaksi'], 0, 1, 'L', 1);
    
    $pdf->Cell(90, 10, 'Tanggal Lahir: ' . $row['tanggal_lahir'], 0, 0, 'L', 1); // Merge kolom 1 dan 2
    $pdf->Cell(45, 10, '', 0, 0, 'L', 1); // Kolom kosong di tengah
    $pdf->Cell(45, 10, 'Nama Dokter: ' . $row['nama_dokter'], 0, 1, 'L', 1);
    
    $pdf->Cell(90, 10, 'Alamat Pasien: ' . $row['alamat_pasien'], 0, 0, 'L', 1); // Merge kolom 1 dan 2
    $pdf->Cell(45, 10, '', 0, 0, 'L', 1); // Kolom kosong di tengah
    $pdf->Cell(45, 10, 'Poli: ' . $row['Poli'], 0, 1, 'L', 1);
    
    // Geser ke baris berikutnya dengan jarak 10
    $pdf->Ln(10);
}
// Garis horizontal di bawah header
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(5); // Tambahkan jarak vertikal setelah garis horizontal

// Judul Rincian Pembayaran
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 10, 'Rincian Pembayaran', 0, 1, 'C');

// Header Rincian Transaksi
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(30, 8, 'No', 1, 0, 'C', 1);
$pdf->Cell(90, 8, 'Detail', 1, 0, 'C', 1); // Lebar sel judul "Detail" diperbesar
$pdf->Cell(30, 8, 'Total Bayar', 1, 0, 'C', 1);
$pdf->Cell(30, 8, 'Status', 1, 1, 'C', 1);

// Isi Rincian Transaksi
$pdf->SetFont('helvetica', '', 10);
mysqli_data_seek($result, 0); // Kembali ke awal data hasil query
while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(30, 10, $row['no_invoice'], 1, 0, 'C'); // Menampilkan nomor invoice
    $pdf->Cell(90, 10, $row['detail_pembayaran'], 1, 0, 'L'); // Menampilkan detail pembayaran
    $pdf->Cell(30, 10, $row['total_pembayaran'], 1, 0, 'C'); // Menampilkan total pembayaran
    $pdf->Cell(30, 10, $row['status'], 1, 1, 'C'); // Menampilkan status pembayaran
}


    // Output dokumen PDF ke browser
    $pdf->Output('transaksi.pdf', 'I');
} else {
    // Jika nomor invoice tidak diberikan sebagai parameter, beri respon error
    echo "Nomor Invoice tidak ditemukan.";
}
?>