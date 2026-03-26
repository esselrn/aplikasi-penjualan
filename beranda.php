<?php
include 'koneksi.php';          // Koneksi ke database
session_start();                // Mulai session

// Cek apakah petugas sudah login, jika belum redirect ke halaman login
if (!isset($_SESSION['login_petugas'])) {
    header("Location: login_petugas.php");
}

// Ambil data jumlah produk dari tabel tbl_produk
$data1 = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
$jmlproduk = mysqli_num_rows($data1);

// Ambil data jumlah penjualan dari tabel tbl_penjualan
$data2 = mysqli_query($koneksi, "SELECT * FROM tbl_penjualan");
$jmlpenjualan = mysqli_num_rows($data2);

// Ambil data jumlah petugas dari tabel tbl_petugas
$data3 = mysqli_query($koneksi, "SELECT * FROM tbl_petugas");
$jmlpetugas = mysqli_num_rows($data3);

// Ambil data jumlah user dari tabel tbl_user
$data4 = mysqli_query($koneksi, "SELECT * FROM tbl_user");
$jmluser = mysqli_num_rows($data4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Kari - Dashboard</title>
    <!-- Import CSS Bootstrap dan DataTables -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/datatables.min.css">
    <link rel="stylesheet" href="asset/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="asset/css/jquery.dataTables.min.css">
</head>
<body>

<!-- Navigasi bar -->
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Aplikasi Penjualan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu navigasi -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="kelola_produk.php">Kelola Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="kelola_petugas.php">Kelola Petugas</a></li>
            <li class="nav-item"><a class="nav-link" href="kelola_penjualan.php">Kelola Penjualan</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="logout_petugas.php">Logout</a></li>
        </ul>
    </div>
</nav>

<br><br>

<!-- Container untuk kartu info jumlah data -->
<div class="container">
    <div class="row">
        <!-- Kartu jumlah produk -->
        <div class="col-3">
            <div class="card bg-warning text-white text-center">
                <div class="card-body">
                    <h5><?php echo $jmlproduk; ?></h5>  <!-- Tampilkan jumlah produk -->
                </div>
                <div class="card-footer">
                    <h6>Jumlah Produk</h6>
                </div>
            </div>
        </div>

        <!-- Kartu jumlah penjualan -->
        <div class="col-3">
            <div class="card bg-secondary text-white text-center">
                <div class="card-body">
                    <h5><?php echo $jmlpenjualan; ?></h5> <!-- Tampilkan jumlah penjualan -->
                </div>
                <div class="card-footer">
                    <h6>Jumlah Penjualan</h6>
                </div>
            </div>
        </div>

        <!-- Kartu jumlah petugas -->
        <div class="col-3">
            <div class="card bg-success text-white text-center">
                <div class="card-body">
                    <h5><?php echo $jmlpetugas; ?></h5> <!-- Tampilkan jumlah petugas -->
                </div>
                <div class="card-footer">
                    <h6>Jumlah Petugas</h6>
                </div>
            </div>
        </div>

        <!-- Kartu jumlah user -->
        <div class="col-3">
            <div class="card bg-danger text-white text-center">
                <div class="card-body">
                    <h5><?php echo $jmluser; ?></h5> <!-- Tampilkan jumlah user -->
                </div>
                <div class="card-footer">
                    <h6>Jumlah User</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<!-- Import JS Bootstrap dan jQuery DataTables -->
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/datatables.min.js"></script>
<script src="asset/js/dataTables.responsive.min.js"></script>
<script src="asset/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable dengan fitur responsif (jika ada tabel dengan id dataBooking)
        $('#dataBooking').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>