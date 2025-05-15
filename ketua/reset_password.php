<?php
session_start();
require '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $default_password = password_hash('12345678', PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ? AND role = 'anggota'");
    $stmt->bind_param("si", $default_password, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Password berhasil direset ke '12345678'.";
    } else {
        $_SESSION['error'] = "Gagal mereset password.";
    }
}

header("Location: anggota.php");
exit;
