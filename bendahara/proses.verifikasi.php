<?php

session_start();
include '../db.php';

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if ($aksi == 'setuju') {
    // Update status pembayaran dan ubah keterangan di tabel kas
    mysqli_query($conn, "UPDATE pembayaran_tunggakan SET status='Disetujui' WHERE id='$id'");

    $getKas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_kas FROM pembayaran_tunggakan WHERE id='$id'"));
    $id_kas = $getKas['id_kas'];

    mysqli_query($conn, "UPDATE kas SET keterangan='Tunggakan Dibayar', is_tunggakan=0 WHERE id_kas='$id_kas'");
} else {
    mysqli_query($conn, "UPDATE pembayaran_tunggakan SET status='Ditolak' WHERE id='$id'");
}

header("Location: verifikasi_tunggakan.php");
