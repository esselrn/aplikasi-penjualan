<?php
include 'koneksi.php'; // Koneksi ke database

// Jika tombol Simpan ditekan (tambah data produk baru)
if(isset($_POST['btnSimpan'])){
  // Ambil data dari form
  $nama_produk = $_POST['nama_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $jumlah_stok = $_POST['jumlah_stok'];
  $harga = $_POST['harga'];
  $diskon = $_POST['diskon'];
  $harga_pokok = $_POST['harga_pokok'];

  // Data gambar
  $ukuranFile = $_FILES['gambar']['size'];
  $namaFile = $_FILES['gambar']['name'];
  $dir = 'images/'; // folder untuk simpan gambar
  $random = rand(); // angka acak untuk nama file agar unik
  $tmpFile = $_FILES['gambar']['tmp_name'];

  // Cek ukuran file gambar agar tidak terlalu besar
  if ($ukuranFile < 1088779){
    // Pindahkan gambar ke folder 'images'
    move_uploaded_file($tmpFile, $dir . $random. '_' . $namaFile);
    $gambar = $random . '_' . $namaFile;

    // Simpan data produk ke database
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_produk (nama_produk, kategori_produk, jumlah_stok, harga, diskon, harga_pokok, gambar)
    VALUES ('$nama_produk', '$kategori_produk', '$jumlah_stok', '$harga', '$diskon', '$harga_pokok', '$gambar')");
    
    // Tampilkan pesan berhasil dan kembali ke halaman kelola produk
    echo "<script>alert('Data produk berhasil disimpan');document.location='kelola_produk.php';</script>";
  } else {
    // Jika ukuran gambar terlalu besar, beri peringatan
    echo "<script>alert('Ukuran gambar terlalu besar');document.location='kelola_produk.php';</script>";
  }
}

// Jika tombol Ubah ditekan (edit data produk)
if(isset($_POST['btnUbah'])){
  // Ambil data dari form
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $jumlah_stok = $_POST['jumlah_stok'];
  $harga = $_POST['harga'];
  $diskon = $_POST['diskon'];
  $harga_pokok = $_POST['harga_pokok'];

  // Data gambar baru jika ada
  $ukuranFile = $_FILES['gambar']['size'];
  $namaFile = $_FILES['gambar']['name'];
  $dir = 'images/';
  $random = rand();
  $tmpFile = $_FILES['gambar']['tmp_name'];

  // Gambar lama untuk jaga-jaga jika tidak diubah
  $gambarLama = $_POST['gambarLama'];

  // Jika tidak ada gambar baru yang diupload
  if ($namaFile === ""){
    // Update data tanpa mengubah gambar
    $query = mysqli_query($koneksi, "UPDATE tbl_produk SET nama_produk = '$nama_produk', kategori_produk = '$kategori_produk', jumlah_stok = '$jumlah_stok',
       harga = '$harga', diskon = '$diskon', harga_pokok = '$harga_pokok', gambar = '$gambarLama' WHERE id_produk = '$id_produk'");
    
    echo "<script>alert('Data produk berhasil diubah');document.location='kelola_produk.php';</script>";
  } else {
    // Jika ada gambar baru, hapus gambar lama
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
    $ambil = mysqli_fetch_assoc($data);
    unlink('images/' . $ambil['gambar']); // hapus file gambar lama dari folder

    // Pindahkan gambar baru ke folder
    move_uploaded_file($tmpFile, $dir . $random . '_' . $namaFile);
    $gambar = $random . '_' . $namaFile;

    // Update data produk termasuk gambar baru
    $query = mysqli_query($koneksi, "UPDATE tbl_produk SET nama_produk = '$nama_produk', kategori_produk = '$kategori_produk', jumlah_stok = '$jumlah_stok',
        harga = '$harga', diskon = '$diskon', harga_pokok = '$harga_pokok', gambar = '$gambar' WHERE id_produk = '$id_produk'");
    
    echo "<script>alert('Data produk berhasil diubah');document.location='kelola_produk.php';</script>";
  }
}
?>