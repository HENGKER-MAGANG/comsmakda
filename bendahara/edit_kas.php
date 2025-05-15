<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

if ($_SESSION['role'] !== 'bendahara') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: data_kas.php");
    exit;
}

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM kas WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<div class='container mt-4 alert alert-danger'>Data tidak ditemukan.</div>";
    include 'partials/footer.php';
    exit;
}

// Ambil list anggota untuk dropdown
$anggota = $conn->query("SELECT * FROM users WHERE role = 'anggota'");
?>

<div class="container py-4">
    <h4>Edit Data Kas</h4>
    <form action="proses_edit_kas.php" method="POST" class="card p-4 shadow-sm mt-3">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="username">Anggota</label>
            <select name="username" class="form-select" required>
                <?php while ($user = $anggota->fetch_assoc()): ?>
                <option value="<?= $user['username'] ?>" <?= ($user['username'] === $data['username']) ? 'selected' : '' ?>>
                    <?= $user['username'] ?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="bulan">Bulan</label>
            <input type="month" name="bulan" class="form-control" value="<?= $data['bulan'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
        <a href="data_kas.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
