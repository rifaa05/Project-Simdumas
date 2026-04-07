<?php
$conn = mysqli_connect("localhost", "root", "", "simdumas");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>