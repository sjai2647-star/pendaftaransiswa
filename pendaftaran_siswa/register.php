<?php
require "koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "INSERT INTO baru (username, password)
              VALUES ('$username', '$password')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: index.php");
    exit();
} else {
    echo "Pendaftaran Gagal: " . mysqli_error($conn);
}
?>