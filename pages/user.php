<?php
// Sambungkan ke database
include "../includes/koneksi.php";

// Query untuk mengambil data user dari database
$query = "SELECT * FROM user ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>

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
            margin-left: 10px;
        }

        .submenu li a:hover {
            text-decoration: underline;
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

        .popup-form.active {
            display: block;
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
                    <li class="active"><a href="user.php">Data User</a></li>
                </ul>
            </li>
        </ul>
        <div class="contact-info">
            <p>Klinikatlantic@gmail.com</p>
            <p>(+62) 811-921-718</p>
        </div>
    </aside>

    <div class="content">
        <h2 class="subtitle">KELOLA TENAGA MEDIS</h2>
        <div class="actions">
            <form class="search-form" onsubmit="searchUser(event)">
                <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama karyawan...">
                <button type="submit">Cari</button>
                <a href="javascript:void(0)" onclick="openForm()"><i class="fas fa-user-plus"></i>Registrasi Baru</a>
            </form>
        </div>
        <div class="table-container">
            <table cellspacing="1" cellpadding="4">
                <thead>
                    <tr>
                        <th>Id User</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>Jabatan</th>
                        <th>Foto</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dt = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $dt['id'] ?></td>
                            <td><?= $dt['username'] ?></td>
                            <td><?= $dt['alamat'] ?></td>
                            <td><?= $dt['role'] ?></td>
                            <td><?= $dt['foto'] ?></td>
                            <td><a href="javascript:void(0)" onclick="openEditForm('<?= $dt['id'] ?>', '<?= $dt['username'] ?>', '<?= $dt['alamat'] ?>', '<?= $dt['role'] ?>', '<?= $dt['foto'] ?>')"><i class="fas fa-edit"></i></a></td>
                            <td><a href="javascript:void(0)" onclick="deleteData('<?= $dt['id'] ?>')"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pop-up overlay -->
<div id="popupOverlay" class="popup-overlay" onclick="closePopup()"></div>

<!-- Pop-up form registrasi baru -->
<div id="popupForm" class="popup-form">
    <h2>Registrasi Baru</h2>
    <form id="registrasiForm" onsubmit="submitForm(event)">
        <label for="username">Nama Karyawan:</label>
        <input type="text" id="username" name="username" required>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required>

        <label for="role">Jabatan:</label>
        <input type="text" id="role" name="role" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>


        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto">

        <button type="submit">Simpan</button>
        <button type="button" onclick="closeForm()">Batal</button>
    </form>
</div>

<!-- Pop-up form edit data user -->
<div id="popupEditForm" class="popup-form">
    <h2>Edit Data User</h2>
    <form id="editForm" onsubmit="submitEditForm(event)">
        <input type="hidden" id="edit_id" name="id">

        <label for="edit_username">Nama Karyawan:</label>
        <input type="text" id="edit_username" name="username" required>

        <label for="edit_alamat">Alamat:</label>
        <input type="text" id="edit_alamat" name="alamat" required>

        <label for="edit_role">Jabatan:</label>
        <input type="text" id="edit_role" name="role" required>

        <label for="edit_foto">Foto:</label>
        <input type="file" id="edit_foto" name="foto">

        <button type="submit">Simpan</button>
        <button type="button" onclick="closeEditForm()">Batal</button>
    </form>
</div>

<!-- Script untuk fungsi popup form -->
<script>
    // Fungsi untuk membuka form registrasi baru
    function openForm() {
        document.getElementById("popupForm").classList.add("active");
        document.getElementById("popupOverlay").classList.add("active");
    }

    // Fungsi untuk menutup form registrasi baru
    function closeForm() {
        document.getElementById("popupForm").classList.remove("active");
        document.getElementById("popupOverlay").classList.remove("active");
    }

    // Fungsi untuk membuka form edit data user
    function openEditForm(id, nama, alamat, role, foto) {
        document.getElementById("edit_id").value = id;
        document.getElementById("username").value = nama;
        document.getElementById("edit_alamat").value = alamat;
        document.getElementById("edit_role").value = role;
        // Jika foto ada, set nilai input file tetap kosong karena untuk edit tidak perlu mengganti foto
        document.getElementById("edit_foto").value = "";
        document.getElementById("popupEditForm").classList.add("active");
        document.getElementById("popupOverlay").classList.add("active");
    }

    // Fungsi untuk menutup form edit data user
    function closeEditForm() {
        document.getElementById("popupEditForm").classList.remove("active");
        document.getElementById("popupOverlay").classList.remove("active");
    }

    // Fungsi untuk menutup popup dan overlay
    function closePopup() {
        closeForm();
        closeEditForm();
    }

// Fungsi untuk submit form registrasi baru
function submitForm(event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById("registrasiForm"));
    fetch('../actions/registrasi_user.php', {  // Perhatikan penyesuaian path di sini
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil disimpan');
            closeForm();
            location.reload();
        } else {
            alert('Gagal menyimpan data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
}

// Fungsi untuk submit form edit data user
function submitEditForm(event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById("editForm"));
    fetch('../actions/edit_user.php', {  // Perhatikan penyesuaian path di sini
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil diperbarui');
            closeEditForm();
            location.reload();
        } else {
            alert('Gagal memperbarui data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui data');
    });
}

// Fungsi untuk menghapus data user
function deleteData(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // Lakukan proses penghapusan data, misalnya dengan AJAX ke backend
        fetch('../actions/delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus');
                location.reload(); // Muat ulang halaman atau perbarui data yang ditampilkan
            } else {
                alert('Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }
}

</script>

</body>
</html>
