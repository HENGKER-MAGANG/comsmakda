<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

if (!in_array($_SESSION['role'], ['sekretaris', 'ketua'])) {
    header("Location: ../login.php");
    exit;
}

// Default tanggal (7 hari terakhir)
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-d', strtotime('-7 days'));
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

// Query rekap dengan filter tanggal
$query = "
    SELECT 
        u.username,
        SUM(CASE WHEN a.status = 'Hadir' THEN 1 ELSE 0 END) AS hadir,
        SUM(CASE WHEN a.status = 'Izin' THEN 1 ELSE 0 END) AS izin,
        SUM(CASE WHEN a.status = 'Alpa' THEN 1 ELSE 0 END) AS alpa
    FROM users u
    LEFT JOIN absensi a ON u.username = a.username
        AND a.tanggal BETWEEN ? AND ?
    WHERE u.role = 'anggota'
    GROUP BY u.username
    ORDER BY u.username
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $tgl_awal, $tgl_akhir);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container py-4">
    <h4 class="mb-4">Rekapitulasi Absensi</h4>

    <!-- Form Filter Tanggal -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
            <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" value="<?= $tgl_awal ?>" required>
        </div>
        <div class="col-md-4">
            <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?>" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    <!-- Tabel Rekap -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Alpa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()):
                    $total = $row['hadir'] + $row['izin'] + $row['alpa'];
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= $row['hadir'] ?></td>
                    <td><?= $row['izin'] ?></td>
                    <td><?= $row['alpa'] ?></td>
                    <td><?= $total ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
</div>

<?php include 'partials/footer.php'; ?>
