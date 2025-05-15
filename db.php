<?php
$host = 'mysql-com'; // contoh: mysql.coolify.myapp.com atau IP seperti 172.20.0.3
$user = 'comsmkda';
$password = 'comsmakda';
$dbname = 'multi-role';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
