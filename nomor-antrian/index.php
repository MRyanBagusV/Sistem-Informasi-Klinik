<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Antrian Berbasis Web">
    <meta name="author" content="M Ryan Bagus V">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/index.css">
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
                    <ul class="sidebar-menu">
                        <li class="active"><a href="../pages/index.php"><i class="fas fa-home"></i>Dashboard</a></li>
                        <li><a href="../pages/pasien.php"><i class="fas fa-user"></i>Manajemen Pasien</a></li>
                        <li><a href="../pages/rekammedis.php"><i class="fas fa-notes-medical"></i>Data Rekam Medis</a></li>
                        <li><a href="../pages/dokter.php"><i class="fas fa-user-md"></i>Manajemen Dokter</a></li>
                        <li><a href="../pages/kasir.php"><i class="fas fa-cash-register"></i>Kasir Pembayaran</a></li>
                        <li><a href="../pages/laporan.php"><i class="fas fa-file-alt"></i>Laporan</a></li>
                        <li><a href="../pages/pengaturan.php"><i class="fas fa-cogs"></i>Pengaturan</a></li>
                    </ul>
                    <div class="contact-info text-center">
                        <p>Klinikatlantic@gmail.com</p>
                        <p>(+62) 811-921-718</p>
                    </div>
                </div>
            </div>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container pt-5">
      <div class="row justify-content-lg-center">
        <div class="col-lg-5 mb-4">
          <div class="px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
            <!-- judul halaman -->
            <div class="d-flex align-items-center me-md-auto">
              <i class="bi-people-fill text-success me-3 fs-3"></i>
              <h1 class="h5 pt-2">Nomor Antrian</h1>
            </div>
          </div>

          <div class="card border-0 shadow-sm">
            <div class="card-body text-center d-grid p-5">
              <div class="border border-success rounded-2 py-2 mb-5">
                <h3 class="pt-4">ANTRIAN</h3>
                <!-- menampilkan informasi jumlah antrian -->
                <h1 id="antrian" class="display-1 fw-bold text-success text-center lh-1 pb-2"></h1>
              </div>
              <!-- button pengambilan nomor antrian -->
              <a id="insert" href="javascript:void(0)" class="btn btn-success btn-block rounded-pill fs-5 px-5 py-4 mb-2">
                <i class="bi-person-plus fs-4 me-2"></i> Ambil Nomor
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- jQuery Core -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // tampilkan jumlah antrian
      $('#antrian').load('get_antrian.php');

      // proses insert data
      $('#insert').on('click', function() {
        $.ajax({
          type: 'POST',                     // mengirim data dengan method POST
          url: 'insert.php',                // url file proses insert data
          success: function(result) {       // ketika proses insert data selesai
            // jika berhasil
            if (result === 'Sukses') {
              // tampilkan jumlah antrian
              $('#antrian').load('get_antrian.php').fadeIn('slow');
            }
          },
        });
      });
    });
  </script>

</body>

</html>