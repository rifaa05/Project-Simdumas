<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tracking Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #4e73df, #a0c4ff);
    min-height: 100vh;
}

/* Card */
.card {
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Tombol */
.btn-primary {
    background-color: #4e73df;
    border: none;
}

/* Emoji */
.emoji {
    font-size: 40px;
}

/* Status */
.badge-menunggu { background: gray; }
.badge-diproses { background: orange; }
.badge-selesai { background: green; }
</style>
</head>

<body>

<div class="container mt-5">

    <!-- HEADER -->
    <div class="text-center text-white mb-4">
        <div class="emoji">🔍📢</div>
        <h3>Tracking Pengaduan</h3>
        <p>Cek status laporan kamu dengan mudah 💙</p>
    </div>

    <!-- BUTTON CEK TRACKING -->
    <div class="text-center mb-4">
        <button class="btn btn-light" onclick="showTracking()">Cek Tracking 🔍</button>
    </div>

    <!-- FORM TRACKING (HIDDEN) -->
    <div id="trackingForm" style="display:none;">
        <div class="card p-4 mb-3">
            <form method="GET">
                <input type="email" name="email" class="form-control mb-2" placeholder="Masukkan email pengaduan!" required>
                <button class="btn btn-primary w-100">Cek Status 🚀</button>
            </form>
        </div>
    </div>

    <!-- HASIL -->
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id']; // FIX BUG (tadi kamu salah pakai variabel)
        $data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id='$id'");

        if(mysqli_num_rows($data) > 0){
            while($d = mysqli_fetch_array($data)){
    ?>

    <div class="card p-4">
        <h5 class="text-primary">📄 Detail Laporan</h5>

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

        <p><b>📷 Bukti Laporan:</b><br>
            <?php if(!empty($d['bukti'])){ ?>
                <img src="gambar/<?= $d['bukti']; ?>" width="150" class="rounded shadow">
            <?php } else { ?>
                <span class="text-danger">Tidak ada bukti</span>
            <?php } ?>
        </p> 
            }
        } else {
            echo "<div class='alert alert-danger text-center'>❌ ID tidak ditemukan</div>";
        }
    }
    ?>

</div>

<script>
function showTracking(){
    document.getElementById("trackingForm").style.display = "block";
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>