<?php
include 'koneksi.php';
session_start();

// Jika sudah login, langsung arahkan ke beranda.php agar tidak bisa balik ke halaman login
if (isset($_SESSION['login_petugas'])) {
   header("Location: beranda.php");
   exit;
}

// Jika tombol login ditekan
if (isset($_POST['btnMasuk'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // Ambil data petugas sesuai username yang dimasukkan
   $data = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE username = '$username'");

   if (mysqli_num_rows($data) === 1) {
      $baris = mysqli_fetch_assoc($data);

      // Cek password yang dimasukkan dengan password di database (plain text)
      if ($password == $baris['password']) {
         // Set session supaya petugas dianggap sudah login
         $_SESSION['id_petugas'] = $baris['id_petugas'];
         $_SESSION['login_petugas'] = true;

         // Redirect ke halaman beranda setelah login berhasil
         header("Location: beranda.php");
         exit;
      } else {
         // Jika password salah, tampilkan alert
         echo "<script>alert('Username atau Password anda salah!')</script>";
      }
   } else {
      // Jika username tidak ditemukan, tampilkan alert
      echo "<script>alert('Username atau Password anda salah!')</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Toko Kari</title>
   <link rel="stylesheet" href="style_login.css" />
</head>

<body>
   <div class="login-container">
      <h2>Silahkan Login</h2>
      <form action="" method="post">
         <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Masukan Username" required />
         </div>
         <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Masukan Password" required />
         </div>
         <button type="submit" name="btnMasuk">Masuk</button>
      </form>
   </div>
</body>

</html>