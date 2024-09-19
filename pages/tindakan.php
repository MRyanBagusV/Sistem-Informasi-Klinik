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
    <h3>Laporan Stok Obat</h3>
            <table>
                <thead>
                    <tr>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th>stok Obat</th>
                        <th>Harga Obat</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../includes/koneksi.php";

                    $q = mysqli_query($koneksi,"SELECT * FROM tindakan ORDER BY id_obat ASC");

                    while ($dt = mysqli_fetch_array($q)) {
                        ?>
                        <tr>
                            <td><?= $dt['id_obat'] ?></td>
                            <td><?= $dt['nama_obat'] ?></td>
                            <td><?= $dt['Jenis_obat'] ?></td>
                            <td><?= $dt['stok_obat'] ?></td>
                            <td><?= $dt['Harga_obat'] ?></td>
                            <td><a href="javascript:void(0)" onclick="openEditForm('<?= $dt['id_obat'] ?>', '<?= $dt['nama_obat'] ?>', '<?= $dt['Jenis_obat'] ?>', '<?= $dt['stok_obat'] ?>', '<?= $dt['Harga_obat'] ?>')"><i class="fas fa-edit"></i></a></td>
                            <td><a href="../actions/delps.php?id=<?= $dt['id_obat'] ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
