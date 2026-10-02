<?php 
include 'koneksi.php'; 
// Hitung Statistik Agregat untuk Widget Card
$total_siswa   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_siswa"))['total'];
$total_jurusan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_jurusan"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pendaftaran Siswa</title>
    <style>
        :root {
            --bg-body: #f8fafc;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --card-bg: #ffffff;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); display: flex; min-height: 100vh; position: relative; }

        /* ========================================================= */
        /* STYLING HAMBURGER & SIDEBAR NAVBAR LEFT                   */
        /* ========================================================= */

        /* Tombol Hamburger (Secara default tersembunyi di Desktop) */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
            margin-right: 15px;
        }

        /* Overlay gelap saat sidebar dibuka di mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.5);
            z-index: 99;
        }

        /* Styling Utama Sidebar Kiri */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: #fff;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 100;
        }
        .sidebar .brand {
            font-size: 16px;
            font-weight: bold;
            padding-bottom: 20px;
            border-bottom: 1px solid #334155;
            color: #38bdf8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Tombol 'X' Tutup Sidebar (Hanya di Mobile) */
        .sidebar .close-btn {
            display: none;
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 22px;
            cursor: pointer;
        }
        .sidebar .nav-menu { margin-top: 20px; list-style: none; }
        .sidebar .nav-item { margin-bottom: 5px; }
        .sidebar .nav-link {
            display: block;
            padding: 10px 14px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            font-weight: 500;
        }

        /* MEDIA QUERY: Perubahan Menjadi Hamburger Menu Pada Layar KECIL (<768px) */
        @media (max-width: 768px) {
            .hamburger-btn {
                display: inline-block; /* Tampilkan tombol Hamburger */
            }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%); /* Sembunyikan sidebar ke kiri luar layar */
                box-shadow: 2px 0 10px rgba(0,0,0,0.2);
            }
            .sidebar.show {
                transform: translateX(0); /* Munculkan sidebar saat kelas .show aktif */
            }
            .sidebar .close-btn {
                display: block; /* Tampilkan tombol silang di dalam sidebar */
            }
            .sidebar-overlay.show {
                display: block; /* Munculkan background gelap */
            }
        }

        /* ========================================================= */
        /* MAIN CONTENT & ELEMENT LAINNYA                            */
        /* ========================================================= */
        .main-content { flex: 1; padding: 25px 30px; width: 100%; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .topbar-left { display: flex; align-items: center; }
        .topbar h1 { font-size: 22px; color: var(--text-dark); }
        .user-profile { font-size: 13px; color: var(--text-muted); background: white; padding: 6px 14px; border-radius: 20px; border: 1px solid var(--border); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px; }
        .stat-card { background: var(--card-bg); padding: 20px; border-radius: 10px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stat-card p { font-size: 13px; color: var(--text-muted); font-weight: 500; }
        .stat-card h2 { font-size: 28px; color: var(--text-dark); margin-top: 5px; }
        .panel { background: var(--card-bg); border-radius: 10px; border: 1px solid var(--border); padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px; overflow-x: auto; }
        .panel-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .panel-title { font-size: 16px; font-weight: 600; color: var(--text-dark); }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; display: inline-block; transition: 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-danger { background: #ef4444; color: white; }
        .btn-blue { background: #0284c7; color: white; }
        .btn-secondary { background: #e2e8f0; color: var(--text-dark); }
        .filter-row { display: flex; gap: 10px; margin-bottom: 15px; flex-wrap: wrap; }
        .form-control { width: 100%; padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #f1f5f9; color: #475569; font-weight: 600; }
        .img-thumb { width: 42px; height: 50px; object-fit: cover; border-radius: 4px; }
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.5); justify-content: center; align-items: center; z-index: 1000; }
        .modal-box { background: white; padding: 25px; border-radius: 12px; width: 90%; max-width: 550px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
    </style>
</head>
<body>

    <!-- OVERLAY GELAP UNTUK LATAR SIDEBAR MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR NAVIGATION KIRI -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <span>SMK Permata Purnama</span>
            <!-- Tombol silang penutup sidebar di Mobile -->
            <button class="close-btn" onclick="toggleSidebar()">&times;</button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="../pendaftaran_lanjutan/index.php" class="nav-link">Form Pendaftaran</a></li>
            <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard Utama</a></li>
            <li class="nav-item"><a href="../pendaftaran_lanjutan/jurusan.php" class="nav-link">Master Data Jurusan</a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link">Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="main-content">
        <!-- TOPBAR HARUS DIUBAH AGAR ADA TOMBOL HAMBURGER DI SAMPING JUDUL -->
        <header class="topbar">
            <div class="topbar-left">
                <!-- Tombol Hamburger (Hanya muncul di Mobile) -->
                <button class="hamburger-btn" onclick="toggleSidebar()">&#9776;</button>
                <h1>Dashboard Pendaftaran Siswa Baru</h1>
            </div>
            <div class="user-profile">Petugas: <strong>Administrator</strong></div>
        </header>

        <!-- STATS WIDGET CARDS -->
        <section class="stats-grid">
            <div class="stat-card">
                <p>Total Siswa Terdaftar</p>
                <h2><?php echo $total_siswa; ?></h2>
            </div>
            <div class="stat-card">
                <p>Jumlah Jurusan Tersedia</p>
                <h2><?php echo $total_jurusan; ?></h2>
            </div>
        </section>

        <!-- PANEL DATA SISWA -->
        <section class="panel">
            <div class="panel-header">
                <div class="panel-title">Daftar Calon Siswa Baru</div>
                <button class="btn btn-primary" onclick="openModal()">+ Tambah Siswa Baru</button>
            </div>

            <!-- FILTER & SEARCH FORM -->
            <form method="GET" class="filter-row">
                <input type="text" name="keyword" class="form-control" placeholder="Cari NIS atau Nama..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                <select name="filter_jurusan" class="form-control" style="max-width: 200px;">
                    <option value="">Semua Jurusan</option>
                    <?php
                    $j_query = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
                    while($j_row = mysqli_fetch_assoc($j_query)){
                        $selected = (isset($_GET['filter_jurusan']) && $_GET['filter_jurusan'] == $j_row['id_jurusan']) ? 'selected' : '';
                        echo "<option value='{$j_row['id_jurusan']}' $selected>{$j_row['nama_jurusan']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
                <a href="dashboard.php" class="btn btn-secondary" style="background: #f1f5f9;">Reset</a>
            </form>

            <!-- TABEL DATA -->
            <table>
                <thead>
                    <tr>
                        <th>Pasfoto</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Pilihan Jurusan</th>
                        <th>Alasan Masuk</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT tb_siswa.*, tb_jurusan.nama_jurusan 
                            FROM tb_siswa 
                            JOIN tb_jurusan ON tb_siswa.id_jurusan = tb_jurusan.id_jurusan 
                            WHERE 1=1";
                    if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                        $kw = mysqli_real_escape_string($koneksi, $_GET['keyword']);
                        $sql .= " AND (tb_siswa.nama LIKE '%$kw%' OR tb_siswa.nis LIKE '%$kw%')";
                    }
                    if (isset($_GET['filter_jurusan']) && $_GET['filter_jurusan'] != '') {
                        $fj = mysqli_real_escape_string($koneksi, $_GET['filter_jurusan']);
                        $sql .= " AND tb_siswa.id_jurusan = '$fj'";
                    }
                    $sql .= " ORDER BY tb_siswa.id DESC";
                    $result = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td><img src='../pendaftaran_lanjutan/uploads/{$row['foto']}' class='img-thumb'></td>
                                    <td><strong>{$row['nis']}</strong></td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['nama_jurusan']}</td>
                                    <td>{$row['alasan']}</td>
                                    <td>
                                        <a href='cetak.php?id={$row['id']}' target='_blank' class='btn btn-blue' style='padding: 5px 10px;'>Cetak</a>
                                        <a href='hapus.php?id={$row['id']}' class='btn btn-danger' style='padding: 5px 10px;' onclick='return confirm(\"Hapus data siswa ini?\")'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; color: #94a3b8; padding: 20px;'>Data siswa tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- MODAL POPUP FORM PENDAFTARAN -->
    <div class="modal-overlay" id="modalForm">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Form Pendaftaran Siswa Baru</h3>
                <button type="button" onclick="closeModal()" style="border: none; background: none; font-size: 18px; cursor: pointer;">&times;</button>
            </div>
            <form action="simpan.php" method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 12px;">
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">NIS:</label>
                    <input type="text" name="nis" class="form-control" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Nama Lengkap:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Pilihan Jurusan:</label>
                    <select name="id_jurusan" class="form-control" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <?php
                        $j_list = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
                        while($jl = mysqli_fetch_assoc($j_list)){
                            echo "<option value='{$jl['id_jurusan']}'>{$jl['nama_jurusan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Pasfoto (JPG/PNG, Max 2MB):</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Alasan Masuk:</label>
                    <textarea name="alasan" class="form-control" rows="2" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT BUKA/TUTUP HAMBURGER NAVBAR KIRI -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            
            // Mengaktifkan/mematikan class 'show'
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        function openModal() { document.getElementById('modalForm').style.display = 'flex'; }
        function closeModal() { document.getElementById('modalForm').style.display = 'none'; }
    </script>
</body>
</html>