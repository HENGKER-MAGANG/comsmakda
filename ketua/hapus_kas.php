<?php
session_start();
include 'partials/header.php';
include 'partials/navbar.php';
require '../db.php';

if ($_SESSION['role'] !== 'ketua') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

// Mengambil data sebelum dihapus
$query = "SELECT * FROM kas WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Hapus data kas
$deleteQuery = "DELETE FROM kas WHERE id = '$id'";
if (mysqli_query($conn, $deleteQuery)) {
    // Log aktivitas
    $logQuery = "INSERT INTO log_kas (username, aksi, jumlah) VALUES ('".$_SESSION['username']."', 'Hapus Kas', '".$row['jumlah']."')";
    mysqli_query($conn, $logQuery);

    // Redirect ke halaman kas
    header("Location: kas.php");
    exit;
}
?>
