<?php
$host = getenv("DB_HOST") ?: "mysql-com";
$user = getenv("DB_USER") ?: "mysql";
$pass = getenv("DB_PASS") ?: "comsmakda";
$dbname = getenv("DB_NAME") ?: "multi-role";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
