<?php
session_start();
include '../config/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  mysqli_query($conn, "DELETE FROM absensi WHERE id = '$id'");
}

header('Location: absensi.php');
