<?php
session_start();
include "../includes/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username atau password tidak boleh kosong'); window.location.href = '../index.php';</script>";
        exit();
    }

    // Query untuk mendapatkan data user
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verifikasi password
            if (password_verify($password, $row['password'])) {
                // Set session
                $_SESSION['username'] = $row['username'];

                // Redirect ke halaman index.php
                header("Location: ../pages/index.php");
                exit();
            } else {
                echo "<script>alert('Password salah'); window.location.href = '../index.php';</script>";
            }
        } else {
            echo "<script>alert('Username tidak ditemukan'); window.location.href = '../index.php';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Terjadi kesalahan pada sistem, silakan coba lagi'); window.location.href = '../index.php';</script>";
    }

    mysqli_close($koneksi);
}
?>
