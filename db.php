<?php
$host = 'e0k4s0wgocc00s0gs8c8oc80';
$user = 'comsmkda';
$password = 'comsmakda';
$database = 'multi-role';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
