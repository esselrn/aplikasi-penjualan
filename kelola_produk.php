<?php
// Menghubungkan file koneksi database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kari</title>
    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- Header halaman -->
    <header>
        <h1>Selamat Datang di Website Kami</h1>
    </header>

    <!-- Navigasi menu -->
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="kelola_produk.php">Kelola Produk</a></li>
        <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
        <li><a href="kelola_penjualan.php">Kelola Penjualan</a></li>
        <li><a href="">About</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <!-- Judul halaman -->
    <h2 align="center">DATA PRODUK</h2>

    <div class="table-container">
        <div>
            <!-- Tombol untuk menuju halaman input produk baru -->
            <a href="input_produk.php">
                <input type="submit" value="TAMBAH">
            </a>
        </div>

        <!-- Tabel untuk menampilkan data produk dari database -->
        <table>
            <tr>
                <thead>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Jumlah Stok</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Harga Pokok</th>
                    <th>Gambar Produk</th>
                    <th>Aksi</th>
                </thead>
            </tr>
            <tbody>
                <?php
                // Variabel untuk nomor urut tabel
                $no = 1;

                // Query untuk menampilkan semua data dari tabel produk, diurutkan dari id terbesar ke terkecil
                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_produk ORDER BY id_produk DESC");

                // Perulangan untuk menampilkan setiap baris data dari hasil query
                while ($data = mysqli_fetch_assoc($tampil)) :
                ?>
                    <tr>
                        <!-- Menampilkan nomor urut -->
                        <td><?php echo $no++; ?></td>

                        <!-- Menampilkan nama produk -->
                        <td><?php echo $data['nama_produk']; ?></td>

                        <!-- Menampilkan kategori produk -->
                        <td><?php echo $data['kategori_produk']; ?></td>

                        <!-- Menampilkan jumlah stok -->
                        <td><?php echo $data['jumlah_stok']; ?></td>

                        <!-- Menampilkan harga produk -->
                        <td><?php echo $data['harga']; ?></td>

                        <!-- Menampilkan diskon produk -->
                        <td><?php echo $data['diskon']; ?></td>

                        <!-- Menampilkan harga pokok produk -->
                        <td><?php echo $data['harga_pokok']; ?></td>

                        <!-- Menampilkan gambar produk -->
                        <td>
                            <a href="images/<?php echo $data['gambar']; ?>">
                                <img src="images/<?php echo $data['gambar']; ?>" width="60" height="100" alt="">
                            </a>
                        </td>

                        <!-- Kolom aksi untuk ubah dan hapus data produk -->
                        <td>
                            <!-- button ubah produk -->
                            <a href="ubah_produk.php?id_produk=<?php echo $data['id_produk']; ?>">
                                <input type="submit" value="UBAH" name="btnUbah">
                            </a>

                            <!-- button hapus produk dengan konfirmasi sebelum hapus -->
                            <a class="batal" href="crud_hapus.php?id_produk=<?php echo $data['id_produk']; ?>"
                               onclick="return confirm('Yakin akan menghapus Data?')">HAPUS
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer halaman -->
    <footer>
        <p>&copy; 2025 WebsiteKu. All rights reserved.</p>
    </footer>
</body>

</html>