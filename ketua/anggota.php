<?php
session_start();
require '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';
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
        <h4 class="mb-0">Data Anggota</h4>
        <a href="tambah_anggota.php" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = $conn->query("SELECT * FROM users WHERE role = 'anggota' ORDER BY id DESC");
                        if ($query->num_rows > 0):
                            while ($row = $query->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning mb-1 reset-btn"
                                        data-id="<?= $row['id'] ?>"
                                        data-username="<?= $row['username'] ?>">
                                    <i class="bi bi-key-fill"></i> Reset
                                </button>
                                <button class="btn btn-sm btn-danger hapus-btn"
                                        data-id="<?= $row['id'] ?>"
                                        data-username="<?= $row['username'] ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data anggota.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const hapusBtns = document.querySelectorAll(".hapus-btn");
    const resetBtns = document.querySelectorAll(".reset-btn");

    hapusBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const username = this.getAttribute("data-username");
            Swal.fire({
                title: 'Yakin hapus?',
                text: `Data anggota "${username}" akan dihapus!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapus_anggota.php?id=${id}`;
                }
            });
        });
    });

    resetBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const username = this.getAttribute("data-username");
            Swal.fire({
                title: 'Reset Password?',
                text: `Password anggota "${username}" akan direset ke default.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, reset!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `reset_password.php?id=${id}`;
                }
            });
        });
    });
});
</script>

<?php include 'partials/footer.php'; ?>
