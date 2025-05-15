<?php
// koneksi ke database
include 'db.php';

// ambil data dokumentasi dari database
$query = mysqli_query($conn, "SELECT * FROM galeri ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri Dokumentasi | COM SMAKDA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-img-top {
      height: 220px;
      object-fit: cover;
    }
    .card-title {
      font-size: 1.2rem;
      font-weight: 600;
    }
    .card-text {
      font-size: 0.95rem;
    }
    .card-footer {
      font-size: 0.85rem;
      background-color: #fff;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">Galeri Dokumentasi Kegiatan</h2>
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      <?php while ($data = mysqli_fetch_assoc($query)) : ?>
        <div class="col">
          <div class="card h-100 shadow-sm border-0">
            <img 
              src="upload_dokumentasi/<?= htmlspecialchars($data['gambar']) ?>" 
              class="card-img-top" 
              alt="Dokumentasi Kegiatan" 
              onerror="this.onerror=null; this.src='https://via.placeholder.com/400x220?text=No+Image';"
            >
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($data['judul']) ?></h5>
              <p class="card-text"><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
            </div>
            <div class="card-footer text-muted">
              Diunggah pada: <?= date('d M Y', strtotime($data['tanggal'])) ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
