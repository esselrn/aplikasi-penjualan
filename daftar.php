<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8"> <!-- Set karakter encoding UTF-8 -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Agar halaman responsif di semua perangkat -->
   <title>Toko Kari</title> <!-- Judul halaman -->
   <link rel="stylesheet" href="style_login.css" /> <!-- Hubungkan ke file CSS untuk styling -->
</head>

<body>
   <div class="login-container">
      <h2>Silahkan Daftar</h2> <!-- Judul form daftar -->
      <form action="crud_daftar.php" method="post"> <!-- Form mengirim data ke crud_daftar.php menggunakan metode POST -->
         <div class="input-group">
            <label for="nama_lengkap">Nama Lengkap</label> <!-- Label untuk input nama lengkap -->
            <input type="text" name="nama_lengkap" placeholder="Masukan Nama Lengkap" required> <!-- Input teks untuk nama lengkap, wajib diisi -->
         </div>
         <div class="input-group">
            <label for="telp">No Handphone</label> <!-- Label untuk input nomor telepon -->
            <input type="text" name="telp" placeholder="Masukan No Handphone" required> <!-- Input teks untuk nomor telepon, wajib diisi -->
         </div>
         <div class="input-group">
            <label for="alamat">Alamat</label> <!-- Label untuk input alamat -->
            <input type="text" name="alamat" placeholder="Masukan Alamat" required> <!-- Input teks untuk alamat, wajib diisi -->
         </div>
         <div class="input-group">
            <label for="username">Username</label> <!-- Label untuk input username -->
            <input type="text" name="username" placeholder="Masukan Username" required> <!-- Input teks untuk username, wajib diisi -->
         </div>
         <div class="input-group">
            <label for="password">Password</label> <!-- Label untuk input password -->
            <input type="password" name="password" placeholder="Masukan Password" required> <!-- Input password, wajib diisi -->
         </div>
         <div class="input-group">
            <label for="password2">Ulangi Password</label> <!-- Label untuk konfirmasi password -->
            <input type="password" name="password2" placeholder="Ulangi Password" required> <!-- Input password untuk konfirmasi, wajib diisi -->
         </div>
         <button type="submit" name="btnDaftar">Daftar</button> <!-- Tombol untuk submit form -->
         <p><center>Sudah punya akun? <a href="index.php">Login Disini!</a></center></p> <!-- Link untuk pindah ke halaman login -->
      </form>
   </div>
</body>
</html>
