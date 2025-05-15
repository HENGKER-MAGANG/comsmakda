<?php
session_start();
include 'partials/header.php';
include 'partials/navbar.php';
require '../db.php';

if ($_SESSION['role'] !== 'ketua') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM kas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah = $_POST['jumlah'];

    $updateStmt = $conn->prepare("UPDATE kas SET jumlah = ? WHERE id = ?");
    $updateStmt->bind_param("di", $jumlah, $id);
    if ($updateStmt->execute()) {
        // Log aktivitas
        $logStmt = $conn->prepare("INSERT INTO log_kas (username, aksi, jumlah) VALUES (?, 'Edit Kas', ?)");
        $logStmt->bind_param("sd", $_SESSION['username'], $jumlah);
        $logStmt->execute();

        $_SESSION['success'] = "Data kas berhasil diperbarui.";
        header("Location: kas.php");
        exit;
    } else {
        $_SESSION['error'] = "Gagal memperbarui data kas.";
    }
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4">Edit Pembayaran Kas</h4>
                    <form method="POST" id="editKasForm">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah"
                                   value="<?= htmlspecialchars($row['jumlah']) ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="kas.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Konfirmasi sebelum submit
document.getElementById('editKasForm').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Simpan Perubahan?',
        text: 'Pastikan jumlah pembayaran sudah benar.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
});
</script>

<?php include 'partials/footer.php'; ?>
