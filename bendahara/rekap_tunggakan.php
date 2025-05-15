<?php
session_start();
include '../db.php'; // Pastikan path ini benar

$tanggal_akhir = date('Y-m-d');

// Ambil semua user dengan role anggota
$sql_users = "SELECT id, username, tanggal_daftar FROM users WHERE role = 'anggota'";
$result_users = mysqli_query($conn, $sql_users);
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Tunggakan | Bendahara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <h3 class="mb-4 text-center">Rekap Tunggakan Kas Anggota</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Tanggal Daftar</th>
                    <th>Total Bayar</th>
                    <th>Jumlah Tunggakan</th>
                    <th>Total Tunggakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($user = mysqli_fetch_assoc($result_users)) {
                    $id_user = $user['id'];
                    $username = $user['username'];
                    $tanggal_daftar = $user['tanggal_daftar'];

                    // Ambil semua tanggal iuran sejak tanggal_daftar user sampai sekarang (Rabu dan Jumat)
                    $period = new DatePeriod(
                        new DateTime($tanggal_daftar),
                        new DateInterval('P1D'),
                        new DateTime($tanggal_akhir . ' +1 day')
                    );
                    $tanggal_iuran = [];
                    foreach ($period as $date) {
                        $day = $date->format('N'); // 3 = Rabu, 5 = Jumat
                        if ($day == 3 || $day == 5) {
                            $tanggal_iuran[] = $date->format('Y-m-d');
                        }
                    }

                    // Ambil semua tanggal pembayaran user ini yang statusnya Disetujui
                    $sql_bayar = "SELECT tanggal_pengajuan FROM pembayaran_tunggakan 
                                WHERE id_user = $id_user AND status = 'Disetujui'";
                    $result_bayar = mysqli_query($conn, $sql_bayar);

                    $tanggal_bayar = [];
                    while ($row = mysqli_fetch_assoc($result_bayar)) {
                        $tanggal_bayar[] = $row['tanggal_pengajuan'];
                    }

                    // Hitung
                    $total_bayar = count($tanggal_bayar) * 2000;
                    $tunggakan = 0;
                    foreach ($tanggal_iuran as $tgl) {
                        if (!in_array($tgl, $tanggal_bayar)) {
                            $tunggakan++;
                        }
                    }
                    $total_tunggakan = $tunggakan * 2000;

                    echo "<tr class='text-center'>
                            <td>$no</td>
                            <td>$username</td>
                            <td>" . date('d-m-Y', strtotime($tanggal_daftar)) . "</td>
                            <td>Rp " . number_format($total_bayar, 0, ',', '.') . "</td>
                            <td>$tunggakan kali</td>
                            <td>Rp " . number_format($total_tunggakan, 0, ',', '.') . "</td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
