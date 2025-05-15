<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

if ($_SESSION['role'] !== 'bendahara') {
    header("Location: ../login.php");
    exit;
}

$anggota = $conn->query("SELECT * FROM users WHERE role = 'anggota'");
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Input Uang Kas</h5>
                </div>
                <div class="card-body">
                    <form action="proses_input_kas.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Anggota</label>
                            <select name="username" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Anggota --</option>
                                <?php while ($row = $anggota->fetch_assoc()): ?>
                                    <option value="<?= $row['username'] ?>"><?= $row['username'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 2000" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="data_kas.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (isset($_SESSION['kas_success'])): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data kas berhasil disimpan!',
                        confirmButtonColor: '#198754'
                    });
                });
            </script>
            <?php unset($_SESSION['kas_success']); endif; ?>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
