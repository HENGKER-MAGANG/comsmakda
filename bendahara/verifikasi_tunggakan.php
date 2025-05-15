<?php
session_start();
include '../db.php';
include 'partials/header.php';

// Query ambil data tunggakan yang menunggu verifikasi
$query = mysqli_query($conn, "
  SELECT pt.*, u.username AS nama
  FROM pembayaran_tunggakan pt 
  JOIN users u ON pt.id_user = u.id 
  WHERE pt.status = 'Menunggu'
");
?>
<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<div class="container py-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Verifikasi Pembayaran Tunggakan</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Tanggal Pengajuan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
                <td><?= date('d/m/Y', strtotime($data['tanggal_pengajuan'])) ?></td>
                <td><span class="badge bg-warning"><?= $data['status'] ?></span></td>
                <td>
                  <a href="proses_verifikasi.php?id=<?= $data['id'] ?>&aksi=setuju" class="btn btn-success btn-sm">
                    <i class="bi bi-check-circle"></i> Setujui
                  </a>
                  <a href="proses_verifikasi.php?id=<?= $data['id'] ?>&aksi=tolak" class="btn btn-danger btn-sm">
                    <i class="bi bi-x-circle"></i> Tolak
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <?php if (mysqli_num_rows($query) === 0) : ?>
              <tr>
                <td colspan="5">Tidak ada pengajuan tunggakan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
