<?php 
include 'koneksi.php'; 
if (isset($_POST['tambah'])) {
    $nama_jurusan = mysqli_real_escape_string($koneksi, $_POST['nama_jurusan']);
    mysqli_query($koneksi, "INSERT INTO tb_jurusan (nama_jurusan) VALUES ('$nama_jurusan')");
    header("Location: jurusan.php");
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tb_jurusan WHERE id_jurusan='$id'");
    header("Location: jurusan.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Data Jurusan</title>
    <style>
        body {
  margin: 0;
  padding: 0;
}

/* 2. Atur lebar navbar menjadi penuh */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0f172a;
  padding: 1rem 2rem;
  
  /* Tambahkan dua baris ini */
  width: 100%; 
  box-sizing: border-box; /* Mencegah padding membuat layar meluber/scroll horizontal */
}

.logo {
  color: #fff;
  font-weight: bold;
}

.nav-links {
  display: flex;
  list-style: none;
  gap: 1.5rem;
  margin: 0;
  padding: 0;
}

.nav-links a {
  color: #fff;
  text-decoration: none;
}

.nav-links a:hover {
  color: #ff9900;
}
        body { font-family: Arial, sans-serif; background: #f4f4f9; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #007bff; color: white; }
        .btn { padding: 6px 12px; border: none; border-radius: 4px; color: white; cursor: pointer; text
decoration: none; font-size: 12px; }
        .btn-green { background: #28a745; } .btn-danger { background: #dc3545; } .btn-nav { background: 
#6c757d; }
    </style>
</head>
<body>
        <nav class="navbar">
        <div class="logo">Sekolah Permata Purnama</div>
        <ul class="nav-links">
            <li><a href="index.php">Form Pendaftaran</a></li>
            <li><a href="jurusan.php"> Master Jurusan</a></li>
            <li><a href="../dashboard/dashboard.php">Dashboard</a></li>
            <li><a href="../index.php">Logout</a></li>
            
        </ul>
    </nav>
<div class="container">
    <a href="index.php" class="btn btn-nav">« Kembali ke Form Pendaftaran</a>
    <h2>Kelola Master Jurusan</h2>
    <form method="POST">
        <input type="text" name="nama_jurusan" placeholder="Nama Jurusan Baru" required style="width: 70%; padding: 8px;">
        <button type="submit" name="tambah" class="btn btn-green">Tambah Jurusan</button>
    </form>
    <table>
        <tr><th>ID</th><th>Nama Jurusan</th><th>Aksi</th></tr>
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
        while($r = mysqli_fetch_assoc($q)){
            echo "<tr>
                    <td>{$r['id_jurusan']}</td>
                    <td>{$r['nama_jurusan']}</td>
                    <td><a href='jurusan.php?hapus={$r['id_jurusan']}' class='btn btn-danger' onclick='return confirm(\"Hapus jurusan ini?\")'>Hapus</a></td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>