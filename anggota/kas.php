<?php
session_start();
require '../db.php';

// Cek apakah user login dan memiliki role anggota
if (!isset($_SESSION['id_anggota'])) {
    header("Location: ../login.php");
    exit;
}

include '../partials/header.php';
include '../cek_tunggakan.php'; // logika tunggakan otomatis

$id_anggota = $_SESSION['id_anggota'];

// Ambil data kas anggota dengan prepared statement
$stmt = $conn->prepare("SELECT * FROM kas WHERE id_anggota = ? ORDER BY tanggal DESC");
$stmt->bind_param("i", $id_anggota);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
  <h4>Riwayat Kas Anda</h4>

  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($kas = $result->fetch_assoc()): ?>
            <tr class="<?= ($kas['keterangan'] == 'Tunggakan') ? 'table-danger' : ''; ?>">
              <td><?= date('d/m/Y', strtotime($kas['tanggal'])) ?></td>
              <td>Rp<?= number_format($kas['jumlah'], 0, ',', '.') ?></td>
              <td><?= htmlspecialchars($kas['keterangan']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Belum ada data kas yang tercatat.</div>
  <?php endif; ?>
</div>

<?php include '../partials/footer.php'; ?>
