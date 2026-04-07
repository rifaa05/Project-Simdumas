<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$captcha = $_POST['captcha'];

// CEK CAPTCHA
if($captcha != $_SESSION['captcha']){
    $_SESSION['error'] = "Captcha salah!";
    header("location:login.php");
    exit;
}

// CEK LOGIN
$data = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($data) > 0){
    $_SESSION['admin'] = $username;
    echo "<script>
                alert('Login berhasil!');
                window.location='dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Username atau password salah!');
                window.location='login.php';
              </script>";
    }
?>
