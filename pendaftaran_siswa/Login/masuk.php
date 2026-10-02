<?php
require 'koneksi.php';

$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "SELECT * FROM baru
              WHERE username='$username'
              AND password='$password'";

$result = mysqli_query($conn, $query_sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: pendaftaran_lanjutan/index.php");
    exit;
} else {
    echo "<center>
            <h1>Username atau Password Anda Salah.</h1>
            <button>
                <a href='index.php'>Login</a>
            </button>
          </center>";
}
?>