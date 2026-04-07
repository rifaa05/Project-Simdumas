<?php
include 'koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "UPDATE pengaduan SET status='$status' WHERE id='$id'");

header("location:dashboard.php");