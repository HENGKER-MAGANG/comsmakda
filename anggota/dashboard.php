<?php
session_start();
require_once '../auth.php';
cekRole(['anggota']);

if ($_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}

require '../db.php';
include('partials/header.php');
include('partials/navbar.php');

$username = $_SESSION['username'];

// Total pertemuan kas
$pertemuan = $conn->query("SELECT COUNT(*) as total FROM jadwal_kas")->fetch_assoc()['total'];
$total_seharusnya = $pertemuan * 2000;

// Total pembayaran kas user
$kas_query = $conn->query("SELECT SUM(jumlah) as total FROM kas WHERE username = '$username'");
$dibayar = $kas_query->fetch_assoc()['total'] ?? 0;
$dibayar = $dibayar ?: 0;
$tunggakan = $total_seharusnya - $dibayar;

// Persentase bayar kas
$persentase_bayar = ($total_seharusnya > 0) ? ($dibayar / $total_seharusnya) * 100 : 0;
$warna_progress = 'bg-success';
if ($persentase_bayar < 50) $warna_progress = 'bg-danger';
elseif ($persentase_bayar < 100) $warna_progress = 'bg-warning';

// Statistik absensi
$statistik = ['Hadir' => 0, 'Izin' => 0, 'Alpa' => 0];
$absen = $conn->query("SELECT status, COUNT(*) as total FROM absensi WHERE username = '$username' GROUP BY status");
while ($row = $absen->fetch_assoc()) {
    $statistik[$row['status']] = $row['total'];
}

// Riwayat absensi
$riwayat = $conn->query("SELECT * FROM absensi WHERE username = '$username' ORDER BY tanggal DESC");
?>

<div class="container-fluid mt-4 px-3 px-md-5">
    <h2 class="mb-4 text-center text-md-start">Community Programmer</h2>

    <div class="alert alert-info">
        Selamat datang, <strong><?= htmlspecialchars($username) ?></strong>!
    </div>

    <?php if ($tunggakan > 10000): ?>
        <div class="alert alert-danger">
            ⚠️ Anda memiliki tunggakan lebih dari <strong>Rp 10.000</strong>. Harap segera melakukan pembayaran kas.
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Informasi Kas -->
        <div class="col">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <strong>Informasi Kas</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Pertemuan Kas: <strong><?= $pertemuan ?>x</strong></li>
                        <li class="list-group-item">Total Harus Dibayar: <strong>Rp <?= number_format($total_seharusnya, 0, ',', '.') ?></strong></li>
                        <li class="list-group-item">Sudah Dibayar: <strong>Rp <?= number_format($dibayar, 0, ',', '.') ?></strong></li>
                        <li class="list-group-item">Tunggakan: <strong class="text-danger">Rp <?= number_format($tunggakan, 0, ',', '.') ?></strong></li>
                    </ul>
                    <label class="form-label">Progres Pembayaran Kas:</label>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar <?= $warna_progress ?>" role="progressbar"
                             style="width: <?= round($persentase_bayar) ?>%;"
                             aria-valuenow="<?= round($persentase_bayar) ?>" aria-valuemin="0" aria-valuemax="100">
                            <?= round($persentase_bayar) ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Absensi -->
        <div class="col">
            <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <strong>Statistik Absensi</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Hadir: <span class="badge bg-success"><?= $statistik['Hadir'] ?></span></li>
                        <li class="list-group-item">Izin: <span class="badge bg-warning text-dark"><?= $statistik['Izin'] ?></span></li>
                        <li class="list-group-item">Alpa: <span class="badge bg-danger"><?= $statistik['Alpa'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <!-- Riwayat Absensi -->
    <h4 class="mb-3">Riwayat Absensi</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $riwayat->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td>
                        <span class="badge bg-<?= 
                            $row['status'] == 'Hadir' ? 'success' : 
                            ($row['status'] == 'Izin' ? 'warning text-dark' : 'danger') ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if ($no === 1): ?>
                    <tr><td colspan="3" class="text-center">Belum ada data absensi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php if (isset($_SESSION['success_login'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: '<?= $_SESSION['success_login'] ?>',
            showConfirmButton: false,
            timer: 2500
        });
    });
</script>
<?php unset($_SESSION['success_login']); ?>
<?php endif; ?>
