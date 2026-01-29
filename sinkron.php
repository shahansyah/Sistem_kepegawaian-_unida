<?php
include 'config.php';

// 1. HAPUS TOTAL koleksi statistik agar tidak ada sisa angka "sampah"
$db->statistik->drop(); 

// 2. Ambil semua data pegawai yang benar-benar ada di tabel saat ini
$pegawai_asli = $collection->find();
$hitung_ulang = [];

foreach ($pegawai_asli as $p) {
    $bagian = $p['bagian'];
    if (!isset($hitung_ulang[$bagian])) {
        $hitung_ulang[$bagian] = 0;
    }
    $hitung_ulang[$bagian]++;
}

// 3. Masukkan hasil hitungan yang VALID ke koleksi statistik
foreach ($hitung_ulang as $nama_bagian => $total) {
    $db->statistik->insertOne([
        'bagian' => $nama_bagian,
        'jumlah' => $total
    ]);
}

echo "<h1>Sinkronisasi Total Berhasil!</h1>";
echo "<p>Sekarang angka di rekap pasti sesuai dengan jumlah di tabel.</p>";
echo "<a href='rekap.php'>Cek Halaman Rekap</a>";
?>