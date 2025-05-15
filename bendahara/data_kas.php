<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

// Ambil semua tanggal unik dari tabel kas, urutkan terbaru ke lama
$tanggal_list = $conn->query("SELECT DISTINCT tanggal FROM kas ORDER BY tanggal DESC");
?>

<div class="container py-4">
    <h4>Data Uang Kas</h4>

    <?php while ($tgl = $tanggal_list->fetch_assoc()): 
        $tanggal = $tgl['tanggal'];
        $kas_harian = $conn->query("SELECT * FROM kas WHERE tanggal = '$tanggal' ORDER BY username ASC");
        
        // Hitung total kas per tanggal
        $total_harian_result = $conn->query("SELECT SUM(jumlah) AS total FROM kas WHERE tanggal = '$tanggal'");
        $total_harian = $total_harian_result->fetch_assoc()['total'];
    ?>
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0">Tanggal: <?= date('d-m-Y', strtotime($tanggal)) ?></h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = $kas_harian->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $row['username'] ?></td>
                                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="edit_kas.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <tr class="table-secondary fw-bold">
                                <td colspan="2" class="text-end">Total Pemasukan:</td>
                                <td colspan="2">Rp <?= number_format($total_harian, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'partials/footer.php'; ?>
