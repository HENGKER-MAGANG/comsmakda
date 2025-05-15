<?php
session_start();
if ($_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}
include 'partials/header.php';
include 'partials/navbar.php';
require '../db.php';

$username = $_SESSION['username'];

// Ambil seluruh riwayat pembayaran user
$riwayat = $conn->query("SELECT * FROM kas WHERE username = '$username' ORDER BY tanggal DESC");
?>

<div class="container mt-4">
    <h3 class="mb-4">Riwayat Pembayaran Kas (Setiap Rabu & Jumat)</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $hasData = false;
                while ($row = $riwayat->fetch_assoc()):
                    $tanggal = $row['tanggal'];
                    $day = date('l', strtotime($tanggal)); // Mengambil nama hari
                    if ($day === 'Wednesday' || $day === 'Friday'):
                        $hasData = true;
                ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $tanggal ?></td>
                        <td><?= $day ?></td>
                        <td><?= htmlspecialchars($row['bulan']) ?></td>
                        <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                    </tr>
                <?php 
                    endif;
                endwhile;

                if (!$hasData): ?>
                    <tr><td colspan="5" class="text-center">Belum ada pembayaran pada hari Rabu atau Jumat.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="dashboard.php" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
    </a>
</div>

<?php include 'partials/footer.php'; ?>
