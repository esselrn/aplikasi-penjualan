<?php
include 'koneksi.php';

// Ambil id_petugas dari URL
$id_petugas = $_GET['id_petugas'];

// Ambil data petugas berdasarkan id_petugas
$query = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE id_petugas = '$id_petugas'");
$ambil = mysqli_fetch_assoc($query);

// Hapus file foto petugas dari folder 'images'
unlink('images/' . $ambil['foto']);

// Hapus data petugas dari database
$hapus = mysqli_query($koneksi, "DELETE FROM tbl_petugas WHERE id_petugas = '$id_petugas'");

// Jika berhasil hapus, tampilkan pesan sukses dan kembali ke halaman kelola petugas
if ($hapus) {
    echo "<script>alert('Data petugas berhasil dihapus'); document.location='kelola_petugas.php';</script>";
} else {
    // Jika gagal hapus, tampilkan pesan gagal dan tetap di halaman kelola petugas
    echo "<script>alert('Data petugas gagal dihapus'); document.location='kelola_petugas.php';</script>";
}
?>