<?php
include 'koneksi.php';

// Ambil id_penjualan dari URL
$id_penjualan = $_GET['id_penjualan'];

// Ambil data penjualan berdasarkan id_penjualan (opsional, bisa dipakai jika perlu)
$query = mysqli_query($koneksi, "SELECT * FROM tbl_penjualan WHERE id_penjualan = '$id_penjualan'");
$ambil = mysqli_fetch_assoc($query);

// Hapus data penjualan dari database
$hapus = mysqli_query($koneksi, "DELETE FROM tbl_penjualan WHERE id_penjualan = '$id_penjualan'");

// Jika berhasil hapus, tampilkan pesan sukses dan kembali ke halaman kelola penjualan
if ($hapus) {
    echo "<script>alert('Data penjualan berhasil dihapus'); document.location='kelola_penjualan.php';</script>";
} else {
    // Jika gagal hapus, tampilkan pesan gagal dan tetap di halaman kelola penjualan
    echo "<script>alert('Data penjualan gagal dihapus'); document.location='kelola_penjualan.php';</script>";
}
?>