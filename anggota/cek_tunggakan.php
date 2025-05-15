<?php
session_start();
require '../db.php'; // Pastikan koneksi database dimuat

// Cek apakah hari ini Rabu (3) atau Jumat (5)
$hari_ini = date('N'); // 1 = Senin, ..., 7 = Minggu
$tanggal_hari_ini = date('Y-m-d');

if ($hari_ini == 3 || $hari_ini == 5) {
    // Ambil semua anggota dari tabel `anggota`
    $result_anggota = mysqli_query($conn, "SELECT id_anggota FROM anggota");

    while ($anggota = mysqli_fetch_assoc($result_anggota)) {
        $id_anggota = $anggota['id_anggota'];

        // Cek apakah anggota sudah membayar kas hari ini
        $cek_kas = mysqli_query($conn, "SELECT 1 FROM kas WHERE id_anggota = '$id_anggota' AND tanggal = '$tanggal_hari_ini'");

        if (mysqli_num_rows($cek_kas) === 0) {
            // Jika belum, tambahkan sebagai tunggakan
            mysqli_query($conn, "INSERT INTO kas (id_anggota, tanggal, jumlah, keterangan, is_tunggakan)
                                 VALUES ('$id_anggota', '$tanggal_hari_ini', 2000, 'Tunggakan', 1)");
        }
    }
}
?>
