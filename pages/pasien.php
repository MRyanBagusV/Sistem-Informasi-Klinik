<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pasien.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <title>KLINIK ATLANTIC</title>
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
                    <span class="username"></span>
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-content">
                    <div class="user-details">
                        <i class="fas fa-user-circle">  </i>
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
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li class="active"><a href="pasien.php"><i class="fas fa-user"></i>Manajemen Pasien</a></li>
            <li><a href="rekammedis.php"><i class="fas fa-notes-medical"></i>Data Rekam Medis</a></li>
            <li><a href="dokter.php"><i class="fas fa-user-md"></i>Manajemen Dokter</a></li>
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
        <h2 class="subtitle">KELOLA DATA PASIEN</h2>
        <div class="actions">
        <form class="search-form" onsubmit="searchPasien(event)">
            <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama obat..." />
            <button type="submit">Cari</button>
            <a href="javascript:void(0)" onclick="openForm()"><i class="fas fa-user-plus"></i>Registrasi Baru</a>
        </div>
        <div class="table-container" >
            <table cellspacing="1" cellpadding="4" >
                <thead>
                    <tr>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th>
                        <th>Jenis Pasien</th>
                        <th>Alamat Pasien</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../includes/koneksi.php";

                    // Fungsi untuk menghitung umur berdasarkan tanggal lahir
                    function hitungUmur($tanggal_lahir) {
                        $dob = new DateTime($tanggal_lahir);
                        $today = new DateTime('today');
                        $umur = $dob->diff($today)->y;
                        return $umur;
                    }

                    $q = mysqli_query($koneksi,"SELECT * FROM pasien ORDER BY No_RM ASC");

                    while ($dt = mysqli_fetch_array($q)) {
                        ?>
                        <tr>
                            <td><?= $dt['No_RM'] ?></td>
                            <td><?= $dt['nama_pasien'] ?></td>
                            <td><?= $dt['jenis_kelamin'] ?></td>
                            <td><?= $dt['Tanggal_lahir'] ?></td>
                            <td><?= hitungUmur($dt['Tanggal_lahir']) ?></td>
                            <td><?= $dt['jenis_pasien'] ?></td>
                            <td><?= $dt['alamat_pasien'] ?></td>
                            <td><a href="javascript:void(0)" onclick="openEditForm('<?= $dt['No_RM'] ?>', '<?= $dt['nama_pasien'] ?>', '<?= $dt['jenis_kelamin'] ?>', '<?= $dt['Tanggal_lahir'] ?>', '<?= $dt['jenis_pasien'] ?>', '<?= $dt['alamat_pasien'] ?>', '<?= $dt['no_telp'] ?>')"><i class="fas fa-edit"></i></a></td>
                            <td><a href="../actions/delps.php?id=<?= $dt['No_RM'] ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?> 

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pop-up Form Pendaftaran Pasien -->
<div class="popup-overlay" id="popup-overlay">
    <div class="popup-form" id="popup-form">
        <span class="close-btn" onclick="closeForm()">&times;</span>
        <h2>Registrasi Pasien</h2>
        <form action="../actions/+pasien.php" method="POST">
            <div class="form-group">
                <label for="No_RM">No RM</label>
                <input type="text" id="No_RM" name="No_RM" required>
            </div>
            <div class="form-group">
                <label for="nama_pasien">Nama Pasien</label>
                <input type="text" id="nama_pasien" name="nama_pasien" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" id="Laki_laki" name="jenis_kelamin" value="Laki-laki" required>
                    <label for="Laki_laki">Laki-laki</label>
                    <input type="radio" id="Laki_laki" name="jenis_kelamin" value="Perempuan" required>
                    <label for="Perempuan">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="Tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="Tanggal_lahir" name="Tanggal_lahir" onchange="hitungUmurRegistrasi(this.value)" required>
            </div>
            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="text" id="umur" name="umur" readonly>
            </div>
            <div class="form-group">
                <label for="jenis_pasien">Jenis Pasien</label>
                <select id="jenis_pasien" name="jenis_pasien" required>
                    <option value="Umum">Umum</option>
                    <option value="IMS">IMS</option>
                    <option value="KULIT">KULIT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_pasien">Alamat Pasien</label>
                <textarea id="alamat_pasien" name="alamat_pasien" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" id="no_telp" name="no_telp" required>
            </div>
            <button type="submit" name="submit" >Registrasi</button>
        </form>
    </div>
</div>

<!-- Pop-up Form Edit Pasien -->
<div class="popup-overlay" id="edit-popup-overlay">
    <div class="popup-form" id="edit-popup-form">
        <span class="close-btn" onclick="closeEditForm()">&times;</span>
        <h2>Edit Data Pasien</h2>
        <form action="../actions/updateps.php" method="POST">
            <div class="form-group">
                <label for="No_RM_edit">No RM</label>
                <input type="text" id="No_RM_edit" name="No_RM" readonly>
            </div>
            <div class="form-group">
                <label for="nama_pasien_edit">Nama Pasien</label>
                <input type="text" id="nama_pasien_edit" name="nama_pasien" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin_edit">Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" id="jenis_kelamin_l_edit" name="jenis_kelamin" value="Laki-laki" required>
                    <label for="jenis_kelamin_l_edit">Laki-laki</label>
                    <input type="radio" id="jenis_kelamin_p_edit" name="jenis_kelamin" value="Perempuan" required>
                    <label for="jenis_kelamin_p_edit">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_edit">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir_edit" name="Tanggal_lahir" onchange="hitungUmurEdit(this.value)" required>
            </div>
            <div class="form-group">
                <label for="umur_edit">Umur</label>
                <input type="text" id="umur_edit" name="umur" readonly>
            </div>
            <div class="form-group">
                <label for="jenis_pasien_edit">Jenis Pasien</label>
                <select id="jenis_pasien_edit" name="jenis_pasien" required>
                    <option value="Umum">Umum</option>
                    <option value="IMS">IMS</option>
                    <option value="KULIT">KULIT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_pasien_edit">Alamat Pasien</label>
                <textarea id="alamat_pasien_edit" name="alamat_pasien" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_telp_edit">No. Telepon</label>
                <input type="text" id="no_telp_edit" name="no_telp" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

<script>
    function openForm() {
        document.getElementById("popup-overlay").style.display = "flex";
        document.getElementById("popup-form").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popup-overlay").style.display = "none";
        document.getElementById("popup-form").style.display = "none";
    }

    function openEditForm(No_RM, nama_pasien, jenis_kelamin, Tanggal_lahir, jenis_pasien, alamat_pasien, no_telp) {
        document.getElementById("edit-popup-overlay").style.display = "flex";
        document.getElementById("edit-popup-form").style.display = "block";

        document.getElementById("No_RM_edit").value = No_RM;
        document.getElementById("nama_pasien_edit").value = nama_pasien;
        if (jenis_kelamin === 'Laki-laki') {
            document.getElementById("jenis_kelamin_l_edit").checked = true;
        } else {
            document.getElementById("jenis_kelamin_p_edit").checked = true;
        }
        document.getElementById("tanggal_lahir_edit").value = Tanggal_lahir;
        document.getElementById("umur_edit").value = hitungUmurEdit(Tanggal_lahir);
        document.getElementById("jenis_pasien_edit").value = jenis_pasien;
        document.getElementById("alamat_pasien_edit").value = alamat_pasien;
        document.getElementById("no_telp_edit").value = no_telp;
    }

    function closeEditForm() {
        document.getElementById("edit-popup-overlay").style.display = "none";
        document.getElementById("edit-popup-form").style.display = "none";
    }

    function hitungUmur(Tanggal_lahir) {
        var dob = new Date(Tanggal_lahir);
        var today = new Date();
        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
        return age;
    }

    function hitungUmurRegistrasi(Tanggal_lahir) {
        document.getElementById("umur").value = hitungUmur(Tanggal_lahir);
    }

    function hitungUmurEdit(Tanggal_lahir) {
    document.getElementById("umur_edit").value = hitungUmur(Tanggal_lahir);
    }
    function searchPasien(event) {
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
