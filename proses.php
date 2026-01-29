<?php
include 'config.php';

// --- FITUR CREATE (TAMBAH DATA) ---
if (isset($_POST['simpan'])) {
    $data = [
        'nip'        => $_POST['nip'],
        'nama'       => $_POST['nama'],
        'bagian'     => $_POST['bagian'],
        'asal'       => $_POST['asal'],
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    // 1. Masukkan data pegawai ke koleksi utama
    $collection->insertOne($data);

    // 2. REVISI: Update jumlah rekap di koleksi 'statistik'
    // $inc: 1 artinya menambah jumlah sebanyak 1
    // upsert: true artinya jika bagian tersebut belum ada di database, otomatis dibuatkan
    $db->statistik->updateOne(
        ['bagian' => $_POST['bagian']],
        ['$inc' => ['jumlah' => 1]],
        ['upsert' => true]
    );

    header("Location: index.php");
    exit;
}

// --- FITUR DELETE (HAPUS DATA) ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $oid = new MongoDB\BSON\ObjectId($id);

    // 1. REVISI: Cari info pegawai dulu sebelum dihapus untuk tahu dia bagian apa
    $pegawai = $collection->findOne(['_id' => $oid]);

    if ($pegawai) {
        // 2. Kurangi jumlah di rekap (statistik)
        // $inc: -1 artinya mengurangi jumlah sebanyak 1
        $db->statistik->updateOne(
            ['bagian' => $pegawai['bagian']],
            ['$inc' => ['jumlah' => -1]]
        );

        // 3. Hapus data pegawainya dari koleksi utama
        $collection->deleteOne(['_id' => $oid]);
    }

    header("Location: index.php");
    exit;
}

// --- FITUR UPDATE (UBAH DATA) ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $oid = new MongoDB\BSON\ObjectId($id);

    // Opsional: Jika bagian diubah saat update, rekap juga harus disesuaikan.
    // Namun untuk tahap awal, kita fokus pada Create & Delete agar logika tidak terlalu rumit.

    $collection->updateOne(
        ['_id' => $oid],
        ['$set' => [
            'nip'    => $_POST['nip'],
            'nama'   => $_POST['nama'],
            'bagian' => $_POST['bagian'],
            'asal'   => $_POST['asal']
        ]]
    );
    header("Location: index.php");
    exit;
}
?>
