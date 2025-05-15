<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'sekretaris') {
    header("Location: ../index.php");
    exit;
}

$tanggal = date('Y-m-d');
$status_data = $_POST['status'] ?? [];

foreach ($status_data as $username => $status) {
    if (!empty($status)) {
        $stmt = $conn->prepare("INSERT INTO absensi (tanggal, username, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tanggal, $username, $status);
        $stmt->execute();
    }
}

$_SESSION['success'] = "Absensi berhasil disimpan.";
header("Location: absensi.php");
exit;
