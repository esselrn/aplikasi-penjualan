<?php
include 'koneksi.php'; // Koneksi ke database

// Jika tombol Simpan ditekan, tambah data petugas baru
if(isset($_POST['btnSimpan'])){
  // Ambil data dari form
  $nama_petugas = $_POST['nama_petugas'];
  $alamat = $_POST['alamat'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  // Data foto
  $ukuranFile = $_FILES['foto']['size'];
  $namaFile = $_FILES['foto']['name'];
  $dir = 'images/'; // folder untuk simpan foto
  $random = rand(); // angka acak untuk nama foto agar unik
  $tmpFile = $_FILES['foto']['tmp_name'];

  // Cek ukuran foto, maksimal sekitar 1MB
  if ($ukuranFile < 1088779){
    // Pindahkan foto ke folder images
    move_uploaded_file($tmpFile, $dir . $random. '_' . $namaFile);
    $foto = $random . '_' . $namaFile;

    // Simpan data petugas ke database
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_petugas (nama_petugas, alamat, username, password, level, foto)
    VALUES ('$nama_petugas', '$alamat', '$username', '$password', '$level', '$foto')");
    
    // Tampilkan pesan berhasil dan kembali ke halaman kelola petugas
    echo "<script>alert('Data petugas berhasil disimpan');document.location='kelola_petugas.php';</script>";
  } else {
    // Jika ukuran foto terlalu besar, tampilkan peringatan
    echo "<script>alert('Ukuran foto terlalu besar');document.location='kelola_petugas.php';</script>";
  }
}

// Jika tombol Ubah ditekan, edit data petugas
if(isset($_POST['btnUbah'])){
  // Ambil data dari form
  $id_petugas = $_POST['id_petugas'];
  $nama_petugas = $_POST['nama_petugas'];
  $alamat = $_POST['alamat'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  // Data foto baru jika ada
  $ukuranFile = $_FILES['foto']['size'];
  $namaFile = $_FILES['foto']['name'];
  $dir = 'images/';
  $random = rand();
  $tmpFile = $_FILES['foto']['tmp_name'];

  // Foto lama untuk jaga-jaga jika tidak diubah
  $fotoLama = $_POST['fotoLama'];

  // Jika tidak ada foto baru yang diupload
  if ($namaFile === ""){
    // Update data tanpa mengubah foto
    $query = mysqli_query($koneksi, "UPDATE tbl_petugas SET nama_petugas = '$nama_petugas', alamat = '$alamat', username = '$username',
       password = '$password', level = '$level', foto = '$fotoLama' WHERE id_petugas = '$id_petugas'");
    
    echo "<script>alert('Data petugas berhasil diubah');document.location='kelola_petugas.php';</script>";
  } else {
    // Jika ada foto baru, hapus foto lama
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE id_petugas = '$id_petugas'");
    $ambil = mysqli_fetch_assoc($data);
    unlink('images/' . $ambil['foto']); // hapus file foto lama dari folder

    // Pindahkan foto baru ke folder
    move_uploaded_file($tmpFile, $dir . $random . '_' . $namaFile);
    $foto = $random . '_' . $namaFile;

    // Update data petugas termasuk foto baru
    $query = mysqli_query($koneksi, "UPDATE tbl_petugas SET nama_petugas = '$nama_petugas', alamat = '$alamat', username = '$username',
      password = '$password', level = '$level', foto = '$foto' WHERE id_petugas = '$id_petugas'");
    
    echo "<script>alert('Data petugas berhasil diubah');document.location='kelola_petugas.php';</script>";
  }
}
?>