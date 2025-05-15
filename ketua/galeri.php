<?php
require '../db.php';
require '../auth.php';
cekRole(['ketua']);

include 'partials/header.php';
include 'partials/navbar.php';

// Ambil semua data dari tabel galeri
$galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY tanggal DESC");
?>

<div class="container py-4">
  <h2 class="mb-4">Galeri Dokumentasi</h2>
  <a href="upload_dokumentasi.php" class="btn btn-primary mb-3">+ Upload Dokumentasi</a>

  <div class="row">
    <?php while ($g = mysqli_fetch_assoc($galeri)) : ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <img src="../upload_dokumentasi/<?= htmlspecialchars($g['gambar']) ?>" class="card-img-top" alt="Dokumentasi">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($g['judul']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($g['deskripsi']) ?></p>
            <small class="text-muted">Tanggal: <?= $g['tanggal'] ?></small>
            <form action="hapus_dokumentasi.php" method="post" onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
              <input type="hidden" name="id" value="<?= $g['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm mt-2">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
