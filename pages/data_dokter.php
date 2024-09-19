<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pasien.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <style>
        /* Gaya untuk submenu */
        .submenu {
            display: none; /* Submenu defaultnya disembunyikan */
        }

        /* Menampilkan submenu saat "Kasir Pembayaran" diklik */
        .has-submenu:hover .submenu {
            display: block;
            margin-left: 10px;
        }

        .submenu li a:hover {
            text-decoration: underline;
        }

        /* Gaya tanda panah untuk submenu */
        .has-submenu > a i {
            margin-left: 5px; /* Jarak antara teks dengan tanda panah */
        }

        /* Gaya untuk pop-up form */
        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .popup-form h2 {
            margin-bottom: 20px;
        }

        .popup-form label {
            display: block;
            margin-bottom: 10px;
        }

        .popup-form input[type="text"], 
        .popup-form input[type="file"], 
        .popup-form select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .popup-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-form button[type="button"] {
            background-color: #dc3545;
        }

        /* Style untuk overlay */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Transparan hitam */
            z-index: 999; /* Memastikan overlay berada di atas pop-up */
        }

        .popup-overlay.active {
            display: block;
        }
    </style>
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
        <br>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="pasien.php"><i class="fas fa-user"></i>Manajemen Pasien</a></li>
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
                    <li class="active"><a href="data_dokter.php">Data Dokter</a></li>
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
        <h2 class="subtitle">KELOLA DATA DOKTER</h2>
        <div class="actions">
            <form class="search-form" onsubmit="searchDokter(event)">
                <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama dokter..." />
                <button type="submit">Cari</button>
                <a href="javascript:void(0)" onclick="openForm()"><i class="fas fa-user-plus"></i>Registrasi Baru</a>
            </form>
        </div>
        <div class="table-container">
            <table cellspacing="1" cellpadding="4">
                <thead>
                    <tr>
                        <th>Id Dokter</th>
                        <th>Nama Dokter</th>
                        <th>Poli Klinik</th>
                        <th>Jadwal Praktek</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../includes/koneksi.php";
                        $q = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY id_dokter ASC");
                        while ($dt = mysqli_fetch_array($q)) {
                            ?>
                            <tr>
                                <td><?= $dt['id_dokter'] ?></td>
                                <td><?= $dt['nama_dokter'] ?></td>
                                <td><?= $dt['poli'] ?></td>
                                <td><?= $dt['jadwal'] ?></td>
                                <td><a href="javascript:void(0)" onclick="openEditForm('<?= $dt['id_dokter'] ?>', '<?= $dt['nama_dokter'] ?>', '<?= $dt['poli'] ?>', '<?= $dt['jadwal'] ?>', '<?= $dt['foto'] ?>')"><i class="fas fa-edit"></i></a></td>
                                <td><a href="javascript:void(0)" onclick="confirmDelete(<?= $dt['id_dokter'] ?>)"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Pop-up overlay -->
<div id="popupOverlay" class="popup-overlay" onclick="closePopup()"></div>
<!-- Pop-up form registrasi baru -->
<div id="popupForm" class="popup-form">
    <h2>Registrasi Dokter Baru</h2>
    <form id="registrasiForm" onsubmit="submitForm(event)">
        <label for="nama_dokter">Nama Dokter:</label>
        <input type="text" id="nama_dokter" name="nama_dokter" required>

        <label for="poli">Poli Klinik:</label>
        <input type="text" id="poli" name="poli" required>

        <label for="jadwal">Jadwal Praktek:</label>
        <input type="text" id="jadwal" name="jadwal" required>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto">

        <button type="submit">Simpan</button>
        <button type="button" onclick="closeForm()">Batal</button>
    </form>
</div>

<!-- Pop-up form edit data dokter -->
<div id="popupEditForm" class="popup-form">
    <h2>Edit Data Dokter</h2>
    <form id="editForm" onsubmit="submitEditForm(event)">
        <input type="hidden" id="edit_id_dokter" name="id_dokter">

        <label for="edit_nama_dokter">Nama Dokter:</label>
        <input type="text" id="edit_nama_dokter" name="nama_dokter" required>

        <label for="edit_poli">Poli Klinik:</label>
        <input type="text" id="edit_poli" name="poli" required>

        <label for="edit_jadwal">Jadwal Praktek:</label>
        <input type="text" id="edit_jadwal" name="jadwal" required>

        <label for="edit_foto">Foto:</label>
        <input type="file" id="edit_foto" name="foto">

        <button type="submit">Simpan</button>
        <button type="button" onclick="closeEditForm()">Batal</button>
    </form>
</div>

<script>
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
        document.getElementById("popupOverlay").classList.add("active");
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
        document.getElementById("popupOverlay").classList.remove("active");
    }

    function openEditForm(id, nama, poli, jadwal, foto) {
        document.getElementById("edit_id_dokter").value = id;
        document.getElementById("edit_nama_dokter").value = nama;
        document.getElementById("edit_poli").value = poli;
        document.getElementById("edit_jadwal").value = jadwal;
        // Foto tidak dapat diedit secara langsung, hanya bisa diupload ulang
        document.getElementById("popupEditForm").style.display = "block";
        document.getElementById("popupOverlay").classList.add("active");
    }

    function closeEditForm() {
        document.getElementById("popupEditForm").style.display = "none";
        document.getElementById("popupOverlay").classList.remove("active");
    }

    function submitForm(event) {
        event.preventDefault(); // Mencegah form untuk dikirimkan

        var formData = new FormData(document.getElementById("registrasiForm"));

        // Lakukan request ke server
        fetch('../actions/registrasi_dokter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Dokter berhasil diregistrasi');
                location.reload(); // Muat ulang halaman
            } else {
                alert('Gagal meregistrasi dokter');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

        closeForm(); // Tutup form setelah pengiriman
    }

    function submitEditForm(event) {
        event.preventDefault(); // Mencegah form untuk dikirimkan

        // Ambil data form
        var formData = new FormData(document.getElementById("editForm"));

        // Lakukan request ke server
        fetch('../actions/edit_dokter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data dokter berhasil diperbarui');
                location.reload(); // Muat ulang halaman
            } else {
                alert('Gagal memperbarui data dokter');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

        closeEditForm(); // Tutup form setelah pengiriman
    }

    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = '../actions/del_dokter.php?id=' + id;
        }
    }
</script>
</body>
</html>
