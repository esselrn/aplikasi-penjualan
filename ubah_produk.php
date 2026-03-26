<?php
// Menghubungkan ke file koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Toko Kari</title>
  <!-- Menghubungkan file CSS -->
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

  <!-- Judul halaman -->
  <h2 align="center">FORM UBAH PRODUK</h2>

  <div class="container">
    <?php
    // Ambil id_produk dari URL dengan metode GET
    $id_produk = $_GET['id_produk'];

    // Query untuk mengambil data produk berdasarkan id_produk
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");

    // Menampilkan form dengan data produk yang sudah diambil dari database
    while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <form action="crud_produk.php" method="post" enctype="multipart/form-data">
      <!-- Input hidden untuk menyimpan id produk dan gambar lama (untuk update gambar) -->
      <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">
      <input type="hidden" name="gambarLama" value="<?php echo $data['gambar']; ?>">

      <!-- Input nama produk -->
      <div class="row">
        <div class="col-25">
          <label for="">Nama Produk</label>
        </div>
        <div class="col-75">
          <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>">
        </div>
      </div>

      <!-- Pilih kategori produk, otomatis terpilih sesuai data di database -->
      <div class="row">
        <div class="col-25">
          <label for="">Kategori Produk</label>
        </div>
        <div class="col-75">
          <select name="kategori_produk">
            <option value="makanan" <?php echo $data['kategori_produk'] == 'makanan' ? 'selected' : '' ?>>Makanan</option>
            <option value="minuman" <?php echo $data['kategori_produk'] == 'minuman' ? 'selected' : '' ?>>Minuman</option>
            <option value="fashion" <?php echo $data['kategori_produk'] == 'fashion' ? 'selected' : '' ?>>Fashion</option>
          </select>
        </div>
      </div>

      <!-- Input jumlah stok produk -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Jumlah Stok</label>
        </div>
        <div class="col-75">
          <input type="text" name="jumlah_stok" value="<?php echo $data['jumlah_stok']; ?>">
        </div>
      </div>

      <!-- Input harga produk -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Harga</label>
        </div>
        <div class="col-75">
          <input type="text" name="harga" value="<?php echo $data['harga']; ?>">
        </div>
      </div>

      <!-- Input diskon produk -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Diskon</label>
        </div>
        <div class="col-75">
          <input type="text" name="diskon" value="<?php echo $data['diskon']; ?>">
        </div>
      </div>

      <!-- Input harga pokok produk -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Harga Pokok</label>
        </div>
        <div class="col-75">
          <input type="text" name="harga_pokok" value="<?php echo $data['harga_pokok']; ?>">
        </div>
      </div>

      <!-- Input untuk upload gambar produk baru -->
      <div class="row">
        <div class="col-25">
          <label for="fname">Gambar Produk</label>
        </div>
        <div class="col-75">
          <input type="file" name="gambar" accept="image/*" value="<?php echo $data['gambar']; ?>">
        </div>
      </div>

      <br>
      <!-- Tombol simpan data perubahan produk -->
      <div class="row">
        <input type="submit" class="tombol" value="SIMPAN" name="btnUbah">
        <!-- Tombol reset untuk mengosongkan form -->
        <input type="reset" value="RESET">
      </div>
    </form>
    <?php } // End while loop ?>
  </div>

  <footer>
    <p>&copy;2024 Websiteku. All rights reserved.</p>
  </footer>
</body>

</html>