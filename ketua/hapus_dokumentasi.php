<?php
require '../db.php';
require '../auth.php';
cekRole(['ketua']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);

  // Ambil gambar dari database
  $get = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
  $data = mysqli_fetch_assoc($get);

  if ($data) {
    $filePath = "../upload_dokumentasi/" . $data['gambar'];

    // Hapus file dari folder
    if (file_exists($filePath)) {
      unlink($filePath);
    }

    // Hapus data dari DB
    mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
  }
}

header("Location: galeri.php");
exit;
