<?php
require 'db.php';

$username = 'ikhsan'; // ganti sesuai kebutuhan
$password = password_hash('240808', PASSWORD_DEFAULT); // password aman
$role = 'ketua';

$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if ($conn->query($sql) === TRUE) {
    echo "User berhasil dibuat!";
} else {
    echo "Error: " . $conn->error;
}
