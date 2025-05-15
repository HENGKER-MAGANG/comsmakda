<?php
require 'db.php';

$username = 'anggota'; // ganti sesuai kebutuhan
$password = password_hash('123456', PASSWORD_DEFAULT); // password aman
$role = 'anggota';

$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if ($conn->query($sql) === TRUE) {
    echo "User berhasil dibuat!";
} else {
    echo "Error: " . $conn->error;
}
