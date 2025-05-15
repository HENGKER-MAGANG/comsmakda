<?php
session_start();
require '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'anggota') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];
$konfirmasi = $_POST['konfirmasi_password'];
$jawaban = $_POST['jawaban'];

$user = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();

// Validasi password lama
if (!password_verify($password_lama, $user['password'])) {
    $_SESSION['error'] = 'Password lama salah.';
    header('Location: ubah_password.php');
    exit;
}

// Validasi captcha
if ((int)$jawaban !== $_SESSION['captcha']) {
    $_SESSION['error'] = 'Jawaban soal penjumlahan salah.';
    header('Location: ubah_password.php');
    exit;
}

// Validasi password baru sama konfirmasi
if ($password_baru !== $konfirmasi) {
    $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
    header('Location: ubah_password.php');
    exit;
}

// Update password
$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
$conn->query("UPDATE users SET password = '$password_hash' WHERE username = '$username'");

$_SESSION['success'] = 'Password berhasil diubah.';
header('Location: ubah_password.php');
exit;
