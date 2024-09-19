<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/laporan.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <title>KLINIK ATLANTIC</title>
    <style>
        /* Gaya CSS untuk mengatur tata letak konten */
        .content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* Pusatkan judul "Laporan Klinik Atlantic" */
        .content h2 {
            text-align: center;
        }

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

        /* Tambahkan gaya untuk tabel agar tingginya hanya 30% dari konten */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #f2f2f2;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .laporan-section {
            height: 38vh; /* 30% dari tinggi konten */
            overflow-y: auto; /* Tambahkan scrollbar jika konten melebihi tinggi */
            margin-bottom: 20px;
            display: block;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
            <img src="../assets/img/logo.jpg" alt="Logo Klinik" style="text-align:center;">
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
                    <li class="active"><a href="obat_tindakan.php">Obat & Tindakan</a></li>
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
        <!-- Data Tindakan Section -->
        <div class="laporan-section">
            <h3 align="center">Data Tindakan Klinik</h3>
            <form class="search-form" onsubmit="searchTindakan(event)">
                <input type="text" id="searchInputTindakan" placeholder="Cari Data.." />
                <button type="submit">Cari</button> 
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Tindakan</th>
                        <th>Harga Tindakan</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tindakanTableBody">
                <?php
                    include "../includes/koneksi.php";
                    $q = mysqli_query($koneksi, "SELECT * FROM tindakan ORDER BY id_tindakan ASC");
                    while ($dt = mysqli_fetch_array($q)) {
                ?>
                    <tr>
                        <td><?= $dt['id_tindakan'] ?></td>
                        <td><?= $dt['nama_tindakan'] ?></td>
                        <td><?= $dt['harga_tindakan'] ?></td>
                        <td><a href="javascript:void(0)" onclick="openEditTindakanModal('<?= $dt['id_tindakan'] ?>', '<?= $dt['nama_tindakan'] ?>', '<?= $dt['harga_tindakan'] ?>')"><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:void(0)" onclick="confirmDelete('tindakan', '<?= $dt['id_tindakan'] ?>')"><i class="fas fa-trash"></i></a></td>

                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <!-- Tambah Data Tindakan Section -->
        <div class="laporan-section">
            <h3>Tambah Data Tindakan</h3>
            <form action="../actions/+tindakan.php" method="POST">
                <div class="form-group">
                    <label for="id_tindakan">ID</label>
                    <input type="text" id="id_tindakan" name="id_tindakan" required>
                </div>
                <div class="form-group">
                    <label for="nama_tindakan">Nama Tindakan</label>
                    <input type="text" id="nama_tindakan" name="nama_tindakan" required>
                </div>
                <div class="form-group">
                    <label for="harga_tindakan">Biaya Tindakan</label>
                    <input type="text" id="harga_tindakan" name="harga_tindakan" required>
                </div>
                <button type="submit">SUBMIT</button>
            </form>
        </div>

        <!-- Data Obat Section -->
        <div class="laporan-section">
            <h3 align="center">Data Obat Klinik</h3>
            <form class="search-form" onsubmit="searchObat(event)">
                <input type="text" id="searchInputObat" placeholder="Cari Data.." />
                <button type="submit">Cari</button> 
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th>Stok Obat</th>
                        <th>Harga Obat</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody id="obatTableBody">
                <?php
                    include "../includes/koneksi.php";
                    $q = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat ASC");
                    while ($dt = mysqli_fetch_array($q)) {
                ?>
                    <tr>
                        <td><?= $dt['id_obat'] ?></td>
                        <td><?= $dt['nama_obat'] ?></td>
                        <td><?= $dt['jenis_obat'] ?></td>
                        <td><?= $dt['stok_obat'] ?></td>
                        <td><?= $dt['harga_obat'] ?></td>
                        <td><a href="javascript:void(0)" onclick="openEditObatModal('<?= $dt['id_obat'] ?>', '<?= $dt['nama_obat'] ?>', '<?= $dt['jenis_obat'] ?>', '<?= $dt['stok_obat'] ?>', '<?= $dt['harga_obat'] ?>')"><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:void(0)" onclick="confirmDelete('obat', '<?= $dt['id_obat'] ?>')"><i class="fas fa-trash"></i></a></td>

                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <!-- Tambah Data Obat Section -->
        <div class="laporan-section">
            <h3>Tambah Data Obat</h3>
            <form action="../actions/+obat.php" method="POST">
                <div class="form-group">
                    <label for="id_obat">ID Obat</label>
                    <input type="text" id="id_obat" name="id_obat" required>
                </div>
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" required>
                </div>
                <div class="form-group">
                    <label for="jenis_obat">Jenis Obat</label>
                    <select id="jenis_obat" name="jenis_obat" required>
                        <option value="Pil">Pil</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Syrup">Syrup</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stok_obat">Stok Obat</label>
                    <input type="number" id="stok_obat" name="stok_obat" min="0" required>
                </div>
                <div class="form-group">
                    <label for="harga_obat">Harga Obat</label>
                    <input type="number" id="harga_obat" name="harga_obat" required>
                </div>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Edit Tindakan -->
<div id="editTindakanModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditTindakanModal()">&times;</span>
        <h3>Edit Data Tindakan</h3>
        <form action="../actions/edit_tindakan.php" method="POST">
            <div class="form-group">
                <label for="edit_id_tindakan">ID</label>
                <input type="text" id="edit_id_tindakan" name="id_tindakan" readonly>
            </div>
            <div class="form-group">
                <label for="edit_nama_tindakan">Nama Tindakan</label>
                <input type="text" id="edit_nama_tindakan" name="nama_tindakan" required>
            </div>
            <div class="form-group">
                <label for="edit_harga_tindakan">Biaya Tindakan</label>
                <input type="text" id="edit_harga_tindakan" name="harga_tindakan" required>
            </div>
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</div>

<!-- Modal for Edit Obat -->
<div id="editObatModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditObatModal()">&times;</span>
        <h3>Edit Data Obat</h3>
        <form action="../actions/edit_obat.php" method="POST">
            <div class="form-group">
                <label for="edit_id_obat">ID Obat</label>
                <input type="text" id="edit_id_obat" name="id_obat" readonly>
            </div>
            <div class="form-group">
                <label for="edit_nama_obat">Nama Obat</label>
                <input type="text" id="edit_nama_obat" name="nama_obat" required>
            </div>
            <div class="form-group">
                <label for="edit_jenis_obat">Jenis Obat</label>
                <select id="edit_jenis_obat" name="jenis_obat" required>
                    <option value="Pil">Pil</option>
                    <option value="Kapsul">Kapsul</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Syrup">Syrup</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit_stok_obat">Stok Obat</label>
                <input type="number" id="edit_stok_obat" name="stok_obat" min="0" required>
            </div>
            <div class="form-group">
                <label for="edit_harga_obat">Harga Obat</label>
                <input type="text" id="edit_harga_obat" name="harga_obat" required>
            </div>
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</div>

<script>
function searchTindakan(event) {
    event.preventDefault(); // Mencegah pengiriman form

    var searchValue = document.getElementById("searchInputTindakan").value.trim().toLowerCase();
    var rows = document.getElementById("tindakanTableBody").getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].getElementsByTagName("td");
        var found = false;

        for (var j = 0; j < rowData.length; j++) {
            if (rowData[j].textContent.toLowerCase().indexOf(searchValue) > -1) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? "" : "none";
    }
}

function searchObat(event) {
    event.preventDefault(); // Mencegah pengiriman form

    var searchValue = document.getElementById("searchInputObat").value.trim().toLowerCase();
    var rows = document.getElementById("obatTableBody").getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].getElementsByTagName("td");
        var found = false;

        for (var j = 0; j < rowData.length; j++) {
            if (rowData[j].textContent.toLowerCase().indexOf(searchValue) > -1) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? "" : "none";
    }
}

function openEditTindakanModal(id, nama, harga) {
    document.getElementById('edit_id_tindakan').value = id;
    document.getElementById('edit_nama_tindakan').value = nama;
    document.getElementById('edit_harga_tindakan').value = harga;
    document.getElementById('editTindakanModal').style.display = 'block';
}

function closeEditTindakanModal() {
    document.getElementById('editTindakanModal').style.display = 'none';
}

function openEditObatModal(id, nama, jenis, stok, harga) {
    document.getElementById('edit_id_obat').value = id;
    document.getElementById('edit_nama_obat').value = nama;
    document.getElementById('edit_jenis_obat').value = jenis;
    document.getElementById('edit_stok_obat').value = stok;
    document.getElementById('edit_harga_obat').value = harga;
    document.getElementById('editObatModal').style.display = 'block';
}

function closeEditObatModal() {
    document.getElementById('editObatModal').style.display = 'none';
}
function confirmDelete(type, id) {
    let message = `Apakah Anda yakin ingin menghapus ${type} dengan ID ${id}?`;
    if (confirm(message)) {
        window.location.href = `../actions/delete_OT.php?type=${type}&id=${id}`;
    }
}

</script>

</body>
</html>
