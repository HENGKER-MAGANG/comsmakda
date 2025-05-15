<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_manual'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'anggota')");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Anggota berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan anggota.";
    }
    header("Location: anggota.php");
    exit;
}
?>

<div class="container py-4">

    <?php if (isset($_SESSION['success'])): ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '<?= $_SESSION['success'] ?>',
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    <?php unset($_SESSION['success']); endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= $_SESSION['error'] ?>',
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    <?php unset($_SESSION['error']); endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Tambah Anggota</h4>
        <a href="anggota.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="tambah_anggota.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <button type="submit" name="submit_manual" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>

</div>

<?php include 'partials/footer.php'; ?>
