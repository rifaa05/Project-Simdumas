<?php
include 'koneksi.php';

$id = $_GET['id'];

// ambil data dulu (untuk hapus gambar)
$data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

// hapus file gambar jika ada
if(!empty($d['bukti'])){
    $file = "gambar/" . $d['bukti'];
    if(file_exists($file)){
        unlink($file);
    }
}

// hapus data dari database
mysqli_query($conn, "DELETE FROM pengaduan WHERE id='$id'");

// redirect
header("location:dashboard.php");
?>

<--dashboard-->
 