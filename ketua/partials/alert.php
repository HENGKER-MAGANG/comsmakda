<?php if (isset($_SESSION['alert'])): ?>
<script>
  Swal.fire({
    icon: '<?= $_SESSION['alert']['type'] ?>',
    title: '<?= $_SESSION['alert']['title'] ?>',
    text: '<?= $_SESSION['alert']['message'] ?>',
    confirmButtonText: 'OK'
  });
</script>
<?php unset($_SESSION['alert']); endif; ?>
