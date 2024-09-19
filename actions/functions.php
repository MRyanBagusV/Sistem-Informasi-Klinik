<?php
// functions.php

// Fungsi untuk menghasilkan nomor invoice baru
function generateInvoiceNumber() {
    // Anda dapat menyesuaikan format nomor invoice sesuai kebutuhan
    // Misalnya, nomor invoice dapat terdiri dari kombinasi tanggal dan nomor unik
    // Contoh: INV-YYYYMMDD-XXXX
    // YYYYMMDD adalah format tanggal (tahun, bulan, dan hari)
    // XXXX adalah nomor unik, misalnya dihasilkan dari penghitungan jumlah transaksi pada hari itu

    // Format tanggal saat ini (misalnya: 20220315)
    $date = date("Ymd");

    // Mendapatkan jumlah transaksi pada hari ini dari database
    // Anda perlu menyesuaikan query ini dengan struktur tabel transaksi Anda
    global $koneksi;
    $query = "SELECT COUNT(*) AS total FROM transaksi WHERE DATE(tgl_transaksi) = CURDATE()";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];

    // Menambahkan nol di depan nomor unik jika jumlah transaksi kurang dari 1000
    $countFormatted = str_pad($count, 4, "0", STR_PAD_LEFT);

    // Menggabungkan format tanggal dan nomor unik untuk membuat nomor invoice
    $invoiceNumber = "INV-" . $date . "-" . $countFormatted;

    return $invoiceNumber;
}
?>
