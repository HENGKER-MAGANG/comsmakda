<?php
include 'db.php';
$query = mysqli_query($conn, "SELECT * FROM dokumentasi ORDER BY tanggal_upload DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dokumentasi Kegiatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Dokumentasi Kegiatan</h3>
    <div class="row">
        <?php while ($d = mysqli_fetch_assoc($query)) { ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="uploads/<?= htmlspecialchars($d['gambar']) ?>" class="card-img-top" style="max-height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($d['judul']) ?></h5>
                    <p class="card-text"><?= substr(strip_tags($d['isi']), 0, 100) ?>...</p>
                </div>
                <div class="card-footer text-muted">
                    <?= date('d M Y', strtotime($d['tanggal_upload'])) ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
