<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmLogout() {
    Swal.fire({
      title: 'Yakin ingin logout?',
      text: "Kamu akan keluar dari sesi login.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, logout!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '../login.php';
      }
    });
  }

  <?php if (isset($_GET['login']) && $_GET['login'] === 'success'): ?>
    Swal.fire({
      icon: 'success',
      title: 'Login Berhasil!',
      text: 'Selamat datang kembali!',
      timer: 2000,
      showConfirmButton: false
    });
  <?php endif; ?>
</script>
