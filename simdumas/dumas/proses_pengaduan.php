<?php
include "koneksi.php";

// amankan input
$nama  = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$isi   = mysqli_real_escape_string($conn, $_POST['isi']);

// upload file
$bukti = $_FILES['bukti']['name'];
$tmp   = $_FILES['bukti']['tmp_name'];

// amankan nama file
$bukti = mysqli_real_escape_string($conn, $bukti);

if($bukti != ""){
    move_uploaded_file($tmp, "../gambar/".$bukti);
}

// query
$query = mysqli_query($conn, "INSERT INTO pengaduan (nama, email, isi_laporan, bukti) 
VALUES ('$nama','$email','$isi','$bukti')") 
or die(mysqli_error($conn));

// hasil
if($query){
    $id = mysqli_insert_id($conn);

    echo "<script>
    alert('🎉Laporan berhasil diterima dan akan segera diproses!');
    window.location='index.php';
    </script>";
}
?>