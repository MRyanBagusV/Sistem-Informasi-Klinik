<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "klinik_atlantic";

// Melakukan koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
    echo "Error: Tidak dapat terhubung ke database. " . mysqli_connect_error();
    exit; // Menghentikan eksekusi kode selanjutnya jika koneksi gagal
}

echo "";

?>
<?php
// Koneksi ke database
$host = 'localhost'; // Sesuaikan dengan host database Anda
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda
$database = 'klinik_atlantic'; // Sesuaikan dengan nama database Anda

$mysqli = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>

<?php
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);

	// sesuaikan dengan server anda
	$host 	= 'localhost'; // host server
	$user 	= 'root';  // username server
	$pass 	= ''; // password server, kalau pakai xampp kosongin saja
	$dbname = 'klinik_atlantic'; // nama database anda
	
	try{
		$config = new PDO("mysql:host=$host;dbname=$dbname;", $user,$pass);
		//echo 'sukses';
	}catch(PDOException $e){
		echo 'KONEKSI GAGAL' .$e -> getMessage();
	}
	
	$view = 'fungsi/view/view.php'; // direktori fungsi select data
?>

