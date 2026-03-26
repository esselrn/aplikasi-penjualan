<?php
// Menghubungkan ke file koneksi database
include 'koneksi.php';

// Memulai session
session_start();

// Mengecek apakah petugas sudah login, kalau belum redirect ke halaman login
if (!isset($_SESSION['login_petugas'])) {
    header("Location: login_petugas.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Toko Kari</title>
    <!-- Menghubungkan file CSS -->
    <link rel="stylesheet" href="style.css" />
    
    <script>
        // Fungsi untuk menampilkan harga produk ketika produk dipilih
        function tampilkanHarga() {
            var select = document.getElementById("nama_produk");
            var hargaInput = document.getElementById("harga_produk");
            var selectedoption = select.options[select.selectedIndex];
            var harga = selectedoption.getAttribute("data-harga"); // Ambil harga dari atribut data-harga
            hargaInput.value = harga; // Tampilkan harga di input harga produk

            // Panggil fungsi untuk menghitung total bayar setelah harga muncul
            hitungTotalBayar();
        }

        // Fungsi untuk menghitung total bayar
        function hitungTotalBayar() {
            var harga = parseFloat(document.getElementById("harga_produk").value); // Ambil harga produk
            var jumlah = parseInt(document.getElementById("jumlah_produk").value); // Ambil jumlah produk

            // Jika input harga dan jumlah valid, hitung total bayar
            if (!isNaN(harga) && !isNaN(jumlah) && jumlah > 0) {
                var totalBayar = harga * jumlah;
                document.getElementById("total_bayar").value = totalBayar; // Tampilkan hasil total bayar
            } else {
                // Jika input kosong atau tidak valid, kosongkan total bayar
                document.getElementById("total_bayar").value = '';
            }
        }
    </script>
</head>

<body>
    <header>
        <h1>Selamat Datang di Website Kami</h1>
    </header>

    <!-- Menu navigasi -->
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="kelola_produk.php">Kelola Produk</a></li>
        <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
        <li><a href="kelola_penjualan.php">Kelola Penjualan</a></li>
        <li><a href="#">About</a></li>
        <li><a href="logout_petugas.php">Logout</a></li>
    </ul>

    <!-- Judul halaman -->
    <h2 align="center">FORM INPUT PENJUALAN</h2>

    <div class="container">
        <!-- Form untuk input data penjualan -->
        <form action="crud_penjualan.php" method="post" enctype="multipart/form-data">

            <!-- Form pilih nama produk -->
            <div class="row">
                <div class="col-25">
                    <label for="">Nama Produk</label>
                </div>
                <div class="col-75">
                    <select id="nama_produk" name="nama_produk" onchange="tampilkanHarga()">
                        <option value="">Pilih Produk</option>
                        <?php
                        // Ambil data produk dari database
                        $qproduk = mysqli_query($koneksi, "SELECT *FROM tbl_produk");
                        while ($dproduk = mysqli_fetch_assoc($qproduk)):
                        ?>
                            <!-- Menampilkan nama produk di dropdown, harga disimpan di atribut data-harga -->
                            <option value="<?php echo $dproduk['id_produk']; ?>" data-harga="<?php echo $dproduk['harga']; ?>">
                                <?php echo $dproduk['nama_produk']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <!-- Form input harga produk (readonly) -->
            <div class="row">
                <div class="col-25">
                    <label for="fname">Harga Produk</label>
                </div>
                <div class="col-75">
                    <input type="text" name="harga_produk" id="harga_produk" readonly>
                </div>
            </div>

            <!-- Form input jumlah produk -->
            <div class="row">
                <div class="col-25">
                    <label for="fname">Jumlah Produk</label>
                </div>
                <div class="col-75">
                    <!-- Saat input jumlah produk diisi, langsung panggil fungsi hitung total bayar -->
                    <input type="text" id="jumlah_produk" name="jumlah_produk" oninput="hitungTotalBayar()">
                </div>
            </div>

            <!-- Form total bayar (readonly) -->
            <div class="row">
                <div class="col-25">
                    <label for="fname">Total Bayar</label>
                </div>
                <div class="col-75">
                    <input type="text" name="total_bayar" id="total_bayar" readonly>
                </div>
            </div>

            <br>
            <!-- Tombol simpan untuk kirim data ke crud_penjualan.php -->
            <div class="row">
                <input type="submit" class="tombol" value="SIMPAN" name="btnSimpan" style="display: block;">
                <!-- Tombol reset untuk mengosongkan form -->
                <input type="reset" value="RESET">
            </div>
        </form>
    </div>

    <!-- Footer halaman -->
    <footer>
        <p>&copy;2024 Websiteku. All rights reserved.</p>
    </footer>
</body>

</html>