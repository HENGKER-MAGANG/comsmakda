<?php
$host = 'e0k4s0wgocc00s0gs8c8oc80';
$db   = 'multi-role';
$user = 'comsmkda';
$pass = 'comsmakda';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Koneksi gagal: ' . $e->getMessage());
}
?>
