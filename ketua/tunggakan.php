<?php
require '../db.php';
require '../auth.php';
cekRole(['ketua']);

include 'partials/header.php';
include 'partials/navbar.php';

// Ambil data tunggakan per anggota
$query = mysqli_query($conn, "
    SELECT u.username, SUM(k.jumlah) AS total_tunggakan
    FROM kas k
    JOIN users u ON k.id_user = u.id
    WHERE k.is_tunggakan = 1
    GROUP BY k.id_user
    ORDER BY u.username ASC
");
?>

<div class="container py-4">
    <h3 class="mb-4">Daftar Tunggakan Kas Anggota</h3>

    <?php if (mysqli_num_rows($query) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Total Tunggakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td>Rp<?= number_format($row['total_tunggakan'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-success">Tidak ada anggota yang memiliki tunggakan.</div>
    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>

<?php include 'partials/footer.php'; ?>
