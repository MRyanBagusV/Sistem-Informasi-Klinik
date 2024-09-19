<?php
include "../includes/koneksi.php";

if (isset($_GET['id_dokter'])) {
    $id_dokter = $_GET['id_dokter'];

    $query = "SELECT * FROM dokter WHERE id_dokter = $id_dokter";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo '<h2>' . $row['nama_dokter'] . '</h2>';
        echo '<p><strong>Poli:</strong> ' . $row['poli'] . '</p>';
        echo '<p><strong>Jadwal:</strong> ' . $row['jadwal'] . '</p>';
        // Tambahkan detail lainnya jika perlu
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
