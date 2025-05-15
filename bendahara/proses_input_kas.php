<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $tanggal  = $_POST['tanggal'];
    $jumlah   = $_POST['jumlah'];

    $stmt = $conn->prepare("INSERT INTO kas (username, tanggal, jumlah) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $tanggal, $jumlah);
    $stmt->execute();

    $_SESSION['kas_success'] = true;
    header("Location: input_kas.php");
    exit;
}
