<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/index.css">
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

<body class="d-flex flex-column h-100">
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

    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <div class="sidebar col-12 col-md-3 col-xl-2 bd-sidebar">
                <div class="logo">
                    <img src="../assets/img/logo.jpg" alt="Logo Klinik">
                </div>
                <div class="sidebar-content">
                    <div class="clinic-info text-center">
                        <h2>Klinik Atlantic</h2>
                    </div>
                    
                    <div class="user-info text-center">
                        <p>Welcome, Admin</p>
                    </div>
                    <ul>
            <li class="active"><a href="index.php"><i class="fas fa-home"></i>Dashboard</a></li>            
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
                    <div class="contact-info text-center">
                        <p>Klinikatlantic@gmail.com</p>
                        <p>(+62) 811-921-718</p>
                    </div>
                </div>
            </div>

            <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 bd-content">
                <div class="container pt-5">
                    <div class="alert alert-light d-flex align-items-center mb-5" role="alert">
                        <i class="bi-info-circle text-success me-3 fs-3"></i>
                        <div>
                            Selamat Datang di <strong>Pelayanan Kesehatan Klinik Atlantic</strong>. Silahkan pilih halaman yang ingin ditampilkan.
                        </div>
                    </div>

                    <div class="row gx-5">
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-5">
                                    <div class="feature-icon-1 bg-success bg-gradient mb-4">
                                        <i class="bi-people"></i>
                                    </div>
                                    <h3>Nomor Antrian</h3>
                                    <p class="mb-4">Halaman Nomor Antrian digunakan pengunjung untuk mengambil nomor antrian.</p>
                                    <a href="../nomor-antrian" class="btn btn-success rounded-pill px-4 py-2">Tampilkan <i class="bi-chevron-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-5">
                                    <div class="feature-icon-1 bg-success bg-gradient mb-4">
                                        <i class="bi-mic"></i>
                                    </div>
                                    <h3>Panggilan Antrian</h3>
                                    <p class="mb-4">Halaman Panggilan Antrian digunakan petugas loket untuk memanggil antrian pengunjung.</p>
                                    <a href="../panggilan-antrian" class="btn btn-success rounded-pill px-4 py-2">Tampilkan <i class="bi-chevron-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</body>

</html>
