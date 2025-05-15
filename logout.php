<?php
session_start();

// Cek apakah user sedang login
if (isset($_SESSION['username'])) {
  // Hapus semua session
  session_unset();
  session_destroy();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Optional: Styling Bootstrap jika diperlukan -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Logout Berhasil',
      text: 'Anda telah keluar dari akun.',
      timer: 2000,
      showConfirmButton: false
    }).then(() => {
      window.location.href = 'login.php'; // Ganti jika file login ada di direktori lain
    });
  </script>
</body>
</html>
