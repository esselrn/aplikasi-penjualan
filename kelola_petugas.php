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
    <h2 align="center">DATA PETUGAS</h2>

    <div class="table-container">
        <div>
            <!-- button input petugas -->
            <a href="input_petugas.php">
                <input type="submit" value="TAMBAH">
            </a>
        </div>

        <!-- Tabel untuk menampilkan data petugas -->
        <table>
            <tr>
                <thead>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Alamat</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </thead>
            </tr>
            <tbody>
                <?php
                // Variabel untuk nomor urut tabel
                $no = 1;

                // Query untuk menampilkan semua data dari tabel petugas, diurutkan dari id terbesar ke terkecil
                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_petugas ORDER BY id_petugas DESC");

                // Perulangan untuk menampilkan setiap baris data dari hasil query
                while ($data = mysqli_fetch_assoc($tampil)) :
                ?>
                    <tr>
                        <!-- Menampilkan nomor urut -->
                        <td><?php echo $no++; ?></td>

                        <!-- Menampilkan nama petugas -->
                        <td><?php echo $data['nama_petugas']; ?></td>

                        <!-- Menampilkan alamat petugas -->
                        <td><?php echo $data['alamat']; ?></td>

                        <!-- Menampilkan username petugas -->
                        <td><?php echo $data['username']; ?></td>

                        <!-- Menampilkan password petugas -->
                        <td><?php echo $data['password']; ?></td>

                        <!-- Menampilkan level petugas -->
                        <td><?php echo $data['level']; ?></td>

                        <!-- Menampilkan foto petugas -->
                        <td>
                            <a href="images/<?php echo $data['foto']; ?>">
                                <img src="images/<?php echo $data['foto']; ?>" width="60" height="100" alt="">
                            </a>
                        </td>

                        <!-- Kolom aksi untuk ubah dan hapus data petugas -->
                        <td>
                            <!-- button ubah petugas -->
                            <a href="ubah_petugas.php?id_petugas=<?php echo $data['id_petugas']; ?>">
                                <input type="submit" value="UBAH" name="btnUbah">
                            </a>

                            <!-- button hapus petugas dengan konfirmasi sebelum hapus -->
                            <a class="batal" href="hapus_petugas.php?id_petugas=<?php echo $data['id_petugas']; ?>"
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