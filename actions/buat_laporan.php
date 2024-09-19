<?php
// Sertakan file koneksi.php jika diperlukan
include "../includes/koneksi.php";
// Sertakan PHPSpreadsheet library
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fungsi untuk membuat laporan Excel berdasarkan tanggal
function buatLaporanExcel($data) {
    // Buat objek Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Set judul kolom
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', 'Tanggal')
                ->setCellValue('C1', 'Pengeluaran')
                ->setCellValue('D1', 'Pemasukan')
                ->setCellValue('E1', 'Total')
                ->setCellValue('F1', 'Deskripsi');

    // Masukkan data ke dalam baris berikutnya
    $row = 2;
    foreach ($data as $item) {
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $item['id']);
        $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $item['tanggal']);
        $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $item['pengeluaran']);
        $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $item['pemasukan']);
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $item['total']);
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $item['deskripsi']);
        $row++;
    }

    // Set nama file
    $filename = "laporan_keuangan_" . date('YmdHis') . ".xlsx";

    // Simpan file Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    // Tampilkan atau unduh file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}

// Panggil fungsi untuk membuat laporan Excel jika tombol Excel diklik
if(isset($_POST['excel'])){
    // Ambil semua data laporan dari database
    $q = mysqli_query($koneksi,"SELECT * FROM laporan_harian ORDER BY tanggal ASC");

    // Buat array untuk menyimpan data berdasarkan tanggal
    $laporan = array();
    while ($dt = mysqli_fetch_array($q)) {
        $laporan[$dt['tanggal']][] = $dt;
    }

    // Buat laporan Excel untuk tanggal sekarang
    $tanggalSekarang = date('Y-m-d');
    if (isset($laporan[$tanggalSekarang])) {
        buatLaporanExcel($laporan[$tanggalSekarang]);
    } else {
        // Jika tidak ada data untuk tanggal sekarang, berikan pesan kesalahan atau tindakan lainnya
        echo "Tidak ada data untuk tanggal sekarang.";
    }
}
?>
