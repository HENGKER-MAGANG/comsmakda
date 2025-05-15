<?php
$host = 'e0k4s0wgocc00s0gs8c8oc80';
$user = 'comsmkda';
$password = 'comsmakda';
$database = 'multi-role';

$mysqli = new mysqli('host', 'comsmkda', 'comsmakda', 'multi-role', 3306, '/var/run/mysqld/mysqld.sock');


if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>


