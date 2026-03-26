<?php
// Menghubungkan ke file koneksi database
include 'koneksi.php';

// Memulai session untuk login petugas
session_start();

// Pengecekan apakah user sudah login sebagai petugas atau belum
if (!isset($_SESSION['login_petugas'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login_petugas.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kari</title>
    <!-- Menghubungkan file CSS -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- Header halaman -->
    <header>
        <h1>Selamat Datang di Website Kami</h1>
    </header>

    <!-- Menu navigasi -->
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="kelola_produk.php">Kelola Produk</a></li>
        <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
        <li><a href="kelola_penjualan.php">Kelola Penjualan</a></li>
        <li><a href="">About</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <!-- Judul halaman -->
    <h2 align="center">DATA PRODUK PENJUALAN</h2>

    <div class="table-container">
        <div>
            <!-- button untuk input penjualan baru -->
            <a href="input_penjualan.php">
                <input type="submit" value="TAMBAH">
            </a>

            <!-- button untuk mencetak laporan penjualan -->
            <a href="cetak_laporan.php">
                <input type="submit" value="CETAK">
            </a>
        </div>

        <!-- Tabel untuk menampilkan data penjualan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Produk</th>
                    <th>Total Bayar</th>
                    <th>Tanggal Beli</th>
                    <th>Nama Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Variabel nomor urut
                $no = 1;

                // Query untuk mengambil data dari tabel penjualan, produk, dan petugas
                $query = mysqli_query($koneksi, "SELECT tbl_penjualan.*, tbl_produk.nama_produk, tbl_petugas.nama_petugas 
                    FROM tbl_penjualan 
                    INNER JOIN tbl_produk ON tbl_penjualan.id_produk = tbl_produk.id_produk 
                    INNER JOIN tbl_petugas ON tbl_penjualan.id_petugas = tbl_petugas.id_petugas 
                    ORDER BY tbl_penjualan.id_penjualan DESC");

                // Perulangan untuk menampilkan data hasil query ke tabel
                while ($data = mysqli_fetch_assoc($query)) :
                ?>
                    <tr>
                        <!-- Menampilkan nomor urut -->
                        <td><?php echo $no++; ?></td>

                        <!-- Menampilkan nama produk -->
                        <td><?php echo $data['nama_produk']; ?></td>

                        <!-- Menampilkan jumlah produk yang dibeli -->
                        <td><?php echo $data['jumlah_produk']; ?></td>

                        <!-- Menampilkan total pembayaran -->
                        <td><?php echo $data['total_bayar']; ?></td>

                        <!-- Menampilkan tanggal pembelian -->
                        <td><?php echo $data['tgl_beli']; ?></td>

                        <!-- Menampilkan nama petugas yang melayani -->
                        <td><?php echo $data['nama_petugas']; ?></td>

                        <td>
                            <!-- button ubah data penjualan -->
                            <a href="ubah_penjualan.php?id_penjualan=<?php echo $data['id_penjualan']; ?>">
                                <input type="submit" value="UBAH" name="btnubah">
                            </a>

                            <!-- button hapus data penjualan dengan konfirmasi terlebih dahulu -->
                            <a class="batal" href="hapus_penjualan.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"
                               onclick="return confirm('Yakin akan menghapus Data?')">HAPUS</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer halaman -->
    <footer>
        <p>&copy; 2024 WebsiteKu. All rights reserved.</p>
    </footer>
</body>

</html>