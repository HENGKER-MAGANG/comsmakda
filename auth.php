<?php
session_start();

function cekRole($role) {
    if (!isset($_SESSION['role'])) {
        header("Location: login.php");
        exit;
    }

    // Jika $role bukan array, ubah jadi array
    if (!is_array($role)) {
        $role = [$role];
    }

    // Cek apakah role user termasuk dalam array role yang diizinkan
    if (!in_array($_SESSION['role'], $role)) {
        header("Location: login.php");
        exit;
    }
}
