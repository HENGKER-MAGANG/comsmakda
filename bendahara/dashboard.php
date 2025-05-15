<?php
session_start();
require '../db.php';
require_once '../auth.php';
cekRole(['bendahara']);

include 'partials/header.php';
include 'partials/navbar.php';

$total_kas = $conn->query("SELECT SUM(jumlah) AS total FROM kas")->fetch_assoc()['total'] ?? 0;
$total_pengeluaran = $conn->query("SELECT SUM(jumlah) AS total FROM pengeluaran")->fetch_assoc()['total'] ?? 0;
$sisa = $total_kas - $total_pengeluaran;
?>

<div class="container-fluid px-3 py-3">
    <h4 class="text-center text-primary mb-4">Dashboard Bendahara</h4>

    <!-- Ringkasan Keuangan -->
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-success h-100">
                <div class="card-body text-center py-3">
                    <h6 class="text-muted mb-1">Total Pemasukan</h6>
                    <h5 class="text-success fw-bold">Rp <?= number_format($total_kas, 0, ',', '.') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-danger h-100">
                <div class="card-body text-center py-3">
                    <h6 class="text-muted mb-1">Total Pengeluaran</h6>
                    <h5 class="text-danger fw-bold">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-primary h-100">
                <div class="card-body text-center py-3">
                    <h6 class="text-muted mb-1">Saldo Akhir</h6>
                    <h5 class="text-primary fw-bold">Rp <?= number_format($sisa, 0, ',', '.') ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Aksi -->
    <div class="row g-3 mt-4">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white text-center">Menu Kas (Pemasukan)</div>
                <div class="card-body">
                    <a href="input_kas.php" class="btn btn-success w-100 mb-2">+ Input Kas</a>
                    <a href="data_kas.php" class="btn btn-outline-success w-100">📄 Data Kas</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger text-white text-center">Menu Pengeluaran</div>
                <div class="card-body">
                    <a href="input_pengeluaran.php" class="btn btn-danger w-100 mb-2">+ Input Pengeluaran</a>
                    <a href="data_pengeluaran.php" class="btn btn-outline-danger w-100">📄 Data Pengeluaran</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
