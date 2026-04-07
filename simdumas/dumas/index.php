<?php include "koneksi.php";?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIPMAS Desa Ciborelang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Pacifico&display=swap" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #4e73df, #a0c4ff);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
}

/* Logo */
.logo-sipmas {
    font-family: 'Pacifico', cursive;
    font-size: 26px;
}
.logo-desa {
    font-family: 'Pacifico', cursive;
    font-size: 20px;
}

/* Card */
.card {
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Button */
.btn-primary {
    background-color: #4e73df;
    border: none;
}

/* Menu Card */
.menu-card {
    border-radius: 20px;
    transition: 0.3s;
    cursor: pointer;
    text-align: center;
}
.menu-card:hover {
    transform: translateY(-8px);
}

/* Badge */
.badge-menunggu { background: gray; }
.badge-diproses { background: orange; }
.badge-selesai { background: green; }

.section {
    display: none;
}
.btn-soft-blue {
    background: #e7f0ff;
    color: #4e73df;
    border: none;
    border-radius: 10px;
    transition: 0.3s;
}

.btn-soft-blue:hover {
    background: #d0e2ff;
    color: #2e59d9;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar px-4">
    <div class="container-fluid d-flex justify-content-between">
        <div class="text-white logo-sipmas">🧑‍🤝‍🧑📱 SIPMAS</div>
        <div class="text-white logo-desa">📢 CIBORELANG</div>
    </div>
</nav>

<div class="container mt-5">

    <!-- LANDING -->

        <div class="text-center text-white mb-4">
            <h2>📢 Sistem Pengaduan Masyarakat</h2>
            <p>Laporkan masalah dengan mudah & cepat 💙</p>
        </div>
		<div class="card card-soft-blue p-4 mb-5">
    <h5 class="mb-3 text-center">📖 Petunjuk Pengaduan</h5>

    <div class="row text-center g-4">

        <div class="col-md-3 mb-3">
            <div class="petunjuk-box">
                📝
                <p>Isi data dengan lengkap</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="petunjuk-box">
                📷
                <p>Upload bukti (jika ada)</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="petunjuk-box">
                📤
                <p>Kirim laporan</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="petunjuk-box">
                🔍
                <p>Cek status laporan</p>
            </div>
        </div>

    </div>
</div>

	<div id="landingMenu" class="mt-3">
		<div class="row justify-content-center g-4">
            <div class="col-md-4 mb-4">
                <div class="card p-4 menu-card" onclick="goToForm()">
                    <div style="font-size:50px;">📢</div>
                    <h4>Buat Laporan</h4>
                    <p>Kirim pengaduan</p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card p-4 menu-card" onclick="goToTracking()">
                    <div style="font-size:50px;">🔍</div>
                    <h4>Cek Tracking</h4>
                    <p>Lihat status laporan</p>
                </div>
            </div>

        </div>
    </div>


    <!-- FORM -->
    <div id="formPengaduan" class="card p-4 section">

        <button class="btn btn-soft-blue mb-3" onclick="backHome()">⬅ Kembali</button>

        <h4 class="text-center text-primary mb-3">Form Pengaduan</h4>

        <form action="proses_pengaduan.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" class="form-control mb-2" placeholder="👤 Nama" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="📧 Email" required>
            <textarea name="isi" class="form-control mb-2" placeholder="📝 Isi laporan" required></textarea>
            <input type="file" name="bukti" class="form-control mb-3" required>

            <button class="btn btn-primary w-100">Kirim Laporan 🚀</button>
        </form>
    </div>

    <!-- TRACKING -->
    <div id="trackingSection" class="card p-4 section">

        <button class="btn btn-soft-blue mb-3" onclick="backHome()">⬅ Kembali</button>

        <h4 class="text-center text-primary mb-3">🔍 Tracking Laporan</h4>

        <form method="GET">
            <input type="email" name="email" class="form-control mb-2" placeholder="Masukkan email..." required>
            <button class="btn btn-primary w-100">Cek Status 🚀</button>
        </form>

        <?php
        if(isset($_GET['email'])){
            $email = $_GET['email'];
            $data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE email='$email'");

            if(mysqli_num_rows($data) > 0){
                while($d = mysqli_fetch_array($data)){
        ?>
        <div class="card mt-3 p-3">

            <p><b>📝 Laporan:</b><br><?= $d['isi_laporan']; ?></p>

            <p><b>📌 Status:</b>
                <?php if($d['status']=='menunggu'){ ?>
                    <span class="badge badge-menunggu">⏳ Menunggu</span>
                <?php } elseif($d['status']=='diproses'){ ?>
                    <span class="badge badge-diproses">🔄 Diproses</span>
                <?php } else { ?>
                    <span class="badge badge-selesai">✅ Selesai</span>
                <?php } ?>
            </p>

            <p><b>📷 Bukti:</b><br>
                <?php if(!empty($d['bukti'])){ ?>
                    <img src="../gambar/<?= $d['bukti']; ?>" width="120" class="rounded">
                <?php } else { ?>
                    <span class="text-muted">Tidak ada</span>
                <?php } ?>
            </p>

        </div>
        <?php
                }
            } else {
                echo "<div class='alert alert-danger mt-3 text-center'>❌ Email tidak ditemukan</div>";
            }
        }
        ?>
    </div>

</div>

<script>
function goToForm(){
    document.getElementById("landingMenu").style.display = "none";
    document.getElementById("formPengaduan").style.display = "block";
}

function goToTracking(){
    document.getElementById("landingMenu").style.display = "none";
    document.getElementById("trackingSection").style.display = "block";
}

function backHome(){
    document.getElementById("landingMenu").style.display = "block";
    document.getElementById("formPengaduan").style.display = "none";
    document.getElementById("trackingSection").style.display = "none";
}
</script>

<?php include 'footer.php'; ?>

</body>
</html>