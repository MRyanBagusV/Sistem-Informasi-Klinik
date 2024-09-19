<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Query untuk mengambil data dokter dari database
$query = "SELECT * FROM dokter";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/dokter.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <title>KLINIK ATLANTIC</title>
</head>
<body>
<header class="header">
    <nav class="navigation">
        <ul>
            <li class="dropdown">
                <a href="#" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span class="username"></span>
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-content">
                    <div class="user-details">
                        <i class="fas fa-user-circle"></i>
                        <span class="username"> Ripal</span>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

<div class="container">
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/img/logo.jpg" alt="Logo Klinik" textalign="center">
        </div>
        <div class="clinic-info">
            <h2>Klinik Atlantic</h2>
        </div>
        <div class="user-info">
            <p>Welcome, Admin</p>
        </div>
        <hr>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="pasien.php"><i class="fas fa-user"></i>Manajemen Pasien</a></li>
            <li><a href="rekammedis.php"><i class="fas fa-notes-medical"></i>Data Rekam Medis</a></li>
            <li class="active"><a href="dokter.php"><i class="fas fa-user-md"></i>Manajemen Dokter</a></li>
            <li class="has-submenu">
                <a href="#"><i class="fas fa-cash-register"></i>Transaksi Pasien</a>
                <ul class="submenu">
                    <li><a href="Kasir.php">Kasir Pembayaran</a></li>
                    <li><a href="transaksi.php">Data Transaksi</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#"><i class="fas fa-cogs"></i>Data Master</a>
                <ul class="submenu">
                    <li><a href="obat_tindakan.php">Obat & Tindakan</a></li>
                    <li><a href="data_dokter.php">Data Dokter</a></li>
                    <li><a href="user.php">Data User</a></li>
                </ul>
            </li>
        </ul>
        <div class="contact-info">
            <p>Klinikatlantic@gmail.com</p>
            <p>(+62) 811-921-718</p>
        </div>
    </aside>
    
    <div class="content">
    <?php
    // Buat array untuk menyimpan data dokter
    $doctors = [];

    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan data dokter ke array
        $doctors[] = $row;
        
        // Tampilkan kartu dokter
        echo '<div class="doctor-card">';
        echo '<img src="../assets/img/' . $row['foto'] . '" alt="' . $row['nama_dokter'] . '">';
        echo '<h2>' . $row['nama_dokter'] . '</h2>';
        echo '<p>' . $row['poli'] . '</p>';
        echo '<p>' . $row['jadwal'] . '</p>'; // Menambahkan kolom jadwal dokter
        echo '<button class="show-info-btn" data-doctor-id="' . $row['id_dokter'] . '">Tampilkan Informasi</button>';
        echo '</div>';
    }
    ?>
    </div>

    <!-- Modal untuk menampilkan informasi dokter -->
    <div id="doctorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="doctorInfo"></div>
        </div>
    </div>

    <script>
        // JavaScript untuk membuka dan menutup modal serta menampilkan detail dokter
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById("doctorModal");
            var span = document.getElementsByClassName("close")[0];
            var doctorInfo = document.getElementById("doctorInfo");
            
            // Ambil data dokter dari PHP dan simpan dalam variabel JavaScript
            var doctors = <?php echo json_encode($doctors); ?>;

            // Buka modal ketika tombol ditekan
            document.querySelectorAll('.show-info-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var doctorId = this.getAttribute('data-doctor-id');
                    
                    // Cari dokter berdasarkan ID
                    var doctor = doctors.find(doc => doc.id_dokter == doctorId);

                    // Tampilkan detail dalam modal
                    doctorInfo.innerHTML = `
                        <h2>${doctor.nama_dokter}</h2>
                        <p><strong>Poli:</strong> ${doctor.poli}</p>
                        <p><strong>Jadwal:</strong> ${doctor.jadwal}</p>
                        <p><strong>Alamat:</strong> ${doctor.alamat}</p>
                        <p><strong>No Telepon:</strong> ${doctor.foto}</p>
                    `;
                    modal.style.display = "block";
                });
            });

            // Tutup modal ketika tombol close ditekan
            span.onclick = function() {
                modal.style.display = "none";
            };

            // Tutup modal ketika pengguna mengklik di luar modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>
</div>
</body>
</html>
