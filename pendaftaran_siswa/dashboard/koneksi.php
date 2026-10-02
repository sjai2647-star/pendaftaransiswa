<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_siswa";

$koneksi = mysqli_connect("localhost", "root", "", "db_siswa_lanjutan");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>