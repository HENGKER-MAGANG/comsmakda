<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Yakin ingin logout?',
      text: 'Anda akan keluar dari sistem.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '../logout.php';
      }
    });
  });
</script>
