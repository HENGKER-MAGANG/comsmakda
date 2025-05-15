<?php
session_start();
if ($_SESSION['role'] !== 'ketua') {
  header("Location: ../login.php");
  exit;
}

include 'partials/header.php';
include 'partials/navbar.php';
require '../db.php';

// Proses tambah kas
if (isset($_POST['tambah_kas'])) {
  $jumlah = (int) $_POST['jumlah'];
  $username = $_SESSION['username'];

  if ($jumlah > 0) {
    $stmt = $conn->prepare("INSERT INTO kas (username, tanggal, jumlah) VALUES (?, NOW(), ?)");
    $stmt->bind_param("si", $username, $jumlah);
    $stmt->execute();

    // Log aktivitas
    $log = $conn->prepare("INSERT INTO log_kas (username, aksi, jumlah, tanggal) VALUES (?, 'Menambahkan dana', ?, NOW())");
    $log->bind_param("si", $username, $jumlah);
    $log->execute();

    echo "<script>
      Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Dana berhasil ditambahkan!' })
      .then(() => window.location.href = 'kas.php');
    </script>";
    exit;
  } else {
    echo "<script>
      Swal.fire({ icon: 'error', title: 'Gagal', text: 'Jumlah harus lebih dari 0!' });
    </script>";
  }
}

// Proses hapus kas
if (isset($_GET['hapus_id'])) {
  $id = $_GET['hapus_id'];

  $query = $conn->prepare("SELECT * FROM kas WHERE id = ?");
  $query->bind_param("i", $id);
  $query->execute();
  $result = $query->get_result();
  $row = $result->fetch_assoc();

  $deleteQuery = $conn->prepare("DELETE FROM kas WHERE id = ?");
  $deleteQuery->bind_param("i", $id);
  if ($deleteQuery->execute()) {
    $log = $conn->prepare("INSERT INTO log_kas (username, aksi, jumlah, tanggal) VALUES (?, 'Hapus Dana', ?, NOW())");
    $log->bind_param("si", $_SESSION['username'], $row['jumlah']);
    $log->execute();

    echo "<script>
      Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Dana berhasil dihapus!' })
      .then(() => window.location.href = 'kas.php');
    </script>";
    exit;
  }
}

$result = $conn->query("SELECT * FROM kas ORDER BY tanggal DESC");
?>

<div class="container mt-4">
  <h2 class="mb-4 text-center">Manajemen Dana Kas</h2>

  <!-- Form Tambah Dana -->
  <form method="POST" class="mb-4">
    <div class="row g-2 align-items-center">
      <div class="col-12 col-md-9">
        <input type="number" name="jumlah" class="form-control form-control-lg" placeholder="Masukkan jumlah dana (Rp)" required>
      </div>
      <div class="col-12 col-md-3 d-grid">
        <button type="submit" name="tambah_kas" class="btn btn-success btn-lg">Tambah Dana</button>
      </div>
    </div>
  </form>

  <!-- Tabel Data Kas -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
          <td class="text-center">
            <div class="btn-group">
              <a href="edit_kas.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiHapus(<?= $row['id'] ?>)">Hapus</button>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Log Aktivitas -->
  <h4 class="mt-5 text-center">Log Aktivitas Ketua</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-warning text-center">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Aksi</th>
          <th>Jumlah</th>
          <th>Waktu</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $logs = $conn->query("SELECT * FROM log_kas ORDER BY tanggal DESC");
          $i = 1;
          while ($log = $logs->fetch_assoc()):
        ?>
        <tr>
          <td class="text-center"><?= $i++ ?></td>
          <td><?= htmlspecialchars($log['username']) ?></td>
          <td><?= $log['aksi'] ?></td>
          <td>Rp <?= number_format($log['jumlah'], 0, ',', '.') ?></td>
          <td><?= $log['tanggal'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiHapus(id) {
  Swal.fire({
    title: 'Yakin ingin menghapus?',
    text: 'Tindakan ini tidak dapat dibatalkan!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'kas.php?hapus_id=' + id;
    }
  });
}
</script>

<?php include 'partials/footer.php'; ?>
