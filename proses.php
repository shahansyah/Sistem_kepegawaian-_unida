<?php
include 'config.php';

// Fitur CREATE
if (isset($_POST['simpan'])) {
    $data = [
        'nip'     => $_POST['nip'],
        'nama'    => $_POST['nama'],
        'bagian'  => $_POST['bagian'],
        'asal'    => $_POST['asal'],
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    $collection->insertOne($data);
    header("Location: index.php");
}

// Fitur DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    header("Location: index.php");
}

// Fitur UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nip'    => $_POST['nip'],
            'nama'   => $_POST['nama'],
            'bagian' => $_POST['bagian'],
            'asal'   => $_POST['asal']
        ]]
    );
    header("Location: index.php");
}
?>