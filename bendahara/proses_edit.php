<?php
session_start();
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $bulan = $_POST['bulan'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare("UPDATE kas SET username = ?, bulan = ?, jumlah = ? WHERE id = ?");
    $stmt->bind_param("ssii", $username, $bulan, $jumlah, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Data kas berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui data kas.";
    }

    header("Location: data_kas.php");
    exit;
}
