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
                    <li class="active"><a href="transaksi.php">Data Transaksi</a></li>
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
        <h2 class="subtitle">DATA TRANSAKSI PASIEN</h2>
        <div class="actions">
            <form class="search-form" onsubmit="searchTransaksi(event)">
                <input type="text" id="searchInput" name="search" placeholder="Cari transaksi Pasien.." />
                <button type="submit">Cari</button>
            </form>
        </div>
        <div class="table-container">
            <table cellspacing="1" cellpadding="4">
                <thead>
                    <tr>
                        <th>No Invoice</th>
                        <th>Tanggal Transaksi</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>Farmasi</th>
                        <th>Tindakan</th>
                        <th>Total Bayar</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../includes/koneksi.php";

                    $sql = "SELECT t.id_transaksi, t.No_RM, t.nama_pasien, t.total_bayar, t.waktu_transaksi, 
                                   SUM(CASE WHEN d.jenis_item = 'obat' THEN d.total ELSE 0 END) AS total_farmasi,
                                   SUM(CASE WHEN d.jenis_item = 'tindakan' THEN d.total ELSE 0 END) AS total_tindakan
                            FROM transaksi t
                            LEFT JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
                            GROUP BY t.id_transaksi";

                    $result = $koneksi->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_transaksi'] . "</td>";
                                echo "<td>" . $row['waktu_transaksi'] . "</td>";
                                echo "<td>" . $row['No_RM'] . "</td>";
                                echo "<td>" . $row['nama_pasien'] . "</td>";
                                echo "<td>" . $row['total_farmasi'] . "</td>";
                                echo "<td>" . $row['total_tindakan'] . "</td>"; 
                                echo "<td>" . $row['total_bayar'] . "</td>";
                                echo "<td><a href='#'><i class='fas fa-trash-alt'></i></a></td>"; // Icon delete
                                echo "<td><a href='../actions/cetak_transaksi.php?id_pasien=" . $row['id_transaksi'] . "' target='_blank'><i class='fas fa-file-pdf'></i></a></td>";
                                echo "</tr>";
                                
                            }
                        } else {
                            echo "<tr><td colspan='9'>Tidak ada transaksi</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Error: " . $koneksi->error . "</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function searchTransaksi(event) {
        event.preventDefault(); // Mencegah pengiriman form

        // Ambil nilai input pencarian
        var searchValue = document.getElementById("searchInput").value.trim().toLowerCase();

        // Ambil semua baris data dari tabel transaksi
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
