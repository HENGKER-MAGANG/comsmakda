<?php
session_start();
require '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$user = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();

// Soal penjumlahan
$a = rand(1, 10);
$b = rand(1, 10);
$_SESSION['captcha'] = $a + $b;

include 'partials/header.php';
include 'partials/navbar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5>Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form id="ubahPasswordForm" method="POST" action="proses_ubah_password.php">
                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Berapa <?= $a ?> + <?= $b ?>?</label>
                            <input type="number" name="jawaban" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <a href="profil.php" class="btn btn-secondary">← Kembali</a>
                            <button type="submit" class="btn btn-success">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_SESSION['error'])) {
    echo "<script>Swal.fire('Gagal!', '{$_SESSION['error']}', 'error');</script>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<script>Swal.fire('Berhasil!', '{$_SESSION['success']}', 'success');</script>";
    unset($_SESSION['success']);
}
?>

<?php include 'partials/footer.php'; ?>
