<?php
include 'koneksi.php';  // Hubungkan ke database

session_start();
// Cek apakah user sudah login sebagai petugas, jika belum arahkan ke loginpetugas.php
if (!isset($_SESSION['login_petugas'])) {
    header("Location: loginpetugas.php");
    exit;
}

// Cek apakah ada id_penjualan yang dikirimkan melalui GET (misal untuk edit data)
$id_penjualan = isset($_GET['id_penjualan']) ? $_GET['id_penjualan'] : null;
$produk_terpilih = null; // Untuk menyimpan produk yang dipilih saat edit

if ($id_penjualan) {
    // Ambil data penjualan yang akan diedit dari database
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_penjualan WHERE id_penjualan = '$id_penjualan'");
    $data_penjualan = mysqli_fetch_assoc($query);
    $produk_terpilih = $data_penjualan['id_produk']; // Ambil id_produk yang sudah terpilih sebelumnya
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Kari</title>
    <link rel="stylesheet" href="style.css" />

    <script>
        // Fungsi menampilkan harga produk sesuai pilihan dropdown
        function tampilkanHarga() {
            var select = document.getElementById("nama_produk");
            var hargaInput = document.getElementById("harga_produk");
            var selectedOption = select.options[select.selectedIndex];
            hargaInput.value = selectedOption.getAttribute("data-harga"); // Ambil harga dari atribut data-harga

            // Update total bayar setelah harga berubah
            hitungTotalBayar();
        }

        // Fungsi menghitung total bayar (harga * jumlah)
        function hitungTotalBayar() {
            var harga = parseFloat(document.getElementById("harga_produk").value);
            var jumlah = parseInt(document.getElementById("jumlah_produk").value);

            if (!isNaN(harga) && !isNaN(jumlah) && jumlah > 0) {
                var totalBayar = harga * jumlah;
                document.getElementById("total_bayar").value = totalBayar;
            } else {
                document.getElementById("total_bayar").value = ''; // Kosongkan jika input tidak valid
            }
        }

        // Saat halaman pertama kali dimuat, set harga dan total bayar jika ada produk yang sudah dipilih
        window.onload = function () {
            var select = document.getElementById("nama_produk");
            var hargaInput = document.getElementById("harga_produk");
            var selectedOption = select.options[select.selectedIndex];
            if (selectedOption.value !== "") {
                var harga = selectedOption.getAttribute("data-harga");
                hargaInput.value = harga;
                hitungTotalBayar();
            }
        };
    </script>
</head>

<body>
    <header>
        <h1>Selamat Datang di Website Kami</h1>
    </header>

    <!-- Menu Navigasi -->
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="kelola_produk.php">Kelola Produk</a></li>
        <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
        <li><a href="kelola_penjualan.php">Kelola Penjualan</a></li>
        <li><a href="#">About</a></li>
        <li><a href="logout_petugas.php">Logout</a></li>
    </ul>

    <h2 align="center">FORM UBAH PENJUALAN</h2>
    <div class="table-container">
        <?php
        // Ambil data penjualan dari database berdasarkan id_penjualan
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_penjualan WHERE id_penjualan = '$id_penjualan'");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <form action="crud_penjualan.php" method="post" enctype="multipart/form-data">
                <!-- Input hidden menyimpan id_penjualan untuk proses update -->
                <input type="hidden" name="id_penjualan" value="<?php echo $data['id_penjualan']; ?>">

                <!-- Dropdown pilih produk -->
                <div class="row">
                    <div class="col-25">
                        <label for="nama_produk">Nama Produk</label>
                    </div>
                    <div class="col-75">
                        <select id="nama_produk" name="nama_produk" onchange="tampilkanHarga()">
                            <option value="">Pilih Produk</option>
                            <?php
                            // Ambil semua produk dari database untuk ditampilkan di dropdown
                            $qproduk = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
                            while ($dproduk = mysqli_fetch_assoc($qproduk)) :
                                // Set selected jika produk sama dengan produk yang sudah dipilih (untuk edit)
                                $selected = ($dproduk['id_produk'] == $produk_terpilih) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $dproduk['id_produk']; ?>" data-harga="<?php echo $dproduk['harga']; ?>" <?php echo $selected; ?>>
                                    <?php echo $dproduk['nama_produk']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <!-- Input harga produk (readonly) -->
                <div class="row">
                    <div class="col-25">
                        <label for="harga_produk">Harga Produk</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="harga_produk" id="harga_produk" readonly>
                    </div>
                </div>

                <!-- Input jumlah produk -->
                <div class="row">
                    <div class="col-25">
                        <label for="jumlah_produk">Jumlah Produk</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="jumlah_produk" name="jumlah_produk" oninput="hitungTotalBayar()" min="1" required>
                    </div>
                </div>

                <!-- Input total bayar (readonly) -->
                <div class="row">
                    <div class="col-25">
                        <label for="total_bayar">Total Bayar</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="total_bayar" id="total_bayar" readonly>
                    </div>
                </div>

                <br>
                <div class="row">
                    <!-- Tombol simpan untuk update data penjualan -->
                    <input type="submit" class="tombol" value="SIMPAN" name="btnUbah">
                    <!-- Tombol reset untuk membersihkan form -->
                    <input type="reset" class="reset" value="RESET">
                </div>
            </form>
        <?php } ?>
    </div>

    <footer>
        <p>&copy; 2024 WebsiteKu. All rights reserved.</p>
    </footer>
</body>

</html>