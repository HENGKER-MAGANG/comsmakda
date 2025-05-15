<?php
include 'db.php';

$query = mysqli_query($conn, "SELECT YEAR(created_at) AS tahun, COUNT(*) as jumlah FROM users GROUP BY YEAR(created_at)");
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik Anggota</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Statistik Jumlah Anggota per Tahun</h3>
    <canvas id="anggotaChart" height="100"></canvas>
</div>

<script>
    const ctx = document.getElementById('anggotaChart').getContext('2d');
    const anggotaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($data, 'tahun')) ?>,
            datasets: [{
                label: 'Jumlah Anggota',
                data: <?= json_encode(array_column($data, 'jumlah')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
</body>
</html>
