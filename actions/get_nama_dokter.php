<?php
// Sertakan file koneksi.php untuk koneksi ke database
include "../includes/koneksi.php";

// Ambil ID dokter dari permintaan GET
if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Buat dan jalankan query SQL untuk mengambil informasi dokter
    $sql = "SELECT * FROM doctors WHERE id_dokter = $doctor_id";
    $result = $conn->query($sql);

    // Periksa apakah query berhasil dieksekusi
    if ($result->num_rows > 0) {
        // Ambil baris hasil sebagai array asosiatif
        $row = $result->fetch_assoc();

        // Keluarkan informasi dokter dalam format yang diinginkan
        echo "<h3>Informasi Dokter:</h3>";
        echo "<p>Nama: " . $row['nama_dokter'] . "</p>";
        echo "<p>Spesialisasi: " . $row['spesialisasi'] . "</p>";
        // Tambahkan informasi lainnya tentang dokter sesuai kebutuhan

    } else {
        echo "Informasi dokter tidak ditemukan.";
    }

} else {
    echo "ID dokter tidak diberikan.";
}

// Tutup koneksi ke database
$conn->close();
?>
