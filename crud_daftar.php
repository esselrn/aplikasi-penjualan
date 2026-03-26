<?php
include 'koneksi.php'; // Koneksi ke database

if (isset($_POST['btnDaftar'])) {  // Cek jika tombol daftar ditekan
   // Ambil data input dari form
   $nama_lengkap = $_POST['nama_lengkap'];
   $telp = $_POST['telp'];
   $alamat = $_POST['alamat'];
   $username = $_POST['username'];
   $password = $_POST['password'];
   $password2 = $_POST['password2'];

   // Cek apakah username sudah ada di database
   $cek_username = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");

   if (mysqli_fetch_assoc($cek_username)) {
      // Jika username sudah digunakan, tampilkan pesan
      echo "<script>alert('Username sudah digunakan')</script>";
   } else if ($password != $password2) {
      // Jika password dan konfirmasi password tidak sama, tampilkan pesan
      echo "<script>alert('Password tidak sama')</script>";
   } else {
      // Jika validasi lolos, simpan data ke tabel tbl_user
      $simpan = mysqli_query($koneksi, "INSERT INTO tbl_user (nama_lengkap, telp, alamat, username, password) VALUES ('$nama_lengkap', '$telp', '$alamat', '$username', '$password')");
      if ($simpan) {
         // Jika berhasil simpan, tampilkan pesan sukses dan arahkan ke halaman login
         echo "<script>alert('Data Akun Berhasil Dibuat'); document.location='index.php';</script>";
      } else {
         // Jika gagal simpan, tampilkan pesan gagal dan arahkan ke halaman login
         echo "<script>alert('Data Akun Gagal Dibuat'); document.location='index.php';</script>";
      }
   }
}
?>