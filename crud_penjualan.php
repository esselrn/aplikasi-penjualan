<?php
include 'koneksi.php';
session_start(); // Mulai session untuk ambil data login petugas

// Jika tombol Simpan ditekan, simpan data penjualan baru
if (isset($_POST['btnSimpan'])) {
    $id_petugas = $_SESSION['id_petugas']; // Ambil id petugas dari session
    $id_produk = $_POST['nama_produk']; // Ambil produk yang dibeli
    $jumlah_produk = $_POST['jumlah_produk']; // Jumlah produk yang dibeli
    $total_bayar = $_POST['total_bayar']; // Total bayar
    $tgl_beli = date('Y-m-d'); // Tanggal beli hari ini

    // Simpan data penjualan ke database
    $query = mysqli_query($koneksi, "INSERT INTO tbl_penjualan (id_petugas, id_produk, jumlah_produk, total_bayar, tgl_beli)
    VALUES ('$id_petugas', '$id_produk', '$jumlah_produk', '$total_bayar', '$tgl_beli')");

    if ($query) {
        // Jika berhasil simpan, tampilkan pesan dan arahkan ke halaman kelola penjualan
        echo "<script> alert('Data penjualan produk berhasil disimpan');document.location='kelola_penjualan.php'; </script>";
    } else {
        // Jika gagal, tampilkan pesan error dan arahkan ke halaman kelola penjualan
        echo "<script> alert('Data penjualan produk gagal disimpan');document.location='kelola_penjualan.php'; </script>";
    }
}

// Jika tombol Ubah ditekan, update data penjualan
if (isset($_POST['btnUbah'])) {
    $id_penjualan = $_POST['id_penjualan']; // Ambil id penjualan yang akan diubah
    $id_petugas = $_SESSION['id_petugas']; // Ambil id petugas dari session
    $id_produk = $_POST['nama_produk']; // Produk baru atau sama
    $jumlah_produk = $_POST['jumlah_produk']; // Jumlah produk baru atau sama
    $total_bayar = $_POST['total_bayar']; // Total bayar baru atau sama
    $tgl_beli = date('Y-m-d'); // Tanggal update (hari ini)

    // Update data penjualan di database sesuai id_penjualan
    $query = mysqli_query($koneksi, "UPDATE tbl_penjualan SET id_petugas = '$id_petugas', id_produk = '$id_produk',
    jumlah_produk = '$jumlah_produk', total_bayar = '$total_bayar', tgl_beli = '$tgl_beli' WHERE id_penjualan = '$id_penjualan'");

    if ($query) {
        echo "<script>alert('Data berhasil diubah');document.location='kelola_penjualan.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah');document.location='kelola_penjualan.php';</script>";
    }
}
?>