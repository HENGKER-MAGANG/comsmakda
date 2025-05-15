<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>
<?php include '../db.php'; ?>

<?php
$alert = '';

// Proses Hapus
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete = $conn->prepare("DELETE FROM users WHERE id = ?");
    $delete->bind_param("i", $id);
    if ($delete->execute()) {
        $alert = "deleted";
    } else {
        $alert = "delete_error";
    }
}

// Proses Tambah Pengurus
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    if (empty($username) || empty($password) || empty($role)) {
        $alert = "empty";
    } else {
        $cek = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $cek->bind_param("s", $username);
        $cek->execute();
        $result = $cek->get_result();

        if ($result->num_rows > 0) {
            $alert = "exists";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hash, $role);
            if ($stmt->execute()) {
                $alert = "success";
            } else {
                $alert = "error";
            }
        }
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Manajemen Pengurus</h2>

    <!-- Tombol Modal Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Pengurus</button>

    <!-- Tabel Pengurus -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $stmt = $conn->query("SELECT * FROM users WHERE role IN ('sekretaris', 'bendahara')");
            while ($row = $stmt->fetch_assoc()):
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= ucfirst($row['role']) ?></td>
              <td>
                <button class="btn btn-danger btn-sm" onclick="hapusPengurus(<?= $row['id'] ?>)">
                  Hapus
                </button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
</div>

<!-- Modal Tambah Pengurus -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Pengurus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Role</label>
          <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="sekretaris">Sekretaris</option>
            <option value="bendahara">Bendahara</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
  </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- SweetAlert Notifikasi -->
<?php if ($alert): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    <?php if ($alert == 'success'): ?>
      Swal.fire('Berhasil', 'Pengurus berhasil ditambahkan!', 'success')
        .then(() => window.location.href = 'pengurus.php');
    <?php elseif ($alert == 'exists'): ?>
      Swal.fire('Gagal', 'Username sudah digunakan!', 'error');
    <?php elseif ($alert == 'empty'): ?>
      Swal.fire('Peringatan', 'Semua field harus diisi!', 'warning');
    <?php elseif ($alert == 'deleted'): ?>
      Swal.fire('Dihapus', 'Pengurus berhasil dihapus!', 'success')
        .then(() => window.location.href = 'pengurus.php');
    <?php elseif ($alert == 'delete_error'): ?>
      Swal.fire('Gagal', 'Gagal menghapus data!', 'error');
    <?php else: ?>
      Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan!', 'error');
    <?php endif; ?>
  });
</script>
<?php endif; ?>

<!-- SweetAlert Hapus -->
<script>
  function hapusPengurus(id) {
    Swal.fire({
      title: 'Hapus Pengurus?',
      text: "Data akan dihapus secara permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'pengurus.php?delete=' + id;
      }
    });
  }
</script>
