<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'bendahara') {
    header("Location: ../login.php");
    exit;
}

$pengeluaran = $conn->query("SELECT * FROM pengeluaran ORDER BY tanggal DESC");
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<div class="container py-4">
    <h4>Data Pengeluaran</h4>
    <a href="input_pengeluaran.php" class="btn btn-primary mb-3">+ Tambah Pengeluaran</a>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Jumlah (Rp)</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; $total = 0; while ($row = $pengeluaran->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td class="text-end"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                            <td><?= $row['tanggal'] ?></td>
                        </tr>
                        <?php $total += $row['jumlah']; endwhile; ?>
                        <tr class="table-secondary">
                            <th colspan="2" class="text-end">Total</th>
                            <th class="text-end"><?= number_format($total, 0, ',', '.') ?></th>
                            <th></th>
                        </tr>
                        <?php if ($no === 1): ?>
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data pengeluaran.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
