<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id_dokter'];
    $nama = $_POST['nama_dokter'];
    $poli = $_POST['poli'];
    $jadwal = $_POST['jadwal'];

    // Handle upload file foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpPath = $_FILES['foto']['tmp_name'];
        $fotoName = $_FILES['foto']['name'];
        $fotoSize = $_FILES['foto']['size'];
        $fotoType = $_FILES['foto']['type'];
        $fotoNameCmps = explode(".", $fotoName);
        $fotoExtension = strtolower(end($fotoNameCmps));
        $newFotoName = md5(time() . $fotoName) . '.' . $fotoExtension;
        $uploadFileDir = '../assets/img/';
        $dest_path = $uploadFileDir . $newFotoName;

        if (move_uploaded_file($fotoTmpPath, $dest_path)) {
            $foto = $newFotoName;
            // Update query untuk menyertakan foto
            $query = "UPDATE dokter SET nama_dokter='$nama', poli='$poli', jadwal='$jadwal', foto='$foto' WHERE id_dokter='$id'";
        } else {
            $response = array('success' => false, 'message' => 'Gagal mengunggah foto');
            echo json_encode($response);
            exit;
        }
    } else {
        // Update query tanpa foto
        $query = "UPDATE dokter SET nama_dokter='$nama', poli='$poli', jadwal='$jadwal' WHERE id_dokter='$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Gagal memperbarui data dokter di database');
    }

    echo json_encode($response);
} else {
    // Jika request method bukan POST
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
