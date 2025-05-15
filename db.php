<?php
$host = 'e0k4s0wgocc00s0gs8c8oc80';
$user = 'comsmkda';
$password = 'comsmakda';
$database = 'multi-role';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>


