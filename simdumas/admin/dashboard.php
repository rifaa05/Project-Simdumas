<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

$data = mysqli_query($conn, "SELECT * FROM pengaduan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>admin kece </title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #4e73df, #a0c4ff);
    min-height: 100vh;
}

/* Navbar */
.navbar {
    background-color: #4e73df;
}

/* Card */
.card {
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Table */
.table {
    border-radius: 10px;
    overflow: hidden;
}

/* Badge status */
.badge-menunggu { background-color: gray; }
.badge-diproses { background-color: orange; }
.badge-selesai { background-color: green; }

/* Emoji header */
.emoji {
    font-size: 35px;
}
.card-soft-blue {
    background: #e7f0ff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(78,115,223,0.2);
}

.card-soft-blue h5 {
    color: #4e73df;
    font-weight: 600;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand">📢 Pengaduan Desa</span>
    <a href="logout.php" class="btn btn-light btn-sm">Logout 🚪</a>
</nav>

<div class="container mt-4">

<?php
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengaduan"));
$proses = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengaduan WHERE status='diproses'"));
$selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengaduan WHERE status='selesai'"));
?>

<div class="row mb-4">
  <div class="col-md-4">
    <div class="card bg-primary text-white shadow">
      <div class="card-body">
        <h6>📊Total Laporan</h6>
        <h3><?= $total ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card bg-warning text-dark shadow">
      <div class="card-body">
        <h6>🔄Diproses</h6>
        <h3><?= $proses ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card bg-success text-white shadow">
      <div class="card-body">
        <h6>✅Selesai</h6>
        <h3><?= $selesai ?></h3>
      </div>
    </div>
  </div>
</div>

    <!-- HEADER -->
    <div class="text-center text-white mb-4">
        <div class="emoji">📢📋</div>
        <h3>Dashboard Admin Desa Ciborelang</h3>
        <p>Kelola laporan masyarakat dengan mudah 💙</p>
    </div>

<div class="card card-soft-blue p-4">
    <h5 class="mb-3">📋 Data Laporan Masyarakat</h5>

    <!-- CARD -->
    <div class="card p-4">
	 <input type="text" id="search" class="form-control mb-3" placeholder="🔍 Cari laporan warga...">


        <!-- TABLE -->
        <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>👤 Nama</th>
                    <th>📝 Laporan</th>
                    <th>📷 Bukti</th>
                    <th>📌 Status</th>
                    <th>⚙️ Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $no=1; mysqli_data_seek($data,0); while($d = mysqli_fetch_array($data)){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama']; ?></td>
                <td style="text-align:left"><?= $d['isi_laporan']; ?></td>

                <td>
                    <img src="../gambar/<?= $d['bukti']; ?>" width="70" class="rounded shadow-sm">
                </td>

                <td>
                    <?php if($d['status']=='menunggu'){ ?>
                        <span class="badge badge-menunggu">⏳ Menunggu</span>
                    <?php } elseif($d['status']=='diproses'){ ?>
                        <span class="badge badge-diproses">🔄 Diproses</span>
                    <?php } else { ?>
                        <span class="badge badge-selesai">✅ Selesai</span>
                    <?php } ?>
                </td>

                <td>
    <a href="update_status.php?id=<?= $d['id']; ?>&status=diproses" 
       class="btn btn-warning btn-sm">Proses 🔄</a>

    <a href="update_status.php?id=<?= $d['id']; ?>&status=selesai" 
       class="btn btn-success btn-sm">Selesai ✅</a>

   
</td>
            </tr>
            <?php } ?>
            </tbody>

        </table>
        </div>

    </div>
</div>
<?php include 'footer.php';?>
<script>
document.getElementById("search").addEventListener("keyup", function() {
  let value = this.value.toLowerCase();
  let rows = document.querySelectorAll("tbody tr");

  rows.forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
  });
});
</script>
</body>
</html>