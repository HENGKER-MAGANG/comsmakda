<?php
$host = "e0k4s0wgocc00s0gs8c8oc80";
$user = "mysql";
$pass = "comsmakda";
$dbname = "multi-role";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
