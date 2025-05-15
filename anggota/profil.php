<?php
session_start();
require '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$data = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();

include 'partials/header.php';
include 'partials/navbar.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Username</th>
                            <td><?= htmlspecialchars($data['username']) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= htmlspecialchars($data['nama'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($data['email'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><span class="badge bg-success"><?= ucfirst($data['role']) ?></span></td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <a href="ubah_password.php" class="btn btn-warning">
                            <i class="bi bi-key"></i> Ubah Password
                        </a>
                        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
