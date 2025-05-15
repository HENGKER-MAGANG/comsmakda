<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">
      <i class="bi bi-person-circle me-1"></i> Anggota
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAnggota" aria-controls="navbarAnggota" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAnggota">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? ' active' : '' ?>" href="dashboard.php">
            <i class="bi bi-speedometer2 me-1"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'riwayat_kas.php' ? ' active' : '' ?>" href="riwayat_kas.php">
            <i class="bi bi-cash-stack me-1"></i> Riwayat Kas
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tunggakan.php">Tunggakan Saya</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'rabsensi.php' ? ' active' : '' ?>" href="absensi.php">
            <i class="bi bi-calendar-check me-1"></i> Riwayat Absensi
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'profil.php' ? ' active' : '' ?>" href="profil.php">
            <i class="bi bi-person-lines-fill me-1"></i> Profil
          </a>
        </li>
      </ul>
      <a href="#" onclick="confirmLogout()" class="dropdown-item text-danger">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>
  </div>
</nav>
