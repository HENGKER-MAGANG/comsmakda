<?php
$host = "localhost"; // Host untuk server lokal
$user = "root"; // Username default untuk MySQL di lokal
$pass = ""; // Password default untuk MySQL di lokal (biasanya kosong)
$dbname = "multi-role"; // Nama database yang ingin Anda gunakan

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi berhasil!";
?>
