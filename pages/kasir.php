<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "klinik_atlantic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data item dari database
$sql_obat = "SELECT id_obat, nama_obat, harga_obat FROM obat";
$result_obat = $conn->query($sql_obat);

// Query untuk mengambil data pasien dari database
$sql_pasien = "SELECT No_RM, nama_pasien FROM pasien";
$result_pasien = $conn->query($sql_pasien);

// Query untuk mengambil data tindakan dari database
$sql_tindakan = "SELECT id_tindakan, nama_tindakan, harga_tindakan FROM tindakan";
$result_tindakan = $conn->query($sql_tindakan);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/kasir.css">
    <script src="https://kit.fontawesome.com/19a6eaed8a.js" crossorigin="anonymous"></script>
    <title>KLINIK ATLANTIC</title>
    <style>
        .container {
            display: flex;
            height: 100vh;
        }
        .content {
            display: flex;
            flex-direction: row;
            flex: 1;
            padding: 20px;
        }
        .cart, .items {
            flex: 1;
            margin-top:10px;
            padding: 20px;
        }
        .cart h2, .items h2 {
            margin-top: 20px;
            align: center;
        }
        .cart-list, .item-list {
            list-style-type: none;
            padding: 0;
            height: 80%;
            overflow-y: auto;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        
        .cart-list li, .item-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-list li button, .item-list li button {
            margin-left: 10px;
            padding: 5px 10px;
        }
        .quantity-buttons {
            display: flex;
            align-items: center;
        }
        .quantity-buttons button {
            padding: 5px;
        }
        .quantity-buttons span {
            margin: 0 10px;
        }
        .search {
            margin-bottom: 20px;
        }
        .search input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .total {
            margin-top: 20px;
            font-size: 18px;
            height: 50%;
            font-weight: bold;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            max-width: 50%; /* Maksimum lebar modal */
            max-height: 80%; /* Maksimum tinggi modal */
            overflow-y: auto; /* Aktifkan pengguliran vertikal jika konten melebihi tinggi modal */
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

        .patient-list {
            list-style-type: none;
            padding: 0;
        }
        .patient-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }
        .patient-list li:hover {
            background-color: #f1f1f1;
        }

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
                    <li class="active"><a href="Kasir.php">Kasir Pembayaran</a></li>
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
        <div class="cart">
        <h2 align="center">KASIR PEMBAYARAN</h2>
            <br>
            <form action="../actions/proses_input_transaksi.php" method="POST" id="checkout-form">
                <input type="hidden" name="items" id="cart-data" >
                <div class="form-group">
                    <label for="No_RM">NO RM</label>
                    <input type="number" id="No_RM" name="No_RM" placeholder="Klik Tombol cari" required readonly>
                    <button type="button" onclick="showPatientModal()">Cari</button>
                </div>
                <div class="form-group">
                    <label for="nama_pasien"></label>
                    <input type="text" id="nama_pasien" name="nama_pasien" placeholder="Nama Pasien" required readonly>
                </div>
                <h2 align="center">Detail Pembayaran</h2>
                <br>
                <ul class="cart-list" id="cart-list"></ul>
                <input type="hidden" name="total" id="total-value">
                <div class="total" name="total" id="total">Total: Rp. <span id="display-total">0.00</span></div>
                <br>
                <button type="submit" class="btn-checkout" onclick="setTotalValue()">Bayar</button>
            </form>
        </div>

        <div class="items">
            <h2>Pilih Item </h2>
            <div class="search">
    <input type="text" id="search" placeholder="Cari data Obat dan Tindakan" oninput="filterItems()">
</div>

            <ul class="item-list" id="item-list">
                <!-- Tampilkan data obat dari database -->
                <?php
                if ($result_obat->num_rows > 0) {
                    while ($row = $result_obat->fetch_assoc()) {
                        echo "<li>";
                        echo "<span>" . $row["nama_obat"] . " - Rp. " . $row["harga_obat"] . "</span>";
                        echo "<button type='submit' onclick=\"addToCart('" . $row["nama_obat"] . "', 'obat', " . $row["harga_obat"] . ")\">To Cart</button>";
                        echo "</li>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
                <!-- Tampilkan data tindakan dari database -->
                <?php
                if ($result_tindakan->num_rows > 0) {
                    while ($row = $result_tindakan->fetch_assoc()) {
                        echo "<li>";
                        echo "<span>" . $row["nama_tindakan"] . " - Rp. " . $row["harga_tindakan"] . "</span>";
                        echo "<button type='submit' onclick=\"addToCart('" . $row["nama_tindakan"] . "', 'tindakan', " . $row["harga_tindakan"] . ")\">To Cart</button>";
                        echo "</li>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </ul>
        </div>

        <div id="patientModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closePatientModal()">&times;</span>
                <h2>Pilih Pasien</h2>
                <div class="search">
                    <input type="text" id="searchPatient" placeholder="Cari pasien..." oninput="filterPatients()">
                </div>
                <ul class="patient-list">
                    <?php
                    if ($result_pasien->num_rows > 0) {
                        while ($row = $result_pasien->fetch_assoc()) {
                            echo "<li onclick=\"selectPatient('" . $row["No_RM"] . "', '" . $row["nama_pasien"] . "')\">" . $row["nama_pasien"] . " - " . $row["No_RM"] . "</li>";
                        }
                    } else {
                        echo "<li>Tidak ada data pasien</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        

    </div>
</div>

<script>
    var cart = [];

    function addToCart(name, type, price) {
    var item = cart.find(item => item.name === name);
    if (item) {
        item.quantity++;
    } else {
        cart.push({ name: name, type: type, price: price, quantity: 1 });
    }
    renderCart();
}


function removeFromCart(name) {
    var itemIndex = cart.findIndex(item => item.name === name);
    if (itemIndex > -1) {
        cart.splice(itemIndex, 1);
    }
    renderCart();
}


    function updateQuantity(name, quantity) {
    var item = cart.find(item => item.name === name);
    if (item) {
        item.quantity = quantity;
        if (item.quantity <= 0) {
            removeFromCart(name);
        }
        renderCart();
    }
}


    function renderCart() {
    var cartList = document.getElementById('cart-list');
    cartList.innerHTML = '';
    var total = 0;
    cart.forEach(item => {
        var listItem = document.createElement('li');
        listItem.innerHTML = `<span>${item.name} - Rp. ${item.price} x ${item.quantity} = Rp. ${(item.price * item.quantity).toFixed(2)}</span>
        <div class="quantity-buttons">
            <button onclick="updateQuantity('${item.name}', ${item.quantity - 1})">-</button>
            <span>${item.quantity}</span>
            <button onclick="updateQuantity('${item.name}', ${item.quantity + 1})">+</button>
            <button onclick="removeFromCart('${item.name}')">Remove</button>
        </div>`;
        cartList.appendChild(listItem);
        total += item.price * item.quantity;
    });
    document.getElementById('display-total').innerText = total.toFixed(2);
    document.getElementById('cart-data').value = JSON.stringify(cart);
}


    function setTotalValue() {
        var total = document.getElementById('display-total').innerText;
        document.getElementById('total-value').value = total;
    }

    function showPatientModal() {
        document.getElementById('patientModal').style.display = 'block';
    }

    function closePatientModal() {
        document.getElementById('patientModal').style.display = 'none';
    }

    function selectPatient(No_RM, Nama_pasien) {
        document.getElementById('No_RM').value = No_RM;
        document.getElementById('nama_pasien').value = Nama_pasien;
        closePatientModal();
    }

    function filterPatients() {
        var input = document.getElementById('searchPatient').value.toUpperCase();
        var ul = document.querySelector('.patient-list');
        var li = ul.getElementsByTagName('li');
        for (var i = 0; i < li.length; i++) {
            var txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toUpperCase().indexOf(input) > -1) {
                li[i].style.display = '';
            } else {
                li[i].style.display = 'none';
            }
        }
    }
    function filterItems() {
    var input = document.getElementById('search').value.toUpperCase();
    var ul = document.getElementById('item-list');
    var li = ul.getElementsByTagName('li');
    for (var i = 0; i < li.length; i++) {
        var span = li[i].getElementsByTagName("span")[0];
        var txtValue = span.textContent || span.innerText;
        if (txtValue.toUpperCase().indexOf(input) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

</script>

</body>
</html>
