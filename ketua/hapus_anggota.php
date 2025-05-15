<?php
session_start();
require '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id = $id AND role = 'anggota'");
    $_SESSION['success'] = "Anggota berhasil dihapus.";
}

header("Location: anggota.php");
exit;
