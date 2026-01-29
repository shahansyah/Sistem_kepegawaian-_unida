<?php 
session_start();
// Keamanan: Jika belum login, maka akan balik ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Pegawai - Sistem UNIDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(rgba(7, 45, 82, 0.8), rgba(2, 27, 51, 0.8)), 
                        url('asset/unida.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0; 
        }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card { border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.2); border-radius: 12px; }
        .table-header { background-color: #0d6efd; color: white; }
        .btn-primary { border-radius: 12px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
      <img src="asset/logo-unida-fyd-gontor-indonesia.webp" alt="Logo" width="35" height="35" class="me-2">
      UNIDA Gontor
    </a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link" href="home.php">Home</a>
      <a class="nav-link active" href="index.php">Manajemen Data Pegawai</a>
      <a class="nav-link" href="rekap.php">Rekap Karyawan</a> 
      <a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-white fw-bold">Manajemen Data Pegawai</h2>

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="card-title mb-3 text-primary fw-bold">Tambah Pegawai Baru</h5>
            <form action="proses.php" method="POST" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="nip" class="form-control" placeholder="NIP" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="bagian" class="form-control" placeholder="Bagian (Unit)" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="asal" class="form-control" placeholder="Asal Kota" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="simpan" class="btn btn-primary w-100 fw-bold">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 bg-white">
                    <thead class="table-header text-center">
                        <tr>
                            <th class="ps-4">NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Bagian</th>
                            <th>Asal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menampilkan data pegawai dari MongoDB
                        $semua_pegawai = $collection->find();
                        
                        foreach ($semua_pegawai as $p) {
                            $nip    = $p['nip'] ?? '-';
                            $nama   = $p['nama'] ?? '-';
                            $bagian = $p['bagian'] ?? '-';
                            $asal   = $p['asal'] ?? '-';
                            $id     = (string)$p['_id'];

                            echo "<tr class='align-middle text-center'>
                                    <td class='ps-4'>{$nip}</td>
                                    <td class='text-start'><strong>{$nama}</strong></td>
                                    <td><span class='badge bg-info text-dark text-uppercase'>{$bagian}</span></td>
                                    <td>{$asal}</td>
                                    <td>
                                        <a href='edit.php?id={$id}' class='btn btn-sm btn-outline-warning me-1'>Edit</a>
                                        <a href='proses.php?hapus={$id}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data {$nama}?\")'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
