<?php
session_start();
require '../db.php';

if (!isset($_SESSION['id_anggota'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_POST['id_kas'])) {
    echo "<script>alert('ID kas tidak ditemukan.'); window.location.href='tunggakan.php';</script>";
    exit;
}

$id_kas = $_POST['id_kas'];
$id_anggota = $_SESSION['id_anggota'];
$tanggal = date('Y-m-d');

// Cek apakah sudah pernah diajukan
$stmt = $conn->prepare("SELECT 1 FROM pembayaran_tunggakan WHERE id_kas = ? AND id_anggota = ?");
$stmt->bind_param("ii", $id_kas, $id_anggota);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // Belum pernah diajukan, insert data
    $insert = $conn->prepare("INSERT INTO pembayaran_tunggakan (id_kas, id_anggota, tanggal_pengajuan, status)
                              VALUES (?, ?, ?, 'Menunggu')");
    $insert->bind_param("iis", $id_kas, $id_anggota, $tanggal);
    $insert->execute();

    echo "<script>
        alert('Pengajuan pembayaran berhasil. Menunggu verifikasi.');
        window.location.href='tunggakan.php';
    </script>";
} else {
    echo "<script>
        alert('Anda sudah mengajukan pembayaran untuk tunggakan ini.');
        window.location.href='tunggakan.php';
    </script>";
}
?>
