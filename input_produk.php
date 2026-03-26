<?php
// Menghubungkan ke file koneksi database
include 'koneksi.php';
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
   <h2 align="center">FORM INPUT PRODUK</h2>

   <div class="container">
      <!-- Form untuk input data produk baru -->
      <!-- method="post" artinya data akan dikirim ke file crud_produk.php via POST -->
      <!-- enctype="multipart/form-data" dipakai karena ada upload gambar -->
      <form action="crud_produk.php" method="post" enctype="multipart/form-data">

         <!-- Input Nama Produk -->
         <div class="row">
            <div class="col-25">
               <label for="">Nama Produk</label>
            </div>
            <div class="col-75">
               <input type="text" name="nama_produk">
            </div>
         </div>

         <!-- Input Kategori Produk menggunakan dropdown -->
         <div class="row">
            <div class="col-25">
               <label for="">Kategori Produk</label>
            </div>
            <div class="col-75">
               <select id="" name="kategori_produk">
                  <option value="makanan">Makanan</option>
                  <option value="minuman">Minuman</option>
                  <option value="fashion">Fashion</option>
               </select>
            </div>
         </div>

         <!-- Input Jumlah Stok -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Jumlah Stok</label>
            </div>
            <div class="col-75">
               <input type="text" name="jumlah_stok">
            </div>
         </div>

         <!-- Input Harga Jual -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Harga Jual</label>
            </div>
            <div class="col-75">
               <input type="text" name="harga">
            </div>
         </div>

         <!-- Input Diskon -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Diskon</label>
            </div>
            <div class="col-75">
               <input type="text" name="diskon">
            </div>
         </div>

         <!-- Input Harga Pokok -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Harga Pokok</label>
            </div>
            <div class="col-75">
               <input type="text" name="harga_pokok">
            </div>
         </div>

         <!-- Input Upload Gambar Produk -->
         <div class="row">
            <div class="col-25">
               <label for="fname">Gambar Produk</label>
            </div>
            <div class="col-75">
               <input type="file" name="gambar" accept="image/*" value="">
            </div>
         </div>

         <br>

         <!-- Tombol SIMPAN untuk kirim data, dan RESET untuk mengosongkan form -->
         <div class="row">
            <!-- button simpan dan reset input produk -->
            <input type="submit" class="tombol" value="SIMPAN" name="btnSimpan">
            <input type="reset" value="RESET">
         </div>
      </form>
   </div>

   <!-- Footer -->
   <footer>
      <p>&copy; 2025 WebsiteKu. All rights reserved.</p>
   </footer>

</body>
</html>