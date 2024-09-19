<?php
include '../includes/koneksi.php';
include 'functions.php'; // Pastikan functions.php diganti dengan nama file yang sesuai

if (isset($_POST['submit'])) {
    $no_invoice = generateInvoiceNumber($koneksi); // Memanggil fungsi generateInvoiceNumber dengan menyertakan koneksi database
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $id_dokter = $_POST['id_dokter']; // Menambahkan id_dokter dari form
    $no_rm = $_POST['No_RM'];
    $nama_pasien = $_POST['nama_pasien'];
    $detail_pembayaran = $_POST['detail_pembayaran'];
    $total_pembayaran = $_POST['total_pembayaran'];
    $status = $_POST['status'];

    $query = "INSERT INTO transaksi (no_invoice, tgl_transaksi, No_RM, nama_pasien, detail_pembayaran, total_pembayaran, status, id_dokter) 
              VALUES ('$no_invoice', '$tgl_transaksi', '$no_rm', '$nama_pasien', '$detail_pembayaran', '$total_pembayaran', '$status', '$id_dokter')"; // Menambahkan id_dokter dan biaya ke dalam query

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script> alert('Data transaksi berhasil ditambahkan.'); window.location.href='../pages/kasir.php'</script>";
    } else {
        echo "<script> alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='../pages/kasir.php'</script>";
    }
}
?>
