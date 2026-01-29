<?php 
session_start();
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
    <title>Rekap Karyawan - UNIDA Gontor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(rgba(7, 45, 82, 0.9), rgba(2, 27, 51, 0.9)), url('asset/unida.jpg');
            background-size: cover; background-attachment: fixed; min-height: 100vh; color: white;
        }
        .card-rekap { border-radius: 20px; border: none; color: #333; transition: 0.3s; }
        .total-box { background: rgba(255, 255, 255, 0.1); border: 2px solid #ffc107; border-radius: 25px; padding: 40px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">UNIDA Gontor</a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link" href="home.php">Home</a>
      <a class="nav-link" href="index.php">Manajemen Data</a>
      <a class="nav-link active" href="rekap.php">Rekap Karyawan</a>
      <a class="nav-link text-warning" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Statistik Rekapitulasi Karyawan</h2>
        <div style="height: 5px; width: 80px; background: #ffc107; margin: 10px auto;"></div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-5">
            <div class="total-box text-center shadow-lg">
                <h5 class="text-warning fw-bold">TOTAL SELURUH KARYAWAN</h5>
                <?php
                // Agregasi untuk menjumlahkan semua field 'jumlah' di koleksi statistik
                $pipeline = [['$group' => ['_id' => null, 'total' => ['$sum' => '$jumlah']]]];
                $result = $db->statistik->aggregate($pipeline)->toArray();
                $total_semua = !empty($result) ? $result[0]['total'] : 0;
                ?>
                <h1 style="font-size: 5rem;" class="fw-bold mb-0"><?= $total_semua ?></h1>
                <p class="mb-0">Personel Terdaftar</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php
        $kategori = ['Jahis', 'tukang bersih', 'Dosen', 'Pembangunan'];
        foreach ($kategori as $kat) :
            // Mengambil data jumlah per kategori dari koleksi statistik
            $data = $db->statistik->findOne(['bagian' => new MongoDB\BSON\Regex("^$kat$", "i")]);
            $jumlah = $data['jumlah'] ?? 0;
        ?>
            <div class="col-md-3">
                <div class="card card-rekap shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted fw-bold mb-3"><?= strtoupper($kat) ?></h6>
                        <h1 class="display-4 fw-bold text-primary"><?= $jumlah ?></h1>
                        <p class="mb-0 text-secondary">Orang</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-warning px-5 fw-bold shadow">Kembali ke Manajemen Data</a>
    </div>
</div>

</body>
</html>