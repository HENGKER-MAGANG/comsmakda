<?php
require '../db.php';
require '../auth.php';
cekRole(['ketua']);

include 'partials/header.php';
include 'partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = mysqli_real_escape_string($conn, $_POST['judul']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

  $namaFile = $_FILES['gambar']['name'];
  $tmpName = $_FILES['gambar']['tmp_name'];
  $ukuran = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];

  $folderUpload = '../upload_dokumentasi/';
  if (!is_dir($folderUpload)) {
    mkdir($folderUpload, 0777, true);
  }

  $ekstensiValid = ['jpg', 'jpeg', 'png'];
  $ekstensiFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

  if ($error === 0) {
    if (in_array($ekstensiFile, $ekstensiValid)) {
      if ($ukuran < 2 * 1024 * 1024) { // Max 2MB
        $namaBaru = uniqid() . '.' . $ekstensiFile;
        move_uploaded_file($tmpName, $folderUpload . $namaBaru);

        // Tambahkan tanggal dengan NOW()
        $query = "INSERT INTO galeri (judul, deskripsi, gambar, tanggal) 
                  VALUES ('$judul', '$deskripsi', '$namaBaru', NOW())";
        mysqli_query($conn, $query);

        echo "<script>
          alert('Dokumentasi berhasil diunggah!');
          window.location.href = 'galeri.php';
        </script>";
        exit;
      } else {
        $errorMsg = "Ukuran file terlalu besar (maks 2MB)";
      }
    } else {
      $errorMsg = "Ekstensi file tidak diperbolehkan (hanya JPG, JPEG, PNG)";
    }
  } else {
    $errorMsg = "Terjadi kesalahan saat upload file.";
  }
}
?>

<div class="container py-4">
  <h2 class="mb-4">Upload Dokumentasi Kegiatan</h2>

  <?php if (isset($errorMsg)) : ?>
    <div class="alert alert-danger"><?= $errorMsg ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="judul" class="form-label">Judul</label>
      <input type="text" class="form-control" name="judul" id="judul" required>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Upload Gambar</label>
      <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
    <a href="galeri.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include 'partials/footer.php'; ?>
