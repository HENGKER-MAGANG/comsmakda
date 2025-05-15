<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'sekretaris') {
    header("Location: index.php");
    exit;
}

$tanggal = date('Y-m-d');

$jumlah_anggota = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'anggota'")->fetch_assoc()['total'];
$jumlah_absen_unik = $conn->query("SELECT COUNT(DISTINCT username) as total FROM absensi WHERE tanggal = '$tanggal'")->fetch_assoc()['total'];

if ($jumlah_absen_unik >= $jumlah_anggota) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Sudah Absen',
                text: 'Semua anggota telah absen hari ini.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = 'dashboard.php';
            });
        });
    </script>";
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    exit;
}

$anggota = $conn->query("SELECT username FROM users WHERE role = 'anggota' AND username NOT IN (
    SELECT username FROM absensi WHERE tanggal = '$tanggal'
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['status'] as $username => $status) {
        $stmt = $conn->prepare("INSERT INTO absensi (tanggal, username, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tanggal, $username, $status);
        $stmt->execute();
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data absensi berhasil disimpan.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = 'dashboard.php';
            });
        });
    </script>";
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Absensi Anggota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table th, .table td {
            vertical-align: middle !important;
            text-align: center;
        }
        .radio-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        @media (max-width: 576px) {
            .radio-group {
                flex-direction: row;
                gap: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Input Absensi Anggota (<?= date('d M Y') ?>)</h5>
        </div>
        <div class="card-body">

            <?php if ($anggota->num_rows === 0): ?>
                <div class="alert alert-success text-center fs-5">
                    Semua anggota telah melakukan absensi hari ini.
                </div>
            <?php else: ?>

                <form method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Username</th>
                                    <th>Status<br><small>(H | I | A)</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($row = $anggota->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                    <td>
                                        <div class="radio-group">
                                            <input class="form-check-input" type="radio" name="status[<?= $row['username'] ?>]" value="Hadir" checked title="Hadir">
                                            <input class="form-check-input" type="radio" name="status[<?= $row['username'] ?>]" value="Izin" title="Izin">
                                            <input class="form-check-input" type="radio" name="status[<?= $row['username'] ?>]" value="Alpa" title="Alpa">
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="dashboard.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Simpan Absensi
                        </button>
                    </div>
                </form>

            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Bootstrap & SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
