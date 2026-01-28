<?php
// Tampilkan error jika ada masalah (untuk tahap development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

// Memanggil Namespace agar tidak perlu menulis MongoDB\Client terus-menerus
use MongoDB\Client;

try {
    // Koneksi ke MongoDB
    // Pastikan MongoDB Service sudah 'Running' di background
    $client = new Client("mongodb://localhost:27017");

    // Memilih Database & Koleksi
    $db = $client->kepegawaian_unida;
    $collection = $db->pegawai;

    // Tes koneksi sederhana (opsional, bisa dihapus jika sudah lancar)
    // $client->listDatabases(); 
    
} catch (Exception $e) {
    // Memberikan pesan yang lebih detail jika gagal
    die("Koneksi ke MongoDB Gagal: " . $e->getMessage());
}
?>