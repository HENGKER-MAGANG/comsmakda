<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Project tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM portofolio WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Project tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Project - <?= htmlspecialchars($data['judul']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">← Kembali</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><?= htmlspecialchars($data['judul']) ?></h3>
        </div>
        <div class="card-body">
            <img src="uploads/<?= htmlspecialchars($data['gambar']) ?>" class="img-fluid rounded mb-3" style="max-height:300px">
            <p><strong>Teknologi Digunakan:</strong> <?= htmlspecialchars($data['teknologi']) ?></p>
            <p><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
        </div>
    </div>
</div>
</body>
</html>
