<?php 
session_start();
// Keamanan: Jika belum login, tendang balik ke login.php
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
    <title>Data Pegawai - Sistem UNIDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(rgba(7, 45, 82, 0.8), rgba(2, 27, 51, 0.8)), 
                        url('asset/unida.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0; }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card { border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 12px; }
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
      <a class="nav-link active" href="home.php">Home</a>
      <a class="nav-link" href="index.php">Data Pegawai</a>
      <a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
    <h2 class="text-center mb-4 text-white">Manajemen Data Pegawai</h2>

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="card-title mb-3">Tambah Pegawai Baru</h5>
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

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-header">
                        <tr>
                            <th class="ps-4">NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Bagian</th>
                            <th>Asal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ambil semua data dari koleksi pegawai
                        $semua_pegawai = $collection->find();
                        
                        foreach ($semua_pegawai as $p) {
                            $nip    = $p['nip'] ?? '-';
                            $nama   = $p['nama'] ?? '-';
                            $bagian = $p['bagian'] ?? '-';
                            $asal   = $p['asal'] ?? '-';
                            $id     = (string)$p['_id']; // Pastikan ID diconvert ke string

                            echo "<tr>
                                    <td class='ps-4'>{$nip}</td>
                                    <td><strong>{$nama}</strong></td>
                                    <td>{$bagian}</td>
                                    <td>{$asal}</td>
                                    <td class='text-center'>
                                        <a href='edit.php?id={$id}' class='btn btn-sm btn-warning me-1'>Edit</a>
                                        <a href='proses.php?hapus={$id}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data {$nama}?\")'>Hapus</a>
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