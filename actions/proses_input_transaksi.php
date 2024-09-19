<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "klinik_atlantic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$No_RM = $_POST['No_RM'];
$nama_pasien = $_POST['nama_pasien'];
$items = json_decode($_POST['items'], true);
$total_bayar = $_POST['total'];

// Insert ke tabel transaksi
$sql_transaksi = "INSERT INTO transaksi (No_RM, nama_pasien, total_bayar, waktu_transaksi) VALUES ('$No_RM', '$nama_pasien', '$total_bayar', NOW())";
if ($conn->query($sql_transaksi) === TRUE) {
    $id_transaksi = $conn->insert_id;

    // Insert ke tabel detail_transaksi
    foreach ($items as $item) {
        $nama_item = $item['name'];
        $jenis_item = $item['type'];
        $jumlah = $item['quantity'];

        // Ambil harga_satuan dari tabel obat atau tindakan
        if ($jenis_item == 'obat') {
            $sql_harga = "SELECT harga_obat AS harga_satuan FROM obat WHERE nama_obat = '$nama_item'";
        } else {
            $sql_harga = "SELECT harga_tindakan AS harga_satuan FROM tindakan WHERE nama_tindakan = '$nama_item'";
        }

        $result_harga = $conn->query($sql_harga);
        if ($result_harga->num_rows > 0) {
            $row = $result_harga->fetch_assoc();
            $harga_satuan = $row['harga_satuan'];
            $total = $harga_satuan * $jumlah;

            $sql_detail = "INSERT INTO detail_transaksi (id_transaksi, nama_item, jenis_item, jumlah, harga_satuan, total) VALUES ('$id_transaksi', '$nama_item', '$jenis_item', '$jumlah', '$harga_satuan', '$total')";
            $conn->query($sql_detail);
        }
    }
    
    // Mengirimkan respon ke JavaScript untuk menampilkan alert
    echo "<script>alert('Pembayaran berhasil !!! Silahkan cetak Bukti Pembayaran'); window.location.href = '../pages/transaksi.php';</script>";
    exit();
} else {
    echo "Error: " . $sql_transaksi . "<br>" . $conn->error;
}

$conn->close();
?>
