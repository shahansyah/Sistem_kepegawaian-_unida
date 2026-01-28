<?php 
include 'config.php'; 
$id = $_GET['id'];
$pegawai = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>Edit Data Pegawai</h3>
                    <form action="proses.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="mb-3">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?= $pegawai['nip'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Bagian</label>
                            <input type="text" name="bagian" class="form-control" value="<?= $pegawai['bagian'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Asal</label>
                            <input type="text" name="asal" class="form-control" value="<?= $pegawai['asal'] ?>" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-success">Update Data</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>