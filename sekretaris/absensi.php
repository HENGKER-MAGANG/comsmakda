<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

// Cek role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'sekretaris') {
    header("Location: ../login.php");
    exit;
}

$tanggal_hari_ini = date('Y-m-d');

// Ambil data absensi hari ini
$absen_hari_ini = $conn->query("SELECT * FROM absensi WHERE tanggal = '$tanggal_hari_ini' ORDER BY id DESC");

// Ambil data absensi sebelumnya (tidak termasuk hari ini)
$absen_lainnya = $conn->query("
    SELECT * FROM absensi 
    WHERE tanggal != '$tanggal_hari_ini' 
    ORDER BY tanggal DESC, id DESC
");

// Fungsi ubah nama hari ke Bahasa Indonesia
function namaHari($tanggal) {
    $hariInggris = date('l', strtotime($tanggal));
    $daftarHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    return $daftarHari[$hariInggris] ?? $hariInggris;
}
?>

<div class="container py-4">
    <h4 class="mb-4">Data Absensi Hari Ini (<?= namaHari($tanggal_hari_ini) ?>, <?= $tanggal_hari_ini ?>)</h4>
    <div class="card mb-5">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($absen_hari_ini->num_rows > 0): ?>
                        <?php $no = 1; while ($row = $absen_hari_ini->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['status']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center text-muted">Belum ada absensi hari ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="mb-4">Data Absensi Sebelumnya</h4>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($absen_lainnya->num_rows > 0): ?>
                        <?php $no = 1; while ($row = $absen_lainnya->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= namaHari($row['tanggal']) ?></td>
                            <td class="text-center"><?= $row['tanggal'] ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['status']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center text-muted">Belum ada absensi sebelumnya.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
