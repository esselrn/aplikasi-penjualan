<?php
// Menghubungkan ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Toko Kari</title>
   <!-- Panggil file CSS -->
   <link rel="stylesheet" href="style.css" />
</head>

<body>
   <!-- Bagian header -->
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
      <li><a href="logout.php">Logout</a></li>
   </ul>

   <!-- Judul Halaman -->
   <h2 align="center">FORM INPUT PETUGAS</h2>

   <div class="container">
      <!-- Form input petugas -->
      <!-- method POST dan enctype multipart buat kirim data + upload gambar -->
      <form action="crud_petugas.php" method="post" enctype="multipart/form-data">
         
         <!-- Input Nama Petugas -->
         <div class="row">
            <div class="col-25">
               <label for="">Nama Petugas</label>
            </div>
            <div class="col-75">
               <input type="text" name="nama_petugas">
            </div>
         </div>

         <!-- Input Alamat -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Alamat</label>
            </div>
            <div class="col-75">
               <input type="text" name="alamat">
            </div>
         </div>

         <!-- Input Username -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Username</label>
            </div>
            <div class="col-75">
               <input type="text" name="username">
            </div>
         </div>

         <!-- Input Password -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Password</label>
            </div>
            <div class="col-75">
               <input type="text" name="password">
            </div>
         </div>

         <!-- Pilihan Level (dropdown) -->
         <div class="row">
            <div class="col-25">
               <label for="">Level</label>
            </div>
            <div class="col-75">
               <select id="" name="level">
                  <option value="admin">Admin</option>
                  <option value="petugas">Petugas</option>
               </select>
            </div>
         </div>

         <!-- Upload Foto -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Foto</label>
            </div>
            <div class="col-75">
               <!-- accept="images/*" buat batasi file ke gambar -->
               <input type="file" name="foto" accept="images/*" value="">
            </div>
         </div>

         <br>

         <!-- Tombol SIMPAN dan RESET -->
         <div class="row">
            <input type="submit" class="tombol" value="SIMPAN" name="btnSimpan">
            <input type="reset" value="RESET">
         </div>
      </form>
   </div>

   <!-- Bagian footer -->
   <footer>
      <p>&copy; 2025 WebsiteKu. All rights reserved.</p>
   </footer>

</body>

</html>
