<?php
require '../db.php';
require_once '../auth.php';
cekRole(['sekretaris']); // Cek hak akses

include 'partials/header.php';
include 'partials/navbar.php';
?>

<div class="container py-4">
    <h3>Selamat Datang, Sekretaris!</h3>
    <p class="text-muted">Anda dapat mengelola data absensi anggota di sini.</p>

    <div class="row">
        <div class="col-md-6">
            <a href="absen_input.php" class="btn btn-success mb-3">
                <i class="bi bi-pencil-square"></i> Input Absensi Hari Ini
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Data Absensi Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM absensi ORDER BY tanggal DESC LIMIT 10");
                        $no = 1;
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if ($result->num_rows === 0): ?>
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data absensi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
