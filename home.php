<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home - UNIDA Gontor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Background gedung UNIDA dengan lapisan biru tua transparan */
            background: linear-gradient(rgba(7, 45, 82, 0.8), rgba(2, 27, 51, 0.8)), 
                        url('asset/unida.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
        }

        /* Efek Glassmorphism (Kaca Blur) */
        .glass-card {
            background: rgba(255, 255, 255, 0.2) !important; /* Warna putih sangat transparan */
            backdrop-filter: blur(15px); /* Efek blur utama */
            -webkit-backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.3) !important; /* Garis tepi tipis agar kesan kaca terasa */
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            color: white !important; /* Teks di dalam kaca jadi putih agar kontras */
        }

        /* Pastikan teks di dalam card mudah dibaca */
        .glass-card h1, .glass-card h5 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .glass-card p, .glass-card li {
            color: #f1f1f1;
        }

        .navbar {
            
            backdrop-filter: blur(5px);
        }
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

<div class="container mt-5">
    <div class="p-5 mb-4 glass-card">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Portal UNIDA</h1>
        <p class="col-md-8 fs-4">Universitas Darussalam Gontor adalah Perguruan Tinggi Islam yang menerapkan sistem asrama (Boarding University) untuk mencetak kader pemimpin umat yang berakhlak mulia.</p>
        <hr style="border-color: rgba(255,255,255,0.3)">
        <h5>Sekilas Info:</h5>
        <ul>
            <li>Terakreditasi Unggul oleh BAN-PT.</li>
            <li>Berfokus pada Islamisasi Ilmu Pengetahuan.</li>
            <li>Memiliki jaringan internasional yang luas.</li>
     <div class="mt-5">
    <a href="index.php" class="btn btn-primary btn-lg px-4 shadow">Kelola Data Pegawai &raquo;</a>
</div>

      </div>

    </div>

</div>