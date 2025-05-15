<?php
session_start();
require_once '../auth.php';
require '../db.php';
cekRole(['anggota']); // Cek peran login

// Cek apakah user login dan ambil ID
if (isset($_SESSION['id_anggota'])) {
    $id_user = intval($_SESSION['id_anggota']);
} elseif (isset($_SESSION['id'])) {
    $id_user = intval($_SESSION['id']);
} else {
    header("Location: ../login.php");
    exit;
}

// Ambil data tunggakan
$query = "SELECT * FROM kas WHERE id_user = $id_user AND is_tunggakan = 1";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tunggakan Kas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">Daftar Tunggakan Kas</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-white shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['bulan']); ?></td>
                                <td>Rp<?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Tunggakan',
                    text: 'Anda tidak memiliki tunggakan kas saat ini.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'dashboard.php';
                });
            </script>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
