<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'bendahara') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $stmt = $conn->prepare("INSERT INTO pengeluaran (keterangan, jumlah, tanggal) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $keterangan, $jumlah, $tanggal);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Pengeluaran berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan pengeluaran.";
    }
    header("Location: data_pengeluaran.php");
    exit;
}
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<div class="container py-4">
    <h4>Input Pengeluaran</h4>
    <form method="POST" class="card p-3 shadow-sm">
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
