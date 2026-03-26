<?php
// Menghubungkan ke database dengan file koneksi.php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Toko Kari</title>
  <!-- Menghubungkan file CSS untuk styling -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <h1>Selamat Datang di Website Kami</h1>
  </header>

  <!-- Menu navigasi -->
  <ul>
    <li><a href="beranda.php">Beranda</a></li>
    <li><a href="kelola_produk.php">Kelola Produk</a></li>
    <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
    <li><a href="kelola_penjualan.php">Kelola Penjualan</a></li>
    <li><a href="">About</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>

  <!-- Judul halaman untuk form ubah petugas -->
  <h2 align="center">FORM UBAH PETUGAS</h2>

  <div class="container">
    <?php
    // Mengambil data id_petugas dari URL menggunakan metode GET
    $id_petugas = $_GET['id_petugas'];

    // Query untuk mengambil data petugas berdasarkan id_petugas
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE id_petugas = '$id_petugas'");

    // Menampilkan form edit petugas dengan data yang sudah diambil
    while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <form action="crud_petugas.php" method="post" enctype="multipart/form-data">
      <!-- Input hidden untuk menyimpan id petugas dan foto lama -->
      <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas']; ?>">
      <input type="hidden" name="foto" value="<?php echo $data['foto']; ?>">

      <!-- Input nama petugas -->
      <div class="row">
        <div class="col-25">
          <label for="">Nama Petugas</label>
        </div>
        <div class="col-75">
          <input type="text" name="nama_petugas" value="<?php echo $data['nama_petugas']; ?>">
        </div>
      </div>

      <!-- Input alamat petugas -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Alamat</label>
        </div>
        <div class="col-75">
          <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>">
        </div>
      </div>

      <!-- Input username petugas -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Username</label>
        </div>
        <div class="col-75">
          <input type="text" name="username" value="<?php echo $data['username']; ?>">
        </div>
      </div>

      <!-- Input password petugas -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Password</label>
        </div>
        <div class="col-75">
          <input type="text" name="password" value="<?php echo $data['password']; ?>">
        </div>
      </div>

      <!-- Pilihan level user, otomatis terpilih sesuai data -->
      <div class="row">
        <div class="col-25">
          <label for="">Level</label>
        </div>
        <div class="col-75">
          <select name="level">
            <option value="admin" <?php echo $data['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="petugas" <?php echo $data['level'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
          </select>
        </div>
      </div>

      <!-- Input untuk upload foto petugas baru -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Foto</label>
        </div>
        <div class="col-75">
          <input type="file" name="foto" accept="image/*" value="<?php echo $data['foto']; ?>">
        </div>
      </div>

      <br>
      <!-- Tombol simpan untuk mengupdate data petugas -->
      <div class="row">
        <input type="submit" class="tombol" value="SIMPAN" name="btnUbah">
        <!-- Tombol reset untuk mengosongkan form -->
        <input type="reset" value="RESET">
      </div>
    </form>
    <?php } // end while ?>
  </div>

  <footer>
    <p>&copy;2024 Websiteku. All rights reserved.</p>
  </footer>
</body>

</html>