<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pasien.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <title>KLINIK ATLANTIC - Manajemen Rekam Medis</title>
    <style>
    /* Gaya untuk submenu */
        .submenu {
            display: none; /* Submenu defaultnya disembunyikan */
        }

        /* Menampilkan submenu saat "Kasir Pembayaran" diklik */
        .has-submenu:hover .submenu {
            display: block;
            margin-left:10px;
        }
        .submenu li a:hover {
            text-decoration: underline;
        }
        /* Gaya tanda panah untuk submenu */
        .has-submenu > a i {
            margin-left: 5px; /* Jarak antara teks dengan tanda panah */
        }

    </style>
</head>
<body>
<header class="header">
    <nav class="navigation">
        <ul>
            <li class="dropdown">
                <a href="#" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span class="username">Ripal</span>
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-content">
                    <div class="user-details">
                        <i class="fas fa-user-circle"></i>
                        <span class="username">Ripal</span>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

<div class="container">
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/img/logo.jpg" alt="Logo Klinik" style="text-align: center;">
        </div>
        <div class="clinic-info">
            <h2>Klinik Atlantic</h2>
        </div>
        <div class="user-info">
            <p>Welcome, Admin</p>
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="pasien.php"><i class="fas fa-user"></i>Manajemen Pasien</a></li>
            <li class="active"><a href="rekammedis.php"><i class="fas fa-notes-medical"></i>Data Rekam Medis</a></li>
            <li><a href="dokter.php"><i class="fas fa-user-md"></i>Manajemen Dokter</a></li>
            <li class="has-submenu">
                <a href="#"><i class="fas fa-cash-register"></i>Transaksi Pasien</a>
                <ul class="submenu">
                    <li><a href="Kasir.php">Kasir Pembayaran</a></li>
                    <li><a href="user.php">Data Transaksi</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#"><i class="fas fa-cogs"></i>Data Master</a>
                <ul class="submenu">
                    <li><a href="obat_tindakan.php">Obat & Tindakan</a></li>
                    <li><a href="data_dokter.php">Data Dokter</a></li>
                    <li><a href="transaksi.php">Data User</a></li>
                </ul>
            </li>
        </ul>
        <div class="contact-info">
            <p>Klinikatlantic@gmail.com</p>
            <p>(+62) 811-921-718</p>
        </div>
    </aside>

    <div class="content">
        <h2 class="subtitle">KELOLA DATA REKAM MEDIS</h2>
        <div class="actions">
        <form align="right" class="search-form" onsubmit="searchRekammedis(event)">
            <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama obat..." />
            <button type="submit">Cari</button>
        </form>
                <a href="javascript:void(0)" onclick="openForm()"><i class="fas fa-notes-medical"></i>Tambah Rekam Medis</a>
            </form>
        </div>
        <div class="table-container">
            <!-- Tabel untuk menampilkan data rekam medis -->
            <table cellspacing="1" cellpadding="4" >
                <thead>
                    <tr>
                        <th>No RM</th>
                        <th>Tanggal Berobat</th>
                        <th>Poli Kunjungan</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include "../includes/koneksi.php";

                $query = "SELECT rekammedis.No_RM, rekammedis.tgl_berobat, rekammedis.id_poli, pasien.nama_pasien, rekammedis.keluhan, rekammedis.diagnosa, rekammedis.tindakan, rekammedis.id_pasien
                FROM rekammedis
                INNER JOIN pasien ON rekammedis.No_RM = pasien.No_RM";

                $result = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1; // Variabel untuk nomor urut
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["No_RM"] . "</td>";
                        echo "<td>" . $row["tgl_berobat"] . "</td>";
                        echo "<td>" . $row["id_poli"] . "</td>";
                        echo "<td>" . $row["nama_pasien"] . "</td>";
                        echo "<td>" . $row["keluhan"] . "</td>";
                        echo "<td>" . $row["diagnosa"] . "</td>";
                        echo "<td><a href='#' onclick=\"openEditForm('" . $row["id_pasien"] . "')\"><i class='fas fa-edit'></i></a></td>";
                        echo "<td><button onclick=\"openDetailPopup('" . $row["id_pasien"] . "')\"><i class='fas fa-info-circle'></i></button></td>";       
                        echo "<td><a href='../actions/cetak_rm.php?id_pasien=" . $row['id_pasien'] . "' target='_blank'><i class='fas fa-file-pdf'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Tidak ada data rekam medis.</td></tr>";
                }

                mysqli_close($koneksi);
                ?>
            </tbody>

            </table>      
        </div>
    </div>
</div>

<!-- Pop-up Form Tambah Rekam Medis -->
<div class="popup-overlay" id="popup-overlay">
    <div class="popup-form" id="popup-form">
        <span class="close-btn" onclick="closeForm()">&times;</span>
        <h2>Tambah Rekam Medis</h2>
        <form action="../actions/+rekammedis.php" method="POST">
            <div class="form-group">
                <label for="No_RM">No RM</label>
                <input type="text" id="No_RM" name="No_RM" required>
            </div>
            <div class="form-group">
                <label for="tgl_berobat">Tanggal Berobat</label>
                <input type="date" id="tgl_berobat" name="tgl_berobat" required>
            </div>
            <div class="form-group">
                <label for="id_poli">ID Poli</label>
                <input type="text" id="id_poli" name="id_poli" required>
            </div>
            <div class="form-group">
                <label for="tensi_darah">Tensi Darah</label>
                <input type="text" id="tensi_darah" name="tensi_darah" required>
            </div>
            <div class="form-group">
                <label for="tinggi_badan">Tinggi Badan</label>
                <input type="text" id="tinggi_badan" name="tinggi_badan" required>
            </div>
            <div class="form-group">
                <label for="berat_badan">Berat Badan</label>
                <input type="text" id="berat_badan" name="berat_badan" required>
            </div>
            <div class="form-group">
                <label for="suhu_tubuh">Suhu Tubuh</label>
                <input type="text" id="suhu_tubuh" name="suhu_tubuh" required>
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan</label>
                <textarea id="keluhan" name="keluhan" required></textarea>
            </div>
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <input type="text" id="diagnosa" name="diagnosa" required>
            </div>
            <div class="form-group">
                <label for="tindakan">Tindakan</label>
                <input type="text" id="tindakan" name="tindakan" required>
            </div>
            <div class="form-group">
                <label for="resep">Resep</label>
                <input type="text" id="resep" name="resep" required>
            </div>
            <button type="submit">Tambah</button>
        </form>
    </div>
</div>

<!-- Pop-up Form Edit Rekam Medis -->
<div class="popup-overlay" id="popup-overlay-edit">
    <div class="popup-form" id="popup-form-edit">
        <span class="close-btn" onclick="closeEditForm()">&times;</span>
        <h2>Edit Rekam Medis</h2>
        <form id="editForm" action="../actions/updaterm.php" method="POST">
            <input type="hidden" id="id_pasien_edit" name="id_pasien_edit">
            <div class="form-group">
                <label for="No_RM_edit">No RM</label>
                <input type="text" id="No_RM_edit" name="No_RM_edit" required>
            </div>
            <div class="form-group">
                <label for="tgl_berobat_edit">Tanggal Berobat</label>
                <input type="date" id="tgl_berobat_edit" name="tgl_berobat_edit" required>
            </div>
            <div class="form-group">
                <label for="id_poli_edit">ID Poli</label>
                <input type="text" id="id_poli_edit" name="id_poli_edit" required>
            </div>
            <div class="form-group">
                <label for="tensi_darah_edit">Tensi Darah</label>
                <input type="text" id="tensi_darah_edit" name="tensi_darah_edit" required>
            </div>
            <div class="form-group">
                <label for="tinggi_badan_edit">Tinggi Badan</label>
                <input type="text" id="tinggi_badan_edit" name="tinggi_badan_edit" required>
            </div>
            <div class="form-group">
                <label for="berat_badan_edit">Berat Badan</label>
                <input type="text" id="berat_badan_edit" name="berat_badan_edit" required>
            </div>
            <div class="form-group">
                <label for="suhu_tubuh_edit">Suhu Tubuh</label>
                <input type="text" id="suhu_tubuh_edit" name="suhu_tubuh_edit" required>
            </div>
            <div class="form-group">
                <label for="keluhan_edit">Keluhan</label>
                <input type="text" id="keluhan_edit" name="keluhan_edit" required>
            </div>
            <div class="form-group">
                <label for="diagnosa_edit">Diagnosa</label>
                <input type="text" id="diagnosa_edit" name="diagnosa_edit" required>
            </div>
            <div class="form-group">
                <label for="tindakan_edit">Tindakan</label>
                <input type="text" id="tindakan_edit" name="tindakan_edit" required>
            </div>
            <div class="form-group">
                <label for="resep_edit">Resep</label>
                <input type="text" id="resep_edit" name="resep_edit" required>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>

<!-- Popup Form Detail Rekam Medis -->
<div class="popup-overlay" id="popup-overlay-detail">
    <div class="popup-form" id="popup-form-detail">
        <span class="close-btn" onclick="closeDetailPopup()">&times;</span>
        <h2>Hasil Pemeriksaan</h2>
        <div id="detailContent">
            <!-- Tempat untuk menampilkan informasi detail rekam medis -->
            <p id="id_pasien_detail"><strong>ID :</strong></p>
            <p id="No_RM_detail"><strong>No RM :</strong></p>
            <p id="nama_pasien_detail"><strong>Nama Pasien :</strong></p>
            <p id="tensi_darah_detail"><strong>Tensi Darah :</strong></p>
            <p id="berat_badan_detail"><strong>Berat Badan :</strong></p>
            <p id="suhu_tubuh_detail"><strong>Suhu Tubuh :</strong></p>
            <p id="tinggi_badan_detail"><strong>Tinggi Badan :</strong></p>
            <p id="tindakan_detail"><strong>Tindakan :</strong></p>
            <p id="resep_detail"><strong>Resep :</strong></p>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk membuka pop-up form
    function openForm() {
        document.getElementById("popup-overlay").style.display = "flex";
        document.getElementById("popup-form").style.display = "block";
    }

    // Fungsi untuk menutup pop-up form
    function closeForm() {
        document.getElementById("popup-overlay").style.display = "none";
        document.getElementById("popup-form").style.display = "none";
    }
    // Fungsi untuk membuka pop-up form edit
    // Fungsi untuk membuka pop-up form edit
    function openEditForm(id_pasien) {
        document.getElementById("popup-overlay-edit").style.display = "flex";
        document.getElementById("popup-form-edit").style.display = "block";

        // Buat request URL dengan parameter id_pasien
        var url = "../actions/get_detail_rm.php?id_pasien=" + id_pasien;

        // Buat instance dari XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Mulai mengirim request
        xhr.open("GET", url, true);

        // Tentukan callback function untuk menangani respon dari server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parse JSON response menjadi objek JavaScript
                var data = JSON.parse(xhr.responseText);

                // Mengisi nilai input dengan data rekam medis yang sesuai
                document.getElementById("id_pasien_edit").value = data.id_pasien;
                document.getElementById("No_RM_edit").value = data.No_RM;
                document.getElementById("tgl_berobat_edit").value = data.tgl_berobat;
                document.getElementById("id_poli_edit").value = data.id_poli;
                document.getElementById("tensi_darah_edit").value = data.tensi_darah;
                document.getElementById("tinggi_badan_edit").value = data.tinggi_badan;
                document.getElementById("berat_badan_edit").value = data.berat_badan;
                document.getElementById("suhu_tubuh_edit").value = data.suhu_tubuh;
                document.getElementById("keluhan_edit").value = data.keluhan;
                document.getElementById("diagnosa_edit").value = data.diagnosa;
                document.getElementById("tindakan_edit").value = data.tindakan;
                document.getElementById("resep_edit").value = data.resep;
            }
        };

        // Kirim request
        xhr.send();
    }

    // Fungsi untuk menutup pop-up form edit
    function closeEditForm() {
        document.getElementById("popup-overlay-edit").style.display = "none";
        document.getElementById("popup-form-edit").style.display = "none";
    }

    // Fungsi untuk membuka pop-up form detail
    function openDetailPopup(id_pasien) {
        // Lakukan pengiriman kueri AJAX untuk mendapatkan detail rekam medis berdasarkan No_RM
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Tangkap respon dari server
                var detail = JSON.parse(this.responseText);

                // Tampilkan detail dalam pop-up
                document.getElementById("id_pasien_detail").innerHTML = "<strong>ID  :</strong> " + detail.id_pasien;
                document.getElementById("No_RM_detail").innerHTML = "<strong>NO RM :</strong> " + detail.No_RM;
                document.getElementById("nama_pasien_detail").innerHTML = "<strong>Nama Pasien:</strong> " + detail.nama_pasien;
                document.getElementById("tensi_darah_detail").innerHTML = "<strong>Tensi Darah:</strong> " + detail.tensi_darah;
                document.getElementById("berat_badan_detail").innerHTML = "<strong>Berat Badan:</strong> " + detail.berat_badan;
                document.getElementById("suhu_tubuh_detail").innerHTML = "<strong>Suhu Tubuh:</strong> " + detail.suhu_tubuh;
                document.getElementById("tinggi_badan_detail").innerHTML = "<strong>Tinggi Badan:</strong> " + detail.tinggi_badan;
                document.getElementById("tindakan_detail").innerHTML = "<strong>Tindakan:</strong> " + detail.tindakan;
                document.getElementById("resep_detail").innerHTML = "<strong>Resep:</strong> " + detail.resep;

                document.getElementById("popup-overlay-detail").style.display = "flex";
                document.getElementById("popup-form-detail").style.display = "block";
            }
        };
        xhr.open("GET", "../actions/get_detail_rm.php?id_pasien=" + id_pasien, true);
        xhr.send();
    }

    // Fungsi untuk menutup pop-up form detail
    function closeDetailPopup() {
        document.getElementById("popup-overlay-detail").style.display = "none";
        document.getElementById("popup-form-detail").style.display = "none";
    }

    function searchRekammedis(event) {
    event.preventDefault(); // Mencegah pengiriman form

    // Ambil nilai input pencarian
    var searchValue = document.getElementById("searchInput").value.trim().toLowerCase();

    // Ambil semua baris data dari tabel pasien
    var rows = document.querySelector(".table-container tbody").getElementsByTagName("tr");

    // Loop melalui setiap baris data dan sembunyikan yang tidak sesuai dengan pencarian
    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].getElementsByTagName("td");
        var found = false; // Tentukan apakah baris ditemukan sesuai pencarian

        // Loop melalui setiap sel pada baris data dan periksa apakah ada pencocokan dengan nilai pencarian
        for (var j = 0; j < rowData.length; j++) {
            if (rowData[j].textContent.toLowerCase().indexOf(searchValue) > -1) {
                found = true; // Baris ditemukan sesuai pencarian
                break;
            }
        }

        // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
        if (found) {
            rows[i].style.display = ""; // Tampilkan baris
        } else {
            rows[i].style.display = "none"; // Sembunyikan baris
        }
    }
}
</script>

</body>
</html>