<?php
include '../db.php';
include '../auth.php';
cekRole(['ketua']); // Atau role yang berwenang melihat pesan

// Proses hapus jika ada parameter ?delete=id
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM pesan WHERE id = $id");
  echo "<script>window.location.href = 'pesan.php?hapus=1';</script>";
  exit();
}

$result = $conn->query("SELECT * FROM pesan ORDER BY tanggal DESC");
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<div class="container py-4">
  <h3 class="mb-4">Pesan Masuk</h3>

  <?php if (isset($_GET['hapus'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Pesan berhasil dihapus!',
        confirmButtonText: 'OK'
      });
    </script>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Nomor WA</th>
          <th>Pesan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['nomor_wa']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td>
            <button class="btn btn-danger btn-sm" onclick="hapusPesan(<?= $row['id'] ?>)">Hapus</button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function hapusPesan(id) {
    Swal.fire({
      title: 'Yakin hapus pesan ini?',
      text: 'Data akan dihapus permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'pesan.php?delete=' + id;
      }
    });
  }
</script>

<?php include 'partials/footer.php'; ?>
