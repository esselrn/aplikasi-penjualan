<?php
// Menghubungkan ke database
include 'koneksi.php';

// Memulai session
session_start();

// Mengecek apakah user sudah login atau belum
if (!isset($_SESSION['login'])) {
    // Kalau belum login, redirect ke halaman login
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kari</title>
    <!-- Menghubungkan file Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar menggunakan Bootstrap -->
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <!-- Brand / Judul aplikasi -->
        <a class="navbar-brand" href="#">Aplikasi Penjualan</a>
        
        <!-- Tombol untuk mobile menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi menu navigasi -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Link menu About -->
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <!-- Link ke halaman katalog produk -->
                <li class="nav-item"><a class="nav-link" href="katalog_produk.php">Katalog Produk</a></li>
                <!-- Link logout -->
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<br><br>

<!-- Container untuk isi halaman -->
<div class="container">
    <div class="row">
        <!-- Breadcrumb kosong (bisa diisi kalau mau navigasi tambahan) -->
        <nav class="page-breadcrumb">
            <div class="row"></div>
        </nav>

        <?php
        // Query untuk mengambil data produk dari tabel produk
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_produk ORDER BY id_produk DESC");

        // Perulangan untuk menampilkan tiap produk ke dalam card
        while ($data = mysqli_fetch_assoc($query)) :
        ?>
        <!-- Tiap produk ditampilkan dalam kolom -->
        <div class="col-md-4 col-12 mb-4 mt-4">
            <!-- Card Bootstrap untuk menampilkan produk -->
            <div class="card" style="width: 18rem;">
                <!-- Menampilkan gambar produk -->
                <img src="images/<?php echo $data['gambar']; ?>" width="200px" height="300px" class="card-img-top" alt="">

                <!-- Body card berisi nama produk dan harga -->
                <div class="card-body">
                    <!-- Menampilkan nama produk -->
                    <h5 class="card-title text-primary"><?php echo $data['nama_produk']; ?></h5>
                    <!-- Menampilkan harga produk -->
                    <p class="card-text text-secondary"><?php echo $data['harga']; ?></p>
                </div>

                <!-- List group untuk kategori dan diskon -->
                <ul class="list-group list-group-flush">
                    <!-- Menampilkan kategori produk -->
                    <li class="list-group-item">Kategori: <?php echo $data['kategori_produk']; ?></li>
                    <!-- Menampilkan diskon produk -->
                    <li class="list-group-item">Diskon: <?php echo $data['diskon']; ?></li>
                </ul>
            </div>
        </div>
        <?php endwhile; ?>
    </div> <!-- Penutup div row -->
</div>

<!-- Menghubungkan file JavaScript Bootstrap dan jQuery -->
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/jquery.min.js"></script>

</body>
</html>
