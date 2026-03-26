<?php
include 'koneksi.php';  // Koneksi ke database
session_start();        // Mulai session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Laporan</title>
    <style>
        /* Styling tabel dan header */
        thead th, thead td {
            vertical-align: middle !important;
            text-align: center;
            border: 1px solid #000000;
        }
        table, tbody th, tbody td {
            border: 1px solid;
            padding: 5px;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">
        <img src="asset/gambar/print.png" width="50" height="50"> Laporan Penjualan
    </h2>

    <table id="data-laporan" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Total Bayar</th>
                <th>Tanggal Beli</th>
                <th>Nama Petugas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;  // Nomor urut baris data
            // Ambil data penjualan gabungan produk dan petugas, urut terbaru dulu
            $query = mysqli_query($koneksi, "SELECT tbl_penjualan.*, tbl_produk.nama_produk, tbl_petugas.nama_petugas 
                FROM tbl_penjualan 
                INNER JOIN tbl_produk ON tbl_penjualan.id_produk = tbl_produk.id_produk 
                INNER JOIN tbl_petugas ON tbl_penjualan.id_petugas = tbl_petugas.id_petugas 
                ORDER BY tbl_penjualan.tgl_beli DESC");
            // Tampilkan data ke dalam tabel baris per baris
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>                      <!-- Nomor -->
                <td><?php echo $data['nama_produk']; ?></td>       <!-- Nama produk -->
                <td><?php echo $data['jumlah_produk']; ?></td>     <!-- Jumlah yang dibeli -->
                <td><?php echo $data['total_bayar']; ?></td>       <!-- Total harga bayar -->
                <td><?php echo $data['tgl_beli']; ?></td>           <!-- Tanggal beli -->
                <td><?php echo $data['nama_petugas']; ?></td>       <!-- Nama petugas -->
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        window.print()  // Otomatis buka dialog cetak saat halaman dimuat
    </script>
</body>
</html>