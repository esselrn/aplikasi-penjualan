<?php
include 'koneksi.php';
session_start();

// Jika sudah login, langsung ke halaman katalog
if (isset($_SESSION['login'])) {
   header("Location: katalog_produk.php");
   exit;
}

if (isset($_POST['btnMasuk'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // Cari user berdasarkan username
   $result = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

   if (mysqli_num_rows($result) == 1) {
      $user = mysqli_fetch_assoc($result);

      // Cek password (saat ini masih plain text)
      if ($password == $user['password']) {
         // Set session login
         $_SESSION['id_user'] = $user['id_user'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['login'] = true;

         // Redirect ke katalog produk
         header("Location: katalog_produk.php");
         exit;
      } else {
         echo "<script>alert('Username atau password salah!');</script>";
      }
   } else {
      echo "<script>alert('Username atau password salah!');</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <title>Toko Kari</title>
   <link rel="stylesheet" href="style_login.css" />
</head>
<body>
   <div class="login-container">
      <h2>Silahkan Login</h2>
      <form method="post">
         <label>Username</label><br />
         <input type="text" name="username" required /><br />
         <label>Password</label><br />
         <input type="password" name="password" required /><br /><br />
         <button name="btnMasuk">Masuk</button>
      </form>
      <p><center>Belum punya akun? <a href="daftar.php">Daftar Disini!</a></center></p>
   </div>
</body>
</html>