<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'kari';
$koneksi = mysqli_connect($host, $username, $password, $db)
or die (mysqli_error($koneksi));
?>