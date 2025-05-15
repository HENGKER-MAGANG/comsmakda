<?php
$host = 'e0k4s0wgocc00s0gs8c8oc80'; // host dari Coolify
$dbname = 'multi-role';
$username = 'comsmkda';
$password = 'comsmkda';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
