<?php
// Aktifkan error reporting saat pengembangan
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include koneksi
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor_wa'];
    $pesan = $_POST['pesan'];

    if (!empty($nama) && !empty($nomor) && !empty($pesan)) {
        $stmt = $conn->prepare("INSERT INTO pesan (nama, nomor_wa, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $nomor, $pesan);

        if ($stmt->execute()) {
            $status = 'success';
            $message = 'Pesan berhasil dikirim!';
        } else {
            $status = 'error';
            $message = 'Gagal mengirim pesan: ' . $conn->error;
        }

        $stmt->close();
    } else {
        $status = 'error';
        $message = 'Semua field wajib diisi!';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Proses Pesan</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
  Swal.fire({
    icon: '<?= $status ?>',
    title: '<?= $status === "success" ? "Berhasil" : "Gagal" ?>',
    text: '<?= addslashes($message) ?>',
    confirmButtonText: 'OK'
  }).then(() => {
    window.location.href = 'index.php';
  });
</script>
</body>
</html>
