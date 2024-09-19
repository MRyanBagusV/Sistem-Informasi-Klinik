<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "klinik_atlantic";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data yang dikirimkan dari permintaan POST
$itemName = $_POST['itemName'];
$quantity = $_POST['quantity'];

// Melakukan pembaruan stok obat di database
$sql = "UPDATE obat SET stok_obat = stok_obat - $quantity WHERE nama_obat = '$itemName'";

if ($conn->query($sql) === TRUE) {
    echo "Stok obat berhasil diperbarui";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi ke database
$conn->close();
?>
s