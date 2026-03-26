<?php
include 'koneksi.php'; // Hubungkan ke database

$id_produk = $_GET['id_produk']; // Ambil id produk dari URL

// Ambil data produk sesuai id_produk untuk mendapatkan nama file gambar
$query = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
$ambil = mysqli_fetch_assoc($query);

// Hapus file gambar produk dari folder 'images'
unlink('images/' . $ambil['gambar']);

// Hapus data produk dari database berdasarkan id_produk
$hapus = mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id_produk = '$id_produk'");

// Cek apakah penghapusan berhasil atau tidak
if ($hapus) {
    echo "<script>alert('Data produk berhasil dihapus'); document.location='kelola_produk.php';</script>";
} else {
    echo "<script>alert('Data produk gagal dihapus'); document.location='kelola_produk.php';</script>";
}
?>