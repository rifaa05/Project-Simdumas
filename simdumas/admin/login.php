<?php 
session_start();
include "koneksi.php";
 ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Staf🔐</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #a0c4ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .emoji {
            font-size: 40px;
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
        }
        .captcha-img {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="card p-4" style="width: 350px;">
    <div class="text-center mb-3">
        <div class="emoji">🔐💙</div>
        <h4 class="text-primary">Login Staf</h4>
        <small class="text-muted">Desa Ciborelang</small>
    </div>

    <form action="proses_login.php" method="POST">
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

        <!-- CAPTCHA -->
        <div class="text-center mb-2">
            <img src="captcha.php" class="captcha-img mb-2"><br>
            <input type="text" name="captcha" class="form-control" placeholder="Masukkan CAPTCHA" required>
        </div>

        <button class="btn btn-primary w-100">Login 🚀</button>
    </form>

    <?php
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger mt-3 text-center'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>

</div>

</body>
</html>