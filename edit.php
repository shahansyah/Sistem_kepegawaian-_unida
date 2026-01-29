<?php 
session_start();
// Keamanan: Pastikan hanya yang sudah login yang bisa akses
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config.php'; 

// Ambil ID dari URL
$id = $_GET['id'];

try {
    // Cari data pegawai berdasarkan ID
    $pegawai = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    
    // Jika data tidak ditemukan (misal ID asal ketik di URL)
    if (!$pegawai) {
        header("Location: index.php");
        exit;
    }
} catch (Exception $e) {
    // Jika format ID salah/tidak valid
    die("ID tidak valid!");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai - UNIDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn { border-radius: 10px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-primary fw-bold">Edit Data Pegawai</h3>
                    <hr>
                    <form action="proses.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?= $pegawai['nip'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Pegawai</label>
                            <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bagian (Unit)</label>
                            <input type="text" name="bagian" class="form-control" value="<?= $pegawai['bagian'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Asal Kota</label>
                            <input type="text" name="asal" class="form-control" value="<?= $pegawai['asal'] ?>" required>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="update" class="btn btn-success fw-bold">Simpan Perubahan</button>
                            <a href="index.php" class="btn btn-outline-secondary text-decoration-none">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
