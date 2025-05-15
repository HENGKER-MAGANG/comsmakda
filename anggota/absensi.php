<?php
session_start();
if ($_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}

require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

$username = $_SESSION['username'];
$riwayat = $conn->query("SELECT * FROM absensi WHERE username = '$username' ORDER BY tanggal DESC");
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Riwayat Absensi</h4>
        </div>
        <div class="card-body">
            <?php if ($riwayat->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = $riwayat->fetch_assoc()): ?>
                                <tr class="text-center">
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                    <td>
                                        <span class="badge 
                                            <?= $row['status'] == 'Hadir' ? 'bg-success' : 
                                                ($row['status'] == 'Izin' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                            <?= htmlspecialchars($row['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center mb-0">
                    Tidak ada data absensi ditemukan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
