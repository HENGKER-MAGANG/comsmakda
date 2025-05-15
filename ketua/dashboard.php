<?php
session_start();
require '../db.php';
require '../auth.php';
cekRole(['ketua']);

include 'partials/header.php';
include 'partials/navbar.php';

// Ambil data absensi
$queryHadir = mysqli_query($conn, "SELECT * FROM absensi WHERE status='Hadir'");
$queryIzin = mysqli_query($conn, "SELECT * FROM absensi WHERE status='Izin'");
$queryAlpa = mysqli_query($conn, "SELECT * FROM absensi WHERE status='Alpa'");

$jumlahHadir = mysqli_num_rows($queryHadir);
$jumlahIzin = mysqli_num_rows($queryIzin);
$jumlahAlpa = mysqli_num_rows($queryAlpa);

// Ambil saldo kas
$queryKas = mysqli_query($conn, "SELECT SUM(jumlah) AS total_saldo FROM kas WHERE is_tunggakan = 0");
$dataKas = mysqli_fetch_assoc($queryKas);
$saldoKas = $dataKas['total_saldo'] ?? 0;

// Ambil jumlah anggota
$queryAnggota = mysqli_query($conn, "SELECT * FROM users WHERE role = 'anggota'");
$jumlahAnggota = mysqli_num_rows($queryAnggota);

// Ambil jumlah anggota yang memiliki tunggakan
$queryTunggakan = mysqli_query($conn, "SELECT DISTINCT id_user FROM kas WHERE is_tunggakan = 1");
$jumlahTunggakan = mysqli_num_rows($queryTunggakan);
?>

<div class="container py-4">
  <h2 class="mb-4">Selamat Datang, Ketua!</h2>
  <p>Berikut adalah ringkasan data:</p>

  <!-- Baris pertama -->
  <div class="row g-3">
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-info border-5">
        <div class="card-body">
          <h5 class="card-title">Jumlah Anggota</h5>
          <p class="card-text fs-4"><?= $jumlahAnggota ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-success border-5">
        <div class="card-body">
          <h5 class="card-title">Jumlah Hadir</h5>
          <p class="card-text fs-4"><?= $jumlahHadir ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-primary border-5">
        <div class="card-body">
          <h5 class="card-title">Izin</h5>
          <p class="card-text fs-4"><?= $jumlahIzin ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-danger border-5">
        <div class="card-body">
          <h5 class="card-title">Alpa</h5>
          <p class="card-text fs-4"><?= $jumlahAlpa ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Baris kedua -->
  <div class="row g-3 mt-1">
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-warning border-5">
        <div class="card-body">
          <h5 class="card-title">Saldo Kas</h5>
          <p class="card-text fs-4">Rp<?= number_format($saldoKas, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-start border-dark border-5">
        <div class="card-body">
          <h5 class="card-title">Tunggakan Kas</h5>
          <p class="card-text fs-4"><?= $jumlahTunggakan ?> anggota</p>
          <a href="tunggakan.php" class="btn btn-outline-dark btn-sm mt-2">Lihat Tunggakan</a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include 'partials/footer.php'; ?>
